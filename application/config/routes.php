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
$route['logout'] = 'User/logout';
$route['signup'] = 'UserProfile/signupform';
$route['signupsubmit'] = 'UserProfile/submit';
$route['suggestionform'] = 'User/suggestion_form';
$route['dashboard'] = 'User/dashboardview';
$route['submitsuggetions'] = 'User/submit_suggestion';
$route['store'] = 'User/store';
$route['addwebsite'] = 'WebsiteDetails/addwebsite';
$route['submitaddwebite'] = 'WebsiteDetails/store';
$route['storewebsite'] = 'WebsiteDetails/stored_website';  //Display the stored webite
$route['auto-login'] = 'WebsiteDetails/scrape_data'; //use for auto login 

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
$route['invoiceorder'] = 'WebsiteDetails/display_invoice_data';

//display open process data in website
$route['open-process-order'] = 'WebsiteDetails/display_open_data';

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
$route['forgot-password'] = 'User/forgot_password';
$route['send-reset-link'] = 'User/send_reset_link';
// $route['reset-password/(:any)'] = 'User/reset_password/$1'; 
$route['reset-password/(:num)'] = 'User/reset_password/$1';
$route['update-password'] = 'User/update_password';
// $route['update_password'] = 'User/update_password'; //for update password

