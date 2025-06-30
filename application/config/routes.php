<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'User';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// $route['login'] = 'loginform/login';
// $route['login_submit'] = 'loginform/login_submit';
// $route['logout'] = 'Loginform/logout';
// $route['forgot-password'] = 'Forgotpassword';
// $route['reset-password/(:any)'] = 'Forgotpassword/reset_password';

$route['loginform'] = 'User/login';
$route['loginuser'] = 'User/login_user';
$route['logout'] = 'User_profile/logout';
$route['signup'] = 'UserProfile/signupform';
$route['signupsubmit'] = 'UserProfile/submit';
$route['suggestionform'] = 'User/suggestion_form';
$route['dashboard'] = 'User/dashboardview';
$route['submitsuggetions'] = 'User/submit_suggestion';
$route['store'] = 'User/store';
// $route['addwebsite'] = 'WebsiteDetails/addwebsite';
// $route['submitaddwebite'] = 'WebsiteDetails/store';
$route['addwebsite'] = 'User/add_website';
$route['submitaddwebite'] = 'User/submit_add_website';
$route['edit-website'] = 'User/edit_website';
$route['delete-website'] = 'User/delete_website';
// $route['storewebsite'] = 'WebsiteDetails/stored_website'; 
// $route['auto-login'] = 'WebsiteDetails/scrape_data'; 
$route['storewebsite'] = 'User/stored_website'; 
$route['auto-login'] = 'User/scrape_data'; 

//display bireport data
// $route['store_bireport_data'] = 'User/bireport_store_data';
$route['upload_bireport_file'] = 'User/bireport_scrape_data';

$route['show'] = 'Dashboard/show';
$route['login/authenticate'] = 'login/authenticate';

//Invoiced Order upload file
$route['WebScrapping'] = 'WebScrapping/webscrapping_data'; 
$route['uploadfile'] = 'WebScrapping/upload_excel';

//open Order upload file
$route['OpenOrder'] = 'OpenOrder/openorder_data';  
$route['uploadfile_openorder'] = 'OpenOrder/upload_excel';  

//fund balance upload file
$route['fundbalance'] = 'FundBalance/fundbalance_data';
$route['fundbalance_uploadfile'] = 'FundBalance/upload_excel';

//Customer register upload file
$route['customerregister'] = 'CustomerRegister/customerregister_data';
$route['customerregister_uploadfile'] = 'CustomerRegister/upload_excel';

//display invoice data in website
// $route['invoiceorder'] = 'User/display_invoice_data';
$route['invoiceorder'] = 'User/merged_data';

//display open process data in website
$route['open-process-order'] = 'User/display_open_data';

//display fund balance data in website
$route['fundbalance_data'] = 'FundBalance/display_fundbalance';

//Display customer strength
$route['customer_strength'] = 'customer_strength/customer_strength_data';

//Display SBC Data
$route['SBC_data'] = 'SBC_data/sbc_data_report';

//Display Nillfill data
$route['nillfill'] = 'NilRefill/nill_fill_data';

//Display KYC data
$route['kycdata'] = 'Kyc_data/kyc_data';

//Display MI Due data
$route['midue'] = 'MI_due_data/midue_data';

//Display hose due data
$route['hosedue'] = 'Hosedue_data/hose_due_data';

// Display Phone number not avaliable data
$route['phonenumber'] = 'Phonenumber/phonenumber_data';

//Forgot password
$route['forgot-password'] = 'User/forgot_password_view';
// $route['send-reset-link'] = 'User/send_reset_link';
$route['send-otp'] = 'User/send_otp';

// Routes for OTP verification (Next step after sending OTP)
$route['verify-otp-view'] = 'User/verify_otp_view'; // Displays the form to enter OTP
$route['verify-otp'] = 'User/verify_otp';           // Handles OTP verification submission

// Routes for Password Reset (Final step after OTP verification)
$route['reset-password/(:any)'] = 'User/reset_password_view/$1'; // Displays the reset password form (with token/ID)
$route['update-password'] = 'User/update_password';             // Handles new password submission

// $route['reset-password/(:any)'] = 'User/reset_password/$1'; 
// $route['reset-password/(:num)'] = 'User/reset_password/$1';
// $route['update-password'] = 'User/update_password';
// $route['update_password'] = 'User/update_password'; //for update password

$route['user_profile_signup'] = 'User_profile/signup_form';
$route['user_profile_signup_submit'] = 'User_profile/process_signup';
$route['user_profile_login'] = 'User_profile/login_form';
$route['user_profile_login_submit'] = 'User_profile/process_login';
$route['admin_data'] = 'Admindashboard/get_admin_data';
