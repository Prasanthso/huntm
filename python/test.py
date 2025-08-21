import os
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import pandas as pd
import time
import pickle
from bs4 import BeautifulSoup
from selenium.webdriver.common.action_chains import ActionChains
import random

# Configuration
USERNAME = "0000298013_01"
PASSWORD = "Reva*1234"
LOGIN_URL = "https://access.ex.indianoil.in/oam/server/obrareq.cgi?encquery%3D8JDuX7m5GTn0urPrhrLB7tpfhXlEzsMc3yZM5JbHQ5F2izqIPDQ2Tf9C0kQ27MVzpl2OYxMkTYtahUOSQpKrLvF%2BKcMciJjPzE9fvAVoZIHp2rQ%2FpNf5B%2BjY17WvXUWVvTkQbQczhGFCJtdhtXDnIkD8IEf67yhWEb7XvDFBHhNvbhK%2F3HgdJB0lQkEdysKjfD5OnO2JnVeH6BaghQcrjcrFlncBACfC3fciZs%2BFKgMaNjSL%2FGLxHwi5W6PYUdUUTqSuknwP4oa%2FBC1GhcHinKrC1cGJJo2nzncPNZ%2B0vGLID1HVq69idpsNeT%2FovRti%2BAX4EXkLiXAziP2Xb4QImw%3D%3D%20agentid%3DSIEBEL_IP24%20ver%3D1%20crmethod%3D2%26cksum%3D86f442ca9b932cd15421d389231acc8c698cde25&ECID-Context=1.006BxESH%5EAIBl3o5oV5EiY00EY2Y00Szi5%3BkXjE"
TARGET_URL = "https://sdms.px.indianoil.in/siebel/app/edealer/enu/?SWECmd=GotoView&SWEView=EPIC+Order+Summary+View&SWERF=1&SWEHo=&SWEBU=1&SWEApplet0=EPIC+Partner+Count+List+Applet&SWERowId0=2-10ZM-37741"

def human_like_delay(min_sec=1, max_sec=3):
    """Random delay to mimic human behavior"""
    time.sleep(random.uniform(min_sec, max_sec))

def setup_driver():
    options = Options()
    options.add_argument("--disable-gpu")
    options.add_argument("--no-sandbox")
    options.add_argument("--window-size=1920,1080")
    options.add_argument("--disable-dev-shm-usage")
    options.add_argument("--disable-blink-features=AutomationControlled")
    options.add_experimental_option("excludeSwitches", ["enable-automation"])
    options.add_experimental_option('useAutomationExtension', False)
    user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
    options.add_argument(f"user-agent={user_agent}")
    try:
        service = Service()
        driver = webdriver.Chrome(service=service, options=options)
        driver.execute_cdp_cmd("Page.addScriptToEvaluateOnNewDocument", {
            "source": """
                Object.defineProperty(navigator, 'webdriver', {get: () => undefined});
            """
        })
        return driver
    except Exception as e:
        print(f"Driver initialization failed: {e}")
        raise

def human_like_type(element, text):
    """Type text in a human-like manner"""
    for char in text:
        element.send_keys(char)
        time.sleep(random.uniform(0.05, 0.3))
    human_like_delay()

def analyze_page(driver):
    """Detailed page analysis for debugging"""
    timestamp = time.strftime("%Y%m%d-%H%M%S")
    with open(f"page_analysis_{timestamp}.html", "w", encoding="utf-8") as f:
        f.write(driver.page_source)
    driver.save_screenshot(f"page_screenshot_{timestamp}.png")
    soup = BeautifulSoup(driver.page_source, 'html.parser')
    print("\nPage Analysis:")
    print(f"Title: {driver.title}")
    print(f"URL: {driver.current_url}")
    print(f"Forms: {len(soup.find_all('form'))}")
    print(f"Inputs: {len(soup.find_all('input'))}")
    print(f"IFrames: {len(soup.find_all('iframe'))}")
    print(f"Buttons: {len(soup.find_all('button'))}")
    error_elements = soup.select(".error, .alert, .message")
    if error_elements:
        print("Potential error messages found:")
        for elem in error_elements:
            print(f" - {elem.get_text(strip=True)}")

def find_login_elements(driver):
    """Find login elements with robust waits and multiple strategies"""
    def get_element(by, value, name):
        try:
            element = WebDriverWait(driver, 10).until(
                EC.element_to_be_clickable((by, value))
            )
            print(f"Found {name} with {by}: {value}")
            return element
        except Exception as e:
            print(f"Failed to find {name} with {by}: {value} - {e}")
            return None

    try:
        WebDriverWait(driver, 30).until(
            EC.presence_of_element_located((By.ID, "username"))
        )
    except Exception as e:
        print(f"Login form not found after waiting: {e}")
        raise

    username = get_element(By.ID, "username", "username") or get_element(By.NAME, "username", "username")
    password = get_element(By.ID, "password", "password") or get_element(By.NAME, "password", "password")
    submit = (
        get_element(By.CSS_SELECTOR, "button[type='submit']", "submit") or
        get_element(By.CSS_SELECTOR, "button", "submit") or
        get_element(By.XPATH, "//button[contains(text(), 'Login') or contains(text(), 'Sign In') or contains(text(), 'Submit')]", "submit") or
        get_element(By.XPATH, "//input[@value='Login' or @value='Sign In' or @value='Submit']", "submit")
    )

    if username and password and submit:
        return username, password, submit
    raise Exception("Could not find all login elements")

def perform_login(driver, username, password, submit):
    """Perform login with retry mechanism for stale elements"""
    max_attempts = 3
    attempt = 1

    while attempt <= max_attempts:
        try:
            print(f"Login attempt {attempt}/{max_attempts}")
            WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.ID, "username")))
            username.clear()
            human_like_delay(0.5, 1)
            password.clear()
            human_like_delay(0.5, 1)

            human_like_type(username, USERNAME)
            human_like_type(password, PASSWORD)

            action = ActionChains(driver)
            action.move_to_element(submit).pause(random.uniform(0.5, 2.0)).click().perform()
            human_like_delay(5, 8)

            try:
                error_msg = WebDriverWait(driver, 5).until(
                    EC.presence_of_element_located((By.CSS_SELECTOR, ".error, .alert, .message"))
                )
                raise Exception(f"Login failed: {error_msg.text}")
            except:
                pass

            if "login" in driver.current_url.lower():
                print("Redirected back to login page, retrying...")
                raise Exception("Login failed - redirected back to login page")
            
            print("Login successful")
            return True

        except Exception as e:
            print(f"Login attempt {attempt} failed: {e}")
            if attempt == max_attempts:
                raise Exception("Max login attempts reached")
            try:
                WebDriverWait(driver, 10).until(
                    EC.presence_of_element_located((By.ID, "username"))
                )
                username, password, submit = find_login_elements(driver)
            except Exception as e:
                print(f"Failed to re-locate elements: {e}")
                raise
            attempt += 1
            human_like_delay(2, 4)

def extract_invoiced_orders_data(driver):
    """Extract data from the Invoiced Orders By Service Area table with pagination"""
    print("Extracting Invoiced Orders By Service Area data...")
    try:
        WebDriverWait(driver, 20).until(
            EC.presence_of_element_located((By.ID, "s_3_l"))
        )
        
        all_data = []
        page = 1
        
        while True:
            print(f"Processing page {page} of Invoiced Orders...")
            table = driver.find_element(By.ID, "s_3_l")
            rows = table.find_elements(By.TAG_NAME, "tr")
            
            for row in rows[1:]:
                cells = row.find_elements(By.TAG_NAME, "td")
                if len(cells) >= 4:
                    all_data.append({
                        'Area Name': cells[1].text.strip(),
                        'CashMemo Generated': cells[2].text.strip(),
                        'Status': cells[3].text.strip()
                    })
            
            try:
                row_counter = driver.find_element(By.ID, "s_3_rc").text.strip()
                print(f"Row counter: {row_counter}")
                if "of" in row_counter:
                    total = int(row_counter.split("of")[-1].strip().split()[-1])
                    if len(all_data) >= total:
                        print(f"Collected all {total} records")
                        break
            except Exception as e:
                print(f"Error reading row counter: {e}")

            try:
                next_button = driver.find_element(By.ID, "next_pager_s_3_l")
                if "ui-state-disabled" in next_button.get_attribute("class"):
                    print("Reached last page of Invoiced Orders")
                    break
                
                ActionChains(driver).move_to_element(next_button).pause(1).click().perform()
                human_like_delay(3, 5)
                WebDriverWait(driver, 10).until(
                    EC.staleness_of(rows[0])
                )
                page += 1
                
            except Exception as e:
                print(f"Error navigating to next page: {e}")
                break
        
        return all_data
        
    except Exception as e:
        print(f"Error extracting Invoiced Orders data: {e}")
        driver.save_screenshot("invoiced_orders_error.png")
        return []

def extract_open_orders_data(driver):
    """Extract data from the Open Orders By Service Area table with pagination"""
    print("Extracting Open Orders By Service Area data...")
    try:
        WebDriverWait(driver, 20).until(
            EC.presence_of_element_located((By.ID, "s_4_l"))
        )
        
        all_data = []
        page = 1
        
        row_counter = driver.find_element(By.ID, "s_4_rc").text.strip()
        if row_counter == "No Records":
            print("No records found in Open Orders By Service Area")
            return all_data
        
        while True:
            print(f"Processing page {page} of Open Orders...")
            table = driver.find_element(By.ID, "s_4_l")
            rows = table.find_elements(By.TAG_NAME, "tr")
            
            for row in rows[1:]:
                cells = row.find_elements(By.TAG_NAME, "td")
                if len(cells) >= 3:
                    all_data.append({
                        'Area Name': cells[1].text.strip(),
                        'Open Refill Orders': cells[2].text.strip()
                    })
            
            try:
                row_counter = driver.find_element(By.ID, "s_4_rc").text.strip()
                print(f"Row counter: {row_counter}")
                if "of" in row_counter:
                    total = int(row_counter.split("of")[-1].strip().split()[-1])
                    if len(all_data) >= total:
                        print(f"Collected all {total} records")
                        break
            except Exception as e:
                print(f"Error reading row counter: {e}")

            try:
                next_button = driver.find_element(By.ID, "next_pager_s_4_l")
                if "ui-state-disabled" in next_button.get_attribute("class"):
                    print("Reached last page of Open Orders")
                    break
                
                ActionChains(driver).move_to_element(next_button).pause(1).click().perform()
                human_like_delay(3, 5)
                WebDriverWait(driver, 10).until(
                    EC.staleness_of(rows[0])
                )
                page += 1
                
            except Exception as e:
                print(f"Error navigating to next page: {e}")
                break
        
        return all_data
        
    except Exception as e:
        print(f"Error extracting Open Orders data: {e}")
        driver.save_screenshot("open_orders_error.png")
        return []

def main():
    print("Initializing Chrome Driver...")
    driver = setup_driver()
    
    try:
        print("Opening login page...")
        max_page_attempts = 3
        for attempt in range(1, max_page_attempts + 1):
            try:
                driver.get(LOGIN_URL)
                human_like_delay(3, 5)
                WebDriverWait(driver, 30).until(
                    lambda d: d.execute_script("return document.readyState") == "complete"
                )
                analyze_page(driver)
                try:
                    WebDriverWait(driver, 10).until(
                        EC.presence_of_element_located((By.ID, "username"))
                    )
                    break
                except:
                    print(f"Login form not found on attempt {attempt}/{max_page_attempts}")
                    if attempt == max_page_attempts:
                        raise Exception("Failed to find login form after multiple attempts")
                    print("Retrying page load...")
                    human_like_delay(2, 4)
            except Exception as e:
                print(f"Page load attempt {attempt} failed: {e}")
                if attempt == max_page_attempts:
                    raise Exception("Failed to load login page after multiple attempts")
                human_like_delay(2, 4)

        print("Checking for iframes...")
        iframes = driver.find_elements(By.TAG_NAME, "iframe")
        if iframes:
            print(f"Found {len(iframes)} iframes - checking each")
            for i, iframe in enumerate(iframes):
                try:
                    driver.switch_to.frame(iframe)
                    print(f"Switched to iframe {i}")
                    username, password, submit = find_login_elements(driver)
                    perform_login(driver, username, password, submit)
                    driver.switch_to.default_content()
                    break
                except Exception as e:
                    print(f"Couldn't login in iframe {i}: {e}")
                    driver.switch_to.default_content()
        
        print("Attempting main page login...")
        username, password, submit = find_login_elements(driver)
        perform_login(driver, username, password, submit)
        
        print("Verifying login success...")
        if "login" in driver.current_url.lower():
            raise Exception("Login failed or timeout occurred")
        
        print("Login successful, navigating directly to target page...")
        driver.save_screenshot("post_login.png")
        pickle.dump(driver.get_cookies(), open("cookies.pkl", "wb"))
        
        driver.get(TARGET_URL)
        human_like_delay(5, 8)
        WebDriverWait(driver, 30).until(
            lambda d: d.execute_script("return document.readyState") == "complete"
        )
        print("Reached target page")
        
        print("Attempting data extraction...")
        try:
            invoiced_orders_data = extract_invoiced_orders_data(driver)
            open_orders_data = extract_open_orders_data(driver)
            
            if invoiced_orders_data:
                df_invoiced = pd.DataFrame(invoiced_orders_data)
                print("\nInvoiced Orders Data (Total Records:", len(df_invoiced), "):")
                print(df_invoiced)
                df_invoiced.to_csv("invoiced_orders.csv", index=False)
                print("\nInvoiced orders data saved successfully")
            else:
                print("\nNo Invoiced Orders data extracted")
            
            if open_orders_data:
                df_open_orders = pd.DataFrame(open_orders_data)
                print("\nOpen Orders By Service Area Data (Total Records:", len(df_open_orders), "):")
                print(df_open_orders)
                df_open_orders.to_csv("open_orders_by_service_area.csv", index=False)
                print("\nOpen orders data saved successfully")
            else:
                print("\nNo Open Orders data extracted")
            
        except Exception as e:
            print(f"Data extraction failed: {e}")
            driver.save_screenshot("data_extraction_failed.png")
            raise
            
    except Exception as e:
        print(f"Script failed: {e}")
        driver.save_screenshot("error_screenshot.png")
    finally:
        print("Quitting driver...")
        driver.quit()

if __name__ == "__main__":
    main()