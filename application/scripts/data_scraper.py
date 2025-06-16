from flask import Flask, request, jsonify
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from webdriver_manager.chrome import ChromeDriverManager
import time
import random
import logging
from bs4 import BeautifulSoup
import traceback
import os

app = Flask(__name__)

# Configure logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# Constants for SDMS Scraper
# SDMS_LOGIN_URL = "https://access.ex.indianoil.in/oam/server/obrareq.cgi?encquery%3D8JDuX7m5GTn0urPrhrLB7tpfhXlEzsMc3yZM5JbHQ5F2izqIPDQ2Tf9C0kQ27MVzpl2OYxMkTYtahUOSQpKrLvF%2BKcMciJjPzE9fvAVoZIHp2rQ%2FpNf5B%2BjY17WvXUWVvTkQbQczhGFCJtdhtXDnIkD8IEf67yhWEb7XvDFBHhNvbhK%2F3HgdJB0lQkEdysKjfD5OnO2JnVeH6BaghQcrjcrFlncBACfC3fciZs%2BFKgMaNjSL%2FGLxHwi5W6PYUdUUTqSuknwP4oa%2FBC1GhcHinKrC1cGJJo2nzncPNZ%2B0vGLID1HVq69idpsNeT%2FovRti%2BAX4EXkLiXAziP2Xb4QImw%3D%3D%20agentid%3DSIEBEL_IP24%20ver%3D1%20crmethod%3D2%26cksum%3D86f442ca9b932cd15421d389231acc8c698cde25&ECID-Context=1.006BxESH%5EAIBl3o5oV5EiY00EY2Y00Szi5%3BkXjE"
SDMS_TARGET_URL = "https://sdms.px.indianoil.in/siebel/app/edealer/enu/?SWECmd=GotoView&SWEView=EPIC+Order+Summary+View"
TIMEOUT = 120  # seconds

def setup_driver(download_dir=None):
    """Configure Chrome WebDriver with anti-detection settings"""
    options = Options()
    options.add_argument("--disable-blink-features=AutomationControlled")
    options.add_experimental_option("excludeSwitches", ["enable-automation"])
    options.add_argument("--window-size=1920,1080")
    
    if download_dir:
        options.add_experimental_option("prefs", {
            "download.default_directory": download_dir,
            "download.prompt_for_download": False,
            "safebrowsing.enabled": True
        })
    
    service = Service(ChromeDriverManager().install())
    driver = webdriver.Chrome(service=service, options=options)
    
    # Mask selenium detection
    driver.execute_cdp_cmd("Page.addScriptToEvaluateOnNewDocument", {
        "source": """
            Object.defineProperty(navigator, 'webdriver', {
                get: () => undefined
            });
        """
    })
    return driver

def wait_random(min_sec=2, max_sec=5):
    """Human-like random delay"""
    time.sleep(random.uniform(min_sec, max_sec))

def sdms_login(driver, username, password):
    """Perform login and ensure we reach the home page for SDMS"""
    try:
        driver.get(SDMS_LOGIN_URL)
        logger.info("Loading SDMS login page...")
        
        # Fill login form
        WebDriverWait(driver, TIMEOUT).until(
            EC.presence_of_element_located((By.ID, "username"))
        ).send_keys(username)
        wait_random()
        
        driver.find_element(By.ID, "password").send_keys(password)
        wait_random()
        driver.find_element(By.ID, "submitid").click()
        logger.info("SDMS login submitted")
        
        # Wait for home page to load
        WebDriverWait(driver, TIMEOUT).until(
            lambda d: "epic" in d.current_url.lower() or "home" in d.current_url.lower()
        )
        logger.info("SDMS login successful - reached home page")
        return True
        
    except Exception as e:
        logger.error(f"SDMS login failed: {str(e)}")
        return False

def navigate_to_sdms_target(driver):
    """Navigate from home page to SDMS target URL with multiple fallback methods"""
    try:
        attempts = [
            # Method 1: Direct URL access
            lambda: driver.get(SDMS_TARGET_URL),
            
            # Method 2: Click menu item if visible
            lambda: driver.find_element(By.XPATH, "//a[contains(@href, 'EPIC+Order+Summary+View')]").click(),
            
            # Method 3: URL reconstruction
            lambda: driver.get(driver.current_url.split('?')[0] + "?SWECmd=GotoView&SWEView=EPIC+Order+Summary+View")
        ]
        
        for attempt in attempts:
            try:
                attempt()
                WebDriverWait(driver, 10).until(
                    lambda d: "EPIC+Order+Summary+View" in d.current_url
                )
                logger.info("Successfully reached SDMS target page")
                return True
            except Exception:
                continue
                
        logger.error("All SDMS navigation methods failed")
        return False
        
    except Exception as e:
        logger.error(f"SDMS navigation failed: {str(e)}")
        return False

def scrape_sdms_tables(driver):
    """Scrape data from both tables on SDMS target page, handling pagination for s_3_l"""
    try:
        # Switch to iframe if exists
        iframes = driver.find_elements(By.TAG_NAME, "iframe")
        if iframes:
            driver.switch_to.frame(iframes[0])
            wait_random()

        # Initialize result lists
        invoiced_data = []
        open_orders_data = []

        # Function to extract table data from BeautifulSoup
        def extract_table(soup, table_id, columns):
            table = soup.find('table', {'id': table_id})
            if not table:
                logger.warning(f"Table with ID '{table_id}' not found.")
                return []

            rows_data = []
            for row in table.find_all('tr')[1:]:  # Skip header
                cells = row.find_all('td')
                row_data = {}
                for i, col in enumerate(columns):
                    try:
                        row_data[col] = cells[i+1].get_text(strip=True)
                    except IndexError:
                        logger.warning(f"Missing data for column '{col}' in row")
                        continue

                if table_id == "s_3_l" and row_data not in invoiced_data:
                    rows_data.append(row_data)
                elif table_id == "s_4_l" and row_data not in open_orders_data:
                    rows_data.append(row_data)

            return rows_data

        # Scrape s_3_l with pagination
        while True:
            WebDriverWait(driver, TIMEOUT).until(
                EC.presence_of_element_located((By.ID, "s_3_l"))
            )

            # Parse current page
            soup = BeautifulSoup(driver.page_source, 'html.parser')
            page_data = extract_table(soup, 's_3_l', ['Area Name', 'CashMemo Generated', 'Status'])
            invoiced_data.extend(page_data)
            logger.info(f"Scraped {len(page_data)} rows from s_3_l on current page")

            try:
                next_button = WebDriverWait(driver, TIMEOUT).until(
                    EC.presence_of_element_located((By.ID, "next_pager_s_3_l"))
                )

                if "ui-state-disabled" in next_button.get_attribute("class"):
                    logger.info("No more pages for s_3_l")
                    break

                old_first_row_text = driver.find_element(By.XPATH, "//table[@id='s_3_l']//tr[2]").text
                next_button.click()
                logger.info("Clicked next page for s_3_l")

                WebDriverWait(driver, TIMEOUT).until(
                    lambda d: d.find_element(By.XPATH, "//table[@id='s_3_l']//tr[2]").text != old_first_row_text
                )
                wait_random(1, 3)

            except Exception as e:
                logger.exception(f"No next page found or error: {e}")
                break

        # Scrape s_4_l (no pagination needed based on current data)
        WebDriverWait(driver, TIMEOUT).until(
            EC.presence_of_element_located((By.ID, "s_4_l"))
        )
        soup = BeautifulSoup(driver.page_source, 'html.parser')
        open_orders_data = extract_table(soup, 's_4_l', ['Area Name', 'Open Refill Orders'])
        logger.info(f"Scraped {len(open_orders_data)} rows from s_4_l")

        return {
            'invoiced_process_order': invoiced_data,
            'open_orders': open_orders_data
        }

    except Exception as e:
        logger.error(f"SDMS scraping failed: {str(e)}")
        return None
    finally:
        driver.switch_to.default_content()

def wait_for_download_to_complete(download_dir, timeout=300):
    """Wait for file download to complete"""
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
    """Run the BI Report Scraper"""
    KEYS = {
        'user': username,
        'pass': password
    }
    try:
        logger.info("Setting up download directory...")
        download_dir = os.path.abspath("data")
        os.makedirs(download_dir, exist_ok=True)
        logger.info(f" → Download directory set to: {download_dir}")

        logger.info("Launching Chrome browser for BI report...")
        driver = setup_driver(download_dir)

        logger.info("[STEP 1] Navigating to BI dashboard URL...")
        url = "https://reports.px.indianoil.in/analytics/saw.dll?dashboard&PortalPath=%2Fshared%2FLPG%2F_portal%2FDistributor%20Reports"
        driver.get(url)

        logger.info("[STEP 2] Waiting for login page and entering credentials...")
        WebDriverWait(driver, 20).until(EC.presence_of_element_located((By.ID, "username")))
        driver.find_element(By.ID, "username").send_keys(KEYS['user'])
        driver.find_element(By.ID, "password").send_keys(KEYS['pass'])
        driver.find_element(By.ID, "submitid").click()
        logger.info(" → BI login submitted.")
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
        logger.error(f"BI report scraping failed: {str(e)}")
        return f"[❌] ERROR: {str(e)}"
    finally:
        try:
            driver.switch_to.default_content()
            signout_button = driver.find_element(By.XPATH, "//a[contains(text(), 'Sign Out')]")
            signout_button.click()
            logger.info(" → BI report signed out successfully.")
        except:
            logger.info(" → BI report sign out link not found.")
        driver.quit()
        logger.info("✔ BI report browser closed.")

def cleanup_driver(driver):
    """Common cleanup function for both scrapers"""
    try:
        logger.info("Attempting to sign out...")
        driver.switch_to.default_content()
        try:
            signout_button = WebDriverWait(driver, 10).until(
                EC.presence_of_element_located((By.XPATH, "//a[contains(translate(., 'SIGNOUT', 'signout'), 'signout') or contains(., 'Sign Out')]"))
            )
            signout_button.click()
            logger.info("Signed out successfully")
            WebDriverWait(driver, 10).until(
                lambda d: "login" in d.current_url.lower() or "signout" in d.current_url.lower()
            )
        except Exception as e:
            logger.warning(f"Sign out link not found or sign out failed: {str(e)}")
    finally:
        driver.quit()
        logger.info("Browser closed")

@app.route('/data_scraper', methods=['POST'])
def api_scrape():
    """API endpoint for SDMS scraping"""
    driver = None
    try:
        data = request.get_json()
        if not data or 'username' not in data or 'password' not in data:
            return jsonify({"status": "error", "message": "Missing credentials"}), 400
        
        driver = setup_driver()
        
        # Step 1: Login
        if not sdms_login(driver, data['username'], data['password']):
            return jsonify({"status": "error", "message": "SDMS login failed"}), 401
        
        # Step 2: Navigate to target page
        if not navigate_to_sdms_target(driver):
            return jsonify({"status": "error", "message": "Failed to reach SDMS target page"}), 500
        
        # Step 3: Scrape data
        scraped_data = scrape_sdms_tables(driver)
        if not scraped_data:
            return jsonify({"status": "error", "message": "SDMS scraping failed"}), 500
        
        return jsonify({
            "status": "success",
            "data": scraped_data
        })
        
    except Exception as e:
        logger.error(f"SDMS API error: {str(e)}")
        return jsonify({
            "status": "error",
            "message": str(e),
            "traceback": traceback.format_exc()
        }), 500
    finally:
        if driver:
            cleanup_driver(driver)

@app.route('/bi_report_scraper', methods=['POST'])
def trigger_bi_scraper():
    """API endpoint to run the BI Report Scraper"""
    try:
        data = request.get_json()
        if not data or 'username' not in data or 'password' not in data:
            return jsonify({"status": "error", "message": "Missing credentials"}), 400
        
        result = run_bi_report_scraper(data['username'], data['password'])
        # Decide status based on result string
        if isinstance(result, str) and result.startswith("[✅]"):
            return jsonify({"status": "success", "message": result})
        elif isinstance(result, str) and (result.startswith("[❌]") or result.startswith("[⚠️]")):
            return jsonify({"status": "error", "message": result})
        else:
            return jsonify({"status": "error", "message": result})
    except Exception as e:
        logger.error(f"BI report API error: {str(e)}")
        return jsonify({
            "status": "error",
            "message": str(e),
            "traceback": traceback.format_exc()
        }), 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)