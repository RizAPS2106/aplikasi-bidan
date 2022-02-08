<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('', ['filter' => 'login'], function ($routes) {
	$routes->get('dashboard', 'Home::dashboard');
});

$routes->group('admin', function ($routes) {
	$routes->get('dashboard', 'Home::dashboard');

	$routes->get('bidan', 'BidanAdmin::index');
	$routes->get('bidan/search', 'BidanAdmin::search');
	$routes->get('bidan/(:segment)/preview', 'BidanAdmin::preview/$1');
	$routes->add('bidan/create', 'BidanAdmin::create');
	$routes->add('bidan/preview_edit', 'BidanAdmin::preview_edit');
	$routes->add('bidan/edit', 'BidanAdmin::edit');
	$routes->get('bidan/(:segment)/delete', 'BidanAdmin::delete/$1');

	$routes->get('konsumen', 'KonsumenAdmin::index');
	$routes->get('konsumen/search', 'KonsumenAdmin::search');
	$routes->get('konsumen/(:segment)/preview', 'KonsumenAdmin::preview/$1');
	$routes->add('konsumen/create', 'KonsumenAdmin::create');
	$routes->add('konsumen/preview_edit', 'KonsumenAdmin::preview_edit');
	$routes->add('konsumen/edit', 'KonsumenAdmin::edit');
	$routes->get('konsumen/(:segment)/delete', 'KonsumenAdmin::delete/$1');
});
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
