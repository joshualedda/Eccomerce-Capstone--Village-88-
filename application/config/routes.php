<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'catalogs';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'Users';
//login process
$route['login/process'] = 'Users/login';


//logout
$route['logout'] = 'Users/logout';



$route['signup'] = 'Users/register';
$route['signup'] = 'Users/registerProcess';
//Profile for user and admin
$route['profile'] = 'profile';
//User Profile
$route['account/profile'] = 'profile/userProfile';




//Admin Dashboard
$route['dashboard'] = 'dashboards';
//Admin Orders
$route['orders'] = 'orders';



//Admin Products
$route['products'] = 'products';
//Product New
$route['product/create'] = 'products/create';
//products serach filer
$route['product/search'] = 'products/index';






//Admin Categories
$route['category'] = 'categories';


//Product Catalog View
//it should be product name heree stil in development
$route['product/view/(:num)'] = 'catalogs/view/$1';
//Catalog Seach
$route['catalog/search'] = 'catalogs/index';


//Carts
$route['carts'] = 'carts';
