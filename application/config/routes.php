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
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'Admin/admin';
$route['admin/login'] = 'Admin/admin/login';
$route['admin/logout'] = 'Admin/admin/logout';
$route['admin/category']  =  'Admin/Category/Category';
$route['admin/category/(:num)'] = 'Admin/Category/Category/index/$1';
$route['admin/category/create'] = 'Admin/Category/Category/create';
$route['admin/category/store'] = 'Admin/Category/Category/store';
$route['admin/category/view/(:num)'] = 'Admin/Category/Category/show/$1';
$route['admin/category/edit/(:num)'] = 'Admin/Category/Category/edit/$1';
$route['admin/category/update/(:num)'] = 'Admin/Category/Category/update/$1';
$route['admin/category/destroy'] = 'Admin/Category/Category/destroy';
$route['admin/category/updateStatus'] = 'Admin/Category/Category/updateStatus';


$route['admin/user']  =  'Admin/User/User';
$route['admin/user/(:num)'] = 'Admin/User/User/index/$1';
$route['admin/user/create'] = 'Admin/User/User/create';
$route['admin/user/store'] = 'Admin/User/User/store';
$route['admin/user/view/(:num)'] = 'Admin/User/User/show/$1';
$route['admin/user/edit/(:num)'] = 'Admin/User/User/edit/$1';
$route['admin/user/update/(:num)'] = 'Admin/User/User/update/$1';
$route['admin/user/destroy'] = 'Admin/User/User/destroy';
$route['admin/user/updateStatus'] = 'Admin/User/User/updateStatus';


$route['admin/post']  = 'Admin/Post/Post';
$route['admin/post/(:num)'] ='Admin/Post/Post/index/$1';
$route['admin/post/create'] ='Admin/Post/Post/create';
$route['admin/post/store'] ='Admin/Post/Post/store';
$route['admin/post/view/(:num)'] ='Admin/Post/Post/show/$1';
$route['admin/post/edit/(:num)'] ='Admin/Post/Post/edit/$1';
$route['admin/post/update/(:num)'] ='Admin/Post/Post/update/$1';
$route['admin/post/destroy'] ='Admin/Post/Post/destroy';
$route['admin/post/updateStatus'] ='Admin/Post/Post/updateStatus';


$route['admin/page']  = 'Admin/Page/Page';
$route['admin/page/(:num)'] ='Admin/Page/Page/index/$1';
$route['admin/page/create'] ='Admin/Page/Page/create';
$route['admin/page/store'] ='Admin/Page/Page/store';
$route['admin/page/view/(:num)'] ='Admin/Page/Page/show/$1';
$route['admin/page/edit/(:num)'] ='Admin/Page/Page/edit/$1';
$route['admin/page/update/(:num)'] ='Admin/Page/Page/update/$1';
$route['admin/page/destroy'] ='Admin/Page/Page/destroy';
$route['admin/page/updateStatus'] ='Admin/Page/Page/updateStatus';


$route['admin/menu']  = 'Admin/Menu/Menu';
$route['admin/menu/(:num)'] ='Admin/Menu/Menu/index/$1';
$route['admin/menu/create'] ='Admin/Menu/Menu/create';
$route['admin/menu/store'] ='Admin/Menu/Menu/store';
$route['admin/menu/view/(:num)'] ='Admin/Menu/Menu/show/$1';
$route['admin/menu/edit/(:num)'] ='Admin/Menu/Menu/edit/$1';
$route['admin/menu/update/(:num)'] ='Admin/Menu/Menu/update/$1';
$route['admin/menu/destroy'] ='Admin/Menu/Menu/destroy';
$route['admin/menu/updateStatus'] ='Admin/Menu/Menu/updateStatus';



$route['admin/category_lang']  = 'Admin/Category/CategoryLang';
$route['admin/category_lang/(:num)'] ='Admin/Category/CategoryLang/index/$1';
$route['admin/category_lang/create'] ='Admin/Category/CategoryLang/create';
$route['admin/category_lang/store'] ='Admin/Category/CategoryLang/store';
$route['admin/category_lang/view/(:num)'] ='Admin/Category/CategoryLang/show/$1';
$route['admin/category_lang/edit/(:num)'] ='Admin/Category/CategoryLang/edit/$1';
$route['admin/category_lang/update/(:num)'] ='Admin/Category/CategoryLang/update/$1';
$route['admin/category_lang/destroy'] ='Admin/Category/CategoryLang/destroy';
$route['admin/category_lang/updateStatus'] ='Admin/Category/CategoryLang/updateStatus';



$route['Api/categories'] = 'Api/category/index';