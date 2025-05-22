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

app = Flask(__name__)

# Configure logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# Constants
LOGIN_URL = "https://access.ex.indianoil.in/oam/server/obrareq.cgi?encquery%3D8JDuX7m5GTn0urPrhrLB7tpfhXlEzsMc3yZM5JbHQ5F2izqIPDQ2Tf9C0kQ27MVzpl2OYxMkTYtahUOSQpKrLvF%2BKcMciJjPzE9fvAVoZIHp2rQ%2FpNf5B%2BjY17WvXUWVvTkQbQczhGFCJtdhtXDnIkD8IEf67yhWEb7XvDFBHhNvbhK%2F3HgdJB0lQkEdysKjfD5OnO2JnVeH6BaghQcrjcrFlncBACfC3fciZs%2BFKgMaNjSL%2FGLxHwi5W6PYUdUUTqSuknwP4oa%2FBC1GhcHinKrC1cGJJo2nzncPNZ%2B0vGLID1HVq69idpsNeT%2FovRti%2BAX4EXkLiXAziP2Xb4QImw%3D%3D%20agentid%3DSIEBEL_IP24%20ver%3D1%20crmethod%3D2%26cksum%3D86f442ca9b932cd15421d389231acc8c698cde25&ECID-Context=1.006BxESH%5EAIBl3o5oV5EiY00EY2Y00Szi5%3BkXjE"
TARGET_URL = "https://sdms.px.indianoil.in/siebel/app/edealer/enu/?SWECmd=GotoView&SWEView=EPIC+Order+Summary+View"
TIMEOUT = 60  # seconds

def setup_driver():
    """Configure Chrome WebDriver with anti-detection settings"""
    options = Options()
    options.add_argument("--disable-blink-features=AutomationControlled")
    options.add_experimental_option("excludeSwitches", ["enable-automation"])
    options.add_argument("--window-size=1920,1080")
    
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

def login(driver, username, password):
    """Perform login and ensure we reach the home page"""
    try:
        driver.get(LOGIN_URL)
        logger.info("Loading login page...")
        
        # Fill login form
        WebDriverWait(driver, TIMEOUT).until(
            EC.presence_of_element_located((By.ID, "username"))
        ).send_keys(username)
        wait_random()
        
        driver.find_element(By.ID, "password").send_keys(password)
        wait_random()
        driver.find_element(By.ID, "submitid").click()
        logger.info("Login submitted")
        
        # Wait for home page to load
        WebDriverWait(driver, TIMEOUT).until(
            lambda d: "epic" in d.current_url.lower() or "home" in d.current_url.lower()
        )
        logger.info("Login successful - reached home page")
        return True
        
    except Exception as e:
        logger.error(f"Login failed: {str(e)}")
        return False

def navigate_to_target(driver):
    """Navigate from home page to target URL with multiple fallback methods"""
    try:
        attempts = [
            # Method 1: Direct URL access
            lambda: driver.get(TARGET_URL),
            
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
                logger.info("Successfully reached target page")
                return True
            except Exception:
                continue
                
        logger.error("All navigation methods failed")
        return False
        
    except Exception as e:
        logger.error(f"Navigation failed: {str(e)}")
        return False

def scrape_tables(driver):
    """Scrape data from both tables on target page, handling pagination for s_3_l"""
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
            # logger.info(f"scrapped data: {invoiced_data}")
            table = soup.find('table', {'id': table_id})
            if not table:
                return []
            rows = []
            for row in table.find_all('tr')[1:]:  # Skip header
                cells = row.find_all('td')
                # logger.info("Row cells: %s", [cell.get_text(strip=True) for cell in cells])
                if len(cells) != (len(columns) + 1):
                    logger.warning(f"Row length mismatch: expected {len(columns)}, got {len(cells)}")
                    continue
                row_data = {}
                for i, col in enumerate(columns):
                    # logger.info(f"Extracting {col}: {cells[i+1].get_text(strip=True)}")
                    row_data[col] = cells[i+1].get_text(strip=True)
                if(table_id == "s_3_1"):
                    if(row_data not in invoiced_data):
                        rows.append(row_data)
                if(table_id == "s_4_1"):
                    if(row_data not in open_orders_data):
                        rows.append(row_data)
            return rows

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

            # logger.info("Sleep for 5 seconds to mimic human behavior")
            # time.sleep(5)  # Optional delay for human-like behavior

            try:
                next_button = WebDriverWait(driver, TIMEOUT).until(
                    EC.presence_of_element_located((By.ID, "next_pager_s_3_l"))
                )

                if "ui-state-disabled" in next_button.get_attribute("class"):
                    logger.info("No more pages for s_3_l")
                    break

                old_first_row_text = driver.find_element(By.XPATH, "//table[@id='s_3_l']//tr[2]").text

                # logger.info("Sleeping 2 seconds before clicking next to ensure DOM is ready")
                # time.sleep(2)

                # Use JavaScript click for reliability
                next_button.click()
                logger.info("Clicked next page for s_3_l")

                WebDriverWait(driver, TIMEOUT).until(
                lambda d: d.find_element(By.XPATH, "//table[@id='s_3_l']//tr[2]").text != old_first_row_text
            ) 
                logger.info("Waiting for table to refresh...")

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
        logger.error(f"Scraping failed: {str(e)}")
        return None
    finally:
        driver.switch_to.default_content()


@app.route('/scrape', methods=['POST'])
def api_scrape():
    """API endpoint for scraping"""
    driver = None
    try:
        data = request.get_json()
        if not data or 'username' not in data or 'password' not in data:
            return jsonify({"status": "error", "message": "Missing credentials"}), 400
        
        driver = setup_driver()
        
        # Step 1: Login
        if not login(driver, data['username'], data['password']):
            return jsonify({"status": "error", "message": "Login failed"}), 401
        
        # Step 2: Navigate to target page
        if not navigate_to_target(driver):
            return jsonify({"status": "error", "message": "Failed to reach target page"}), 500
        
        # Step 3: Scrape data
        scraped_data = scrape_tables(driver)
        if not scraped_data:
            return jsonify({"status": "error", "message": "Scraping failed"}), 500
        
        return jsonify({
            "status": "success",
            "data": scraped_data
        })
        
    except Exception as e:
        logger.error(f"API error: {str(e)}")
        return jsonify({
            "status": "error",
            "message": str(e),
            "traceback": traceback.format_exc()
        }), 500
    finally:
        if driver:
            driver.quit()

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)