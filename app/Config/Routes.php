<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
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
$routes->get('/customer/home/', '\App\Controllers\Customer\Home::index');
$routes->get('/customer/download/(:num)', '\App\Controllers\Customer\Home::download/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
