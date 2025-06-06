from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
from flask import Flask, request, jsonify
import time
import logging
import os
import traceback

app = Flask(__name__)

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

def wait_for_download_to_complete(download_dir, timeout=300):
    logger.info("Waiting for file to download completely...")
    seconds = 0
    while seconds < timeout:
        files = os.listdir(download_dir)
        downloading = any(fname.endswith('.crdownload') for fname in files)

        if not downloading and files:
            logger.info(f"[✔] Download complete: {files}")
            return True

        time.sleep(1)
        seconds += 1

    logger.info("[✖] Download did not complete within timeout.")
    return False

def run_bi_report_scraper(username, password):
    KEYS = {
    'user': username,
    'pass': password
}
    try:
        logger.info("Setting up download directory...")
        download_dir = os.path.abspath("data")
        os.makedirs(download_dir, exist_ok=True)
        logger.info(f" → Download directory set to: {download_dir}")

        logger.info("Configuring Chrome options...")
        options = Options()
        options.add_experimental_option("prefs", {
            "download.default_directory": download_dir,
            "download.prompt_for_download": False,
            "safebrowsing.enabled": True
        })

        logger.info("Launching Chrome browser...")
        service = Service(ChromeDriverManager().install())
        driver = webdriver.Chrome(service=service, options=options)

        logger.info("[STEP 1] Navigating to dashboard URL...")
        url = "https://reports.px.indianoil.in/analytics/saw.dll?dashboard&PortalPath=%2Fshared%2FLPG%2F_portal%2FDistributor%20Reports"
        driver.get(url)

        logger.info("[STEP 2] Waiting for login page and entering credentials...")
        WebDriverWait(driver, 20).until(EC.presence_of_element_located((By.ID, "username")))
        driver.find_element(By.ID, "username").send_keys(KEYS['user'])
        driver.find_element(By.ID, "password").send_keys(KEYS['pass'])
        driver.find_element(By.ID, "submitid").click()
        logger.info(" → Login submitted.")
        time.sleep(5)  # Wait for login to process

        logger.info("[STEP 3] Waiting for dashboard to load and setting zoom to 40%...")
        WebDriverWait(driver, 30).until(EC.presence_of_element_located((By.TAG_NAME, "body")))
        time.sleep(2)
        driver.execute_script("document.body.style.zoom='40%'")

        logger.info("[STEP 4] Clicking 'Customer Register' tab...")
        customer_register_tab = WebDriverWait(driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, "//div[contains(text(), 'Customer Register')]"))
        )
        driver.execute_script("arguments[0].click();", customer_register_tab)
        time.sleep(1)

        logger.info("[STEP 5] Clicking 'Customer Register Report'...")
        customer_register_report = WebDriverWait(driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, "//a[contains(text(), 'Customer Register Report')]"))
        )
        driver.execute_script("arguments[0].click();", customer_register_report)
        
        existing_files = set(os.listdir(download_dir))  # Snapshot before download
        
        logger.info("Cleaning up existing files in download directory...")
        for filename in existing_files:
            file_path = os.path.join(download_dir, filename)
            if os.path.isfile(file_path):
                try:
                    os.remove(file_path)
                    logger.info(f" → Deleted old file: {filename}")
                except Exception as e:
                    logger.warning(f"Could not delete file {filename}: {e}")

        logger.info("[STEP 6] Clicking export icon...")
        export_link = WebDriverWait(driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, "//a[@title='Export to different format']"))
        )
        driver.execute_script("arguments[0].click();", export_link)
        time.sleep(2)

        logger.info("[STEP 6.1] Clicking Excel option...")
        excel_link = WebDriverWait(driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//a[contains(@aria-label, 'Excel')]"))
        )
        driver.execute_script("arguments[0].click();", excel_link)

        logger.info("[STEP 7] Waiting for export confirmation popup (if any)...")
        try:
            confirmation_ok = WebDriverWait(driver, 30).until(
                EC.element_to_be_clickable((By.XPATH, "//div[contains(text(), 'Export process is complete')]/following-sibling::*/descendant::button[text()='OK']"))
            )
            confirmation_ok.click()
            logger.info(" → Confirmation popup closed.")
        except:
            logger.info(" → No confirmation popup or it closed automatically.")

        logger.info("[STEP 8] Waiting for download to complete...")
        if wait_for_download_to_complete(download_dir, timeout=300):
            logger.info("[✅] File downloaded successfully.")
            return "[✅] BI Report exported successfully."
        else:
            logger.info("[⚠️] File download failed or timed out.")
            return "[⚠️] Export initiated, but download may have failed or timed out."

    except Exception as e:
        traceback.print_exc()
        logger.error(f"An error occurred: {str(e)}")
        return f"[❌] ERROR: {str(e)}"
    
    
    finally:
        print("[STEP 9] Attempting to sign out...")
        try:
            driver.switch_to.default_content()
            signout_button = driver.find_element(By.XPATH, "//a[contains(text(), 'Sign Out')]")
            signout_button.click()
            print(" → Signed out successfully.")
        except:
            print(" → Sign Out link not found.")

        driver.quit()
        print("✔ Browser closed.")

@app.route('/bi_report_scraper', methods=['POST'])
def trigger_scraper():
    """API endpoint to run the BI Report Scraper"""
    try:
        data = request.get_json()
        if not data or 'username' not in data or 'password' not in data:
            return jsonify({"status": "error", "message": "Missing credentials"}), 400
        
        result = run_bi_report_scraper(data['username'], data['password'])
        # return jsonify({"message": result})
        if isinstance(result, str) and result.startswith("[✅]"):
            return jsonify({"status": "success", "message": result})
        elif isinstance(result, str) and (result.startswith("[❌]") or result.startswith("[⚠️]")):
            return jsonify({"status": "error", "message": result})
        else:
            return jsonify({"status": "error", "message": result})
    except Exception as e:
        logger.error(f"API error: {str(e)}")
        return jsonify({
            "status": "error",
            "message": str(e),
            "traceback": traceback.format_exc()
        }), 500
if __name__ == '__main__':
    app.run(debug=True, port=5000)
