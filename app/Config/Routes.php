<?php namespace Config;

/**
 * --------------------------------------------------------------------
 * URI Routing
 * --------------------------------------------------------------------
 * This file lets you re-map URI requests to specific controller functions.
 *
 * Typically there is a one-to-one relationship between a URL string
 * and its corresponding controller class/method. The segments in a
 * URL normally follow this pattern:
 *
 *    example.com/class/method/id
 *
 * In some instances, however, you may want to remap this relationship
 * so that a different class/function is called than the one
 * corresponding to the URL.
 */

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 * The RouteCollection object allows you to modify the way that the
 * Router works, by acting as a holder for it's configuration settings.
 * The following methods can be called on the object to modify
 * the default operations.
 *
 *    $routes->defaultNamespace()
 *
 * Modifies the namespace that is added to a controller if it doesn't
 * already have one. By default this is the global namespace (\).
 *
 *    $routes->defaultController()
 *
 * Changes the name of the class used as a controller when the route
 * points to a folder instead of a class.
 *
 *    $routes->defaultMethod()
 *
 * Assigns the method inside the controller that is ran when the
 * Router is unable to determine the appropriate method to run.
 *
 *    $routes->setAutoRoute()
 *
 * Determines whether the Router will attempt to match URIs to
 * Controllers when no specific route has been defined. If false,
 * only routes that have been defined here will be available.
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');


/**
 * ADMIN
 */
$routes->get('/admin/home/', '\App\Controllers\Admin\Home::index');

$routes->get('/admin/user/', '\App\Controllers\Admin\User::index');
$routes->get('/admin/user/show/(:num)', '\App\Controllers\Admin\User::show/$1');
$routes->get('/admin/user/edit/(:num)', '\App\Controllers\Admin\User::edit/$1');
$routes->get('/admin/user/create', '\App\Controllers\Admin\User::create');
$routes->post('/admin/user', '\App\Controllers\Admin\User::store');
$routes->put('/admin/user', '\App\Controllers\Admin\User::update');

$routes->get('/admin/customer/', '\App\Controllers\Admin\Customer::index');
$routes->get('/admin/customer/show/(:num)', '\App\Controllers\Admin\Customer::show/$1');
$routes->get('/admin/customer/edit/(:num)', '\App\Controllers\Admin\Customer::edit/$1');
$routes->get('/admin/customer/create', '\App\Controllers\Admin\Customer::create');
$routes->post('/admin/customer', '\App\Controllers\Admin\Customer::store');
$routes->put('/admin/customer', '\App\Controllers\Admin\Customer::update');

$routes->get('/admin/file/', '\App\Controllers\Admin\File::index');
$routes->get('/admin/file/show/(:num)', '\App\Controllers\Admin\File::show/$1');
$routes->get('/admin/file/edit/(:num)', '\App\Controllers\Admin\File::edit/$1');
$routes->get('/admin/file/create', '\App\Controllers\Admin\File::create');
$routes->get('/admin/file/download', '\App\Controllers\Admin\File::download');
$routes->post('/admin/file', '\App\Controllers\Admin\File::store');
$routes->post('/admin/file/update', '\App\Controllers\Admin\File::update');

/**
 * CUSTOMER
 */
$routes->get('/customer/home/', 'App\Controllers\Customer\Home::index');
$routes->get('/customer/download/(:num)', 'App\Controllers\Customer\Home::download/$1');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
