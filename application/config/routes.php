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
|	https://codeigniter.com/user_guide/general/routing.html
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
| Examples:	my-controller/Index	-> my_controller/Index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Index/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*--------------------------------------------------*/

//profile

$route['account/profile'] = 'Index/account';
$route['u/(:any)'] = 'Index/profile/$1';
$route['u/(:any)/(:num)'] = 'Index/profile/$1/$2';

//profil-end


//profile

$route['dashboard/login'] = 'Index_Dashboard/adminlogin';
$route['dashboard/login/gagal'] = 'Index_Dashboard/adminlogin';

$route['login'] = 'Index/login';
$route['login/gagal'] = 'Index/login';

$route['register'] = 'Index/register';
$route['register/gagal'] = 'Index/register';
// $route['register/sukses'] = 'Index/register';

//profile-end

//product 

$route['account/product/tambah'] = 'Index/product_add';
$route['account/product/tambah/sukses'] = 'Index/product_add';
$route['account/product/tambah/gagal'] = 'Index/product_add';
$route['account/product/edit/(:num)'] = 'Index/product_edit/$1';
$route['account/product/edit/(:num)/gagal'] = 'Index/product_edit/$1';

$route['product/(:any)'] = 'Index/product_view/$1';
$route['product/(:any)/(:num)'] = 'Index/product_view/$1/$2';

//product-end

//alamat

$route['account/alamat/tambah'] = 'Index/alamat_add';
$route['account/alamat/edit/(:num)'] = 'Index/alamat_edit/$1';

//alamat-end

//messages

$route['account/messages'] = 'Index/msg_all';
$route['account/messages/new/(:num)'] = 'Index/msg_convo/$1';
$route['account/messages/convo/(:any)'] = 'Index/msg_convo/$1';

//messages-end



/* MAIN PAGES */
// $route['blog'] = 'Index/blog';
$route['about'] = 'Index/about';
$route['search'] = 'Index/search';
$route['search/(:num)'] = 'Index/search/$1';

//shopping

$route['shopping/all'] = 'Index/shopping';
$route['shopping/all/(:num)'] = 'Index/shopping/$1';
$route['shopping/cart'] = 'Index/cart';
$route['shopping/order'] = 'Index/order';
$route['shopping/category/(:any)'] = 'Index/shopping/$1';
$route['shopping/category/(:any)/(:num)'] = 'Index/shopping/$1/$2';

$route['order/details/(:num)'] = 'Index/orderdetails/$1';

//shopping-end


/* ADMIN DASHBOARD */

$route['dashboard'] = 'Index_Dashboard/dashboard';

$route['dashboard/account'] = 'Index_Dashboard/account';

//pending_approval

$route['dashboard/pendingapproval/seller'] = 'Index_Dashboard/sellerpending';
$route['dashboard/pendingapproval/reseller'] = 'Index_Dashboard/resellerpending';

//pending_approval end

//reports

$route['dashboard/reports/withdraw'] = 'Index_Dashboard/withdrawreports';
$route['dashboard/reports/transaction'] = 'Index_Dashboard/transactionreports';
$route['dashboard/reports/refund'] = 'Index_Dashboard/refundreports';

$route['dashboard/reports/exceeddeadline/delivery'] = 'Index_Dashboard/exceeddelivery';
$route['dashboard/reports/exceeddeadline/delivered'] = 'Index_Dashboard/exceeddelivered';

//reports-end

//category

$route['dashboard/category'] = 'Index_Dashboard/cat_list';
$route['dashboard/category/add'] = 'Index_Dashboard/cat_add';
$route['dashboard/category/add/sukses'] = 'Index_Dashboard/cat_add';
$route['dashboard/category/add/gagal'] = 'Index_Dashboard/cat_add';
$route['dashboard/category/edit/(:num)'] = 'Index_Dashboard/cat_edit/$1';
$route['dashboard/category/edit/(:num)/gagal'] = 'Index_Dashboard/cat_edit/$1';

//category-end

//bank

$route['dashboard/bank'] = 'Index_Dashboard/bank_list';
$route['dashboard/bank/add'] = 'Index_Dashboard/bank_add';
$route['dashboard/bank/add/sukses'] = 'Index_Dashboard/bank_add';
$route['dashboard/bank/add/gagal'] = 'Index_Dashboard/bank_add';
$route['dashboard/bank/edit/(:num)'] = 'Index_Dashboard/bank_edit/$1';
$route['dashboard/bank/(:num)/gagal'] = 'Index_Dashboard/bank_edit/$1';

//bank-end

//user management

$route['dashboard/users'] = 'Index_Dashboard/user_list';
$route['dashboard/users/add'] = 'Index_Dashboard/user_add';
$route['dashboard/users/add/sukses'] = 'Index_Dashboard/user_add';
$route['dashboard/users/add/gagal'] = 'Index_Dashboard/user_add';
$route['dashboard/users/edit/(:num)'] = 'Index_Dashboard/user_edit/$1';
$route['dashboard/users/edit/(:num)/gagal'] = 'Index_Dashboard/user_edit/$1';

//user management-end

/* ADMIN DASHBOARD END */