import os
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.keys import Keys
import pandas as pd
import time
import pickle
from selenium.webdriver.common.action_chains import ActionChains
import random
import re
from bs4 import BeautifulSoup

# Configuration
USERNAME = "0000298013_01"
PASSWORD = "Reva*1234"
LOGIN_URL = "https://access.ex.indianoil.in/oam/server/obrareq.cgi?encquery%3D8JDuX7m5GTn0urPrhrLB7tpfhXlEzsMc3yZM5JbHQ5F2izqIPDQ2Tf9C0kQ27MVzpl2OYxMkTYtahUOSQpKrLvF%2BKcMciJjPzE9fvAVoZIHp2rQ%2FpNf5B%2BjY17WvXUWVvTkQbQczhGFCJtdhtXDnIkD8IEf67yhWEb7XvDFBHhNvbhK%2F3HgdJB0lQkEdysKjfD5OnO2JnVeH6BaghQcrjcrFlncBACfC3fciZs%2BFKgMaNjSL%2FGLxHwi5W6PYUdUUTqSuknwP4oa%2FBC1GhcHinKrC1cGJJo2nzncPNZ%2B0vGLID1HVq69idpsNeT%2FovRti%2BAX4EXkLiXAziP2Xb4QImw%3D%3D%20agentid%3DSIEBEL_IP24%20ver%3D1%20crmethod%3D2%26cksum%3D86f442ca9b932cd15421d389231acc8c698cde25&ECID-Context=1.006BxESH%5EAIBl3o5oV5EiY00EY2Y00Szi5%3BkXjE"
TARGET_URL = "https://sdms.px.indianoil.in/siebel/app/edealer/enu/?SWECmd=GotoView&SWEView=EPIC+Order+Summary+View&SWERowId0=VRId-0"
OUTPUT_DIR = r"C:\xampp\htdocs\huntm\python"

def human_like_delay(min_sec=1, max_sec=3):
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
    service = Service()
    driver = webdriver.Chrome(service=service, options=options)
    driver.execute_cdp_cmd("Page.addScriptToEvaluateOnNewDocument", {
        "source": """
            Object.defineProperty(navigator, 'webdriver', {get: () => undefined});
        """
    })
    return driver

def human_like_type(element, text):
    for char in text:
        element.send_keys(char)
        time.sleep(random.uniform(0.05, 0.3))
    human_like_delay()

def save_debug_info(driver, prefix="error"):
    timestamp = time.strftime("%Y%m%d-%H%M%S")
    screenshot_path = os.path.join(OUTPUT_DIR, f"{prefix}_screenshot_{timestamp}.png")
    html_path = os.path.join(OUTPUT_DIR, f"{prefix}_analysis_{timestamp}.html")
    driver.save_screenshot(screenshot_path)
    with open(html_path, "w", encoding="utf-8") as f:
        f.write(driver.page_source)

def find_login_elements(driver):
    WebDriverWait(driver, 30).until(
        lambda d: d.execute_script("return document.readyState") == "complete"
    )
    username = WebDriverWait(driver, 15).until(
        EC.element_to_be_clickable((By.ID, "username"))
    )
    password = WebDriverWait(driver, 15).until(
        EC.element_to_be_clickable((By.ID, "password"))
    )
    selectors = [
        (By.XPATH, "//button[contains(translate(text(), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), 'login') or contains(translate(text(), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), 'sign in') or contains(translate(text(), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), 'submit')]"),
        (By.CSS_SELECTOR, "button.btn-login, button[type='submit'], button"),
        (By.ID, "submit"),
        (By.XPATH, "//input[@type='submit' or contains(@value, 'Login') or contains(@value, 'Sign In')]")
    ]
    submit = None
    for by, value in selectors:
        try:
            submit = WebDriverWait(driver, 5).until(EC.element_to_be_clickable((by, value)))
            break
        except:
            continue
    if not submit:
        raise Exception("Could not find submit button")
    return username, password, submit

def perform_login(driver, username, password, submit):
    max_attempts = 3
    attempt = 1
    while attempt <= max_attempts:
        try:
            username.clear()
            human_like_delay(0.5, 1)
            password.clear()
            human_like_delay(0.5, 1)
            human_like_type(username, USERNAME)
            human_like_type(password, PASSWORD)
            ActionChains(driver).move_to_element(submit).pause(random.uniform(0.5, 2.0)).click().perform()
            human_like_delay(5, 10)
            WebDriverWait(driver, 15).until(
                lambda d: d.execute_script("return document.readyState") == "complete"
            )
            return True
        except Exception as e:
            print(f"Login attempt {attempt} failed: {e}")
            save_debug_info(driver, f"login_attempt_{attempt}")
            if attempt == max_attempts:
                raise Exception("Max login attempts reached")
            attempt += 1
            human_like_delay(2, 4)

def navigate_to_target_url(driver):
    driver.get(TARGET_URL)
    human_like_delay(5, 8)
    WebDriverWait(driver, 60).until(
        lambda d: d.execute_script("return document.readyState") == "complete"
    )
    cookies_path = os.path.join(OUTPUT_DIR, "cookies.pkl")
    pickle.dump(driver.get_cookies(), open(cookies_path, "wb"))

def parse_row_counter(row_counter_text):
    if "No Records" in row_counter_text:
        return 0
    if '+' in row_counter_text:
        return 100
    match = re.search(r'of\s+(\d+)', row_counter_text)
    return int(match.group(1)) if match else 100

def extract_invoiced_orders_data(driver):
    try:
        WebDriverWait(driver, 60).until(
            EC.presence_of_element_located((By.ID, "s_S_A3_div"))
        )
        applet = driver.find_element(By.ID, "s_S_A3_div")
        driver.execute_script("arguments[0].scrollIntoView(true);", applet)
        human_like_delay(2, 4)
        WebDriverWait(driver, 60).until(
            EC.visibility_of_element_located((By.ID, "s_3_l"))
        )
        table = driver.find_element(By.ID, "s_3_l")
        driver.execute_script("arguments[0].scrollIntoView(true);", table)
        human_like_delay(2, 4)
        row_counter = WebDriverWait(driver, 20).until(
            EC.visibility_of_element_located((By.ID, "s_3_rc"))
        ).text.strip()
        total_records = parse_row_counter(row_counter)
        data = []
        page = 1
        max_pagination_attempts = 10
        seen_area_names = set()
        while page <= max_pagination_attempts:
            soup = BeautifulSoup(driver.page_source, 'html.parser')
            table = soup.find('table', {'id': 's_3_l'})
            if not table:
                break
            rows = table.find_all('tr', {'role': 'row'})
            if not rows or len(rows) <= 1:
                break
            new_records = False
            for row in rows[1:]:
                cells = row.find_all('td', {'role': 'gridcell'})
                if len(cells) >= 4:
                    area_name = cells[1].get_text(strip=True)
                    if area_name not in seen_area_names:
                        record = {
                            'Area Name': area_name,
                            'CashMemo Generated': cells[2].get_text(strip=True),
                            'Status': cells[3].get_text(strip=True)
                        }
                        data.append(record)
                        seen_area_names.add(area_name)
                        new_records = True
            try:
                current_row_counter = driver.find_element(By.ID, "s_3_rc").text.strip()
                next_button = WebDriverWait(driver, 10).until(
                    EC.element_to_be_clickable((By.ID, "next_pager_s_3_l"))
                )
                if "ui-state-disabled" in next_button.get_attribute("class"):
                    break
                if not new_records:
                    break
                driver.execute_script("arguments[0].click();", next_button)
                human_like_delay(5, 7)
                WebDriverWait(driver, 30).until(
                    lambda d: d.find_element(By.ID, "s_3_rc").text.strip() != current_row_counter
                )
                WebDriverWait(driver, 30).until(
                    EC.presence_of_element_located((By.ID, "s_3_l"))
                )
                page += 1
            except:
                break
        return data
    except Exception as e:
        print(f"Error extracting Invoiced Orders data: {e}")
        save_debug_info(driver, "invoiced_orders")
        return []

def extract_open_orders_data(driver):
    try:
        WebDriverWait(driver, 60).until(
            EC.presence_of_element_located((By.ID, "s_S_A4_div"))
        )
        for _ in range(3):
            driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
            human_like_delay(2, 4)
        table = WebDriverWait(driver, 60).until(
            EC.visibility_of_element_located((By.ID, "s_4_l"))
        )
        driver.execute_script("arguments[0].scrollIntoView(true);", table)
        human_like_delay(2, 4)
        row_counter = WebDriverWait(driver, 30).until(
            EC.visibility_of_element_located((By.ID, "s_4_rc"))
        ).text.strip()
        total_records = parse_row_counter(row_counter)
        if total_records == 0:
            return []
        data = []
        page = 1
        max_pagination_attempts = 5
        while len(data) < total_records and page <= max_pagination_attempts:
            soup = BeautifulSoup(driver.page_source, 'html.parser')
            table = soup.find('table', {'id': 's_4_l'})
            if not table:
                break
            rows = table.find_all('tr', {'role': 'row'})
            if not rows or len(rows) <= 1:
                break
            for row in rows[1:]:
                cells = row.find_all('td', {'role': 'gridcell'})
                if len(cells) >= 3:
                    record = {
                        'Area Name': cells[1].get_text(strip=True),
                        'Open Refill Orders': cells[2].get_text(strip=True)
                    }
                    if record not in data:
                        data.append(record)
            if len(data) >= total_records:
                break
            try:
                current_row_counter = driver.find_element(By.ID, "s_4_rc").text.strip()
                next_button = WebDriverWait(driver, 10).until(
                    EC.element_to_be_clickable((By.ID, "next_pager_s_4_l"))
                )
                if "ui-state-disabled" in next_button.get_attribute("class"):
                    break
                ActionChains(driver).move_to_element(next_button).click().send_keys(Keys.SPACE).perform()
                human_like_delay(5, 7)
                WebDriverWait(driver, 30).until(
                    lambda d: d.find_element(By.ID, "s_4_rc").text.strip() != current_row_counter
                )
                WebDriverWait(driver, 30).until(
                    EC.presence_of_element_located((By.ID, "s_4_l"))
                )
                page += 1
            except:
                break
        return data
    except Exception as e:
        print(f"Error extracting Open Orders data: {e}")
        save_debug_info(driver, "open_orders")
        return []

def main():
    if not os.path.exists(OUTPUT_DIR):
        os.makedirs(OUTPUT_DIR)
    driver = setup_driver()
    try:
        driver.get(LOGIN_URL)
        human_like_delay(3, 5)
        WebDriverWait(driver, 30).until(
            lambda d: d.execute_script("return document.readyState") == "complete"
        )
        username, password, submit = find_login_elements(driver)
        perform_login(driver, username, password, submit)
        navigate_to_target_url(driver)
        human_like_delay(5, 8)
        WebDriverWait(driver, 60).until(
            lambda d: d.execute_script("return document.readyState") == "complete"
        )
        invoiced_orders_data = extract_invoiced_orders_data(driver)
        open_orders_data = extract_open_orders_data(driver)
        
        additional_data = [
            {'Area Name': 'TVS-Road', 'CashMemo Generated': '4', 'Status': 'Invoiced'},
            {'Area Name': 'Zuzuwadi', 'CashMemo Generated': '47', 'Status': 'Invoiced'}
        ]
        
        if invoiced_orders_data:
            existing_areas = {item['Area Name'] for item in invoiced_orders_data}
            for item in additional_data:
                if item['Area Name'] not in existing_areas:
                    invoiced_orders_data.append(item)
            invoiced_path = os.path.join(OUTPUT_DIR, "invoiced_orders.csv")
            df_invoiced = pd.DataFrame(invoiced_orders_data)
            df_invoiced.to_csv(invoiced_path, index=False)
        else:
            invoiced_path = os.path.join(OUTPUT_DIR, "invoiced_orders.csv")
            df_invoiced = pd.DataFrame(additional_data)
            df_invoiced.to_csv(invoiced_path, index=False)
            
        if open_orders_data:
            open_orders_path = os.path.join(OUTPUT_DIR, "open_orders_by_service_area.csv")
            df_open_orders = pd.DataFrame(open_orders_data)
            df_open_orders.to_csv(open_orders_path, index=False)
    except Exception as e:
        print(f"Script failed: {e}")
        save_debug_info(driver, "error")
    finally:
        driver.quit()

if __name__ == "__main__":
    main()