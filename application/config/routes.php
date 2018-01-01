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


/* AUTH */
$route['login'] = 'Index/login';
$route['login/gagal'] = 'Index/login';

$route['register'] = 'Index/register';
$route['register/gagal'] = 'Index/register';
$route['register/sukses'] = 'Index/register';



/* ACCOUNT DASHBOARD */
// $route['account'] = 'Index/account';
// $route['account/alamat/tambahalamat'] = 'Index/add_address';
// $route['account/alamat/ubahalamat/(:num)'] = 'Index/edit_address/$1';

$route['dashboard'] = 'Index/dashboard';
$route['dashboard/daftaruser'] = 'Index/daftaruser';
$route['dashboard/adduser'] = 'Index/adduser';
$route['dashboard/adduser/sukses'] = 'Index/adduser';
$route['dashboard/adduser/gagal'] = 'Index/adduser';
$route['dashboard/sellerpending'] = 'Index/sellerpending';
$route['dashboard/addproduct'] = 'Index/product_add';
$route['dashboard/addproduct/sukses'] = 'Index/product_add';
$route['dashboard/addproduct/gagal'] = 'Index/product_add';

$route['dashboard/listproduct'] = 'Index/product_list';
$route['dashboard/editproduct/(:num)'] = 'Index/product_edit/$1';

$route['dashboard/addcategory'] = 'Index/cat_add';
$route['dashboard/addcategory/sukses'] = 'Index/cat_add';
$route['dashboard/addcategory/gagal'] = 'Index/cat_add';

$route['dashboard/listcategory'] = 'Index/cat_list';

$route['dashboard/pembelian'] = 'Index/pembelian';
$route['dashboard/pembelian/konfirmasitransfer/(:num)'] = 'Index/pembelian_konfirmasitrf/$1';
$route['dashboard/biodata'] = 'Index/biodata_edit';

$route['dashboard/alamat'] = 'Index/alamat_list';
$route['dashboard/alamat/add'] = 'Index/alamat_add';
$route['dashboard/alamat/edit/(:num)'] = 'Index/alamat_edit/$1';

$route['dashboard/toko'] = 'Index/toko';


/* MAIN PAGES */
$route['blog'] = 'Index/blog';
$route['about'] = 'Index/about';
$route['search'] = 'Index/search';
$route['category'] = 'Index/category';
$route['product'] = 'Index/product_view';
$route['cart'] = 'Index/cart';
$route['checkout'] = 'Index/checkout';