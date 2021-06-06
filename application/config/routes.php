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


$route['archive/(:any)/(:any)/(:any)'] = 'archive/index/$1/$2/$3';
$route['ask-us-a-question'] = 'ask_us_a_question/index';
$route['solar-savings-calculator'] = 'solar_savings_calculator/index';
$route['contact-us'] = 'contact_us/index';
$route['news/(:any)'] = 'news/index/$1';
$route['article/(:any)'] = 'article/index/$1';
//$route['article/(:any)/(:any)'] = 'article/index/$1/$2';
$route['category/(:any)'] = 'category/index/$1';
$route['category/(:any)/(:any)'] = 'category/index/$1/$2';
$route['search/(:any)'] = 'search/index/$1';
$route['poll/(:any)/(:any)'] = 'poll/index/$1/$2';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

require_once( BASEPATH .'database/DB.php' );
$db =& DB();
$query = $db->get( 'routes' );
$result = $query->result();

foreach( $result as $row )
{
    $route["{$row->slug}"]              = $row->controller;
    $route["{$row->slug}/:any"]         = $row->controller;
    $route["{$row->controller}"]        = 'error404';
    $route["{$row->controller}/:any"]   = 'error404';
}

