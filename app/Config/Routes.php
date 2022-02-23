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

$routes->add('login', 'Login::index');
$routes->add('login/auth', 'Login::auth');
$routes->get('register', 'Register::index');
$routes->add('register/register', 'Register::register');

$routes->group('konsumen', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Konsumen\Konsumen::profil');
	$routes->get('profil', 'Konsumen\Konsumen::profil');
	$routes->add('profil/edit', 'Konsumen\Konsumen::profil_edit');
	$routes->add('saldo', 'Konsumen\Konsumen::saldo');
	$routes->add('saldo/add', 'Konsumen\Konsumen::saldo_add');
	$routes->add('alamat', 'Konsumen\Konsumen::alamat');
	$routes->add('alamat/add', 'Konsumen\Konsumen::alamat_add');
	$routes->add('alamat/pick', 'Konsumen\Konsumen::alamat_pick');
});

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Admin\Admin::index');
	$routes->get('profil', 'Admin\Admin::profil');

	$routes->get('owner', 'Admin\OwnerAdmin::index');
	$routes->get('owner/(:segment)/preview', 'Admin\OwnerAdmin::preview/$1');

	$routes->get('bidan', 'Admin\BidanAdmin::index');
	$routes->get('bidan/(:segment)/preview', 'Admin\BidanAdmin::preview/$1');

	$routes->get('konsumen', 'Admin\KonsumenAdmin::index');
	$routes->get('konsumen/(:segment)/preview', 'Admin\KonsumenAdmin::preview/$1');

	$routes->add('user/create', 'User::create');
	$routes->get('user/preview_edit', 'User::preview_edit');
	$routes->add('user/edit', 'User::edit');
	$routes->add('user/(:segment)/delete', 'User::delete/$1');

	$routes->get('cabang', 'Admin\CabangAdmin::index');
	$routes->get('cabang/(:segment)/preview', 'Admin\CabangAdmin::preview/$1');
	$routes->add('cabang/create', 'Cabang::create');
	$routes->get('cabang/preview_edit', 'Cabang::preview_edit');
	$routes->add('cabang/edit', 'Cabang::edit');
	$routes->add('cabang/(:segment)/delete', 'Cabang::delete/$1');

	$routes->get('layanan', 'Admin\LayananAdmin::index');
	$routes->add('layanan/create', 'Layanan::create');
	$routes->get('layanan/preview_edit', 'Layanan::preview_edit');
	$routes->add('layanan/edit', 'Layanan::edit');
	$routes->add('layanan/(:segment)/delete', 'Layanan::delete/$1');
});

$routes->group('bidan', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Bidan\Bidan::index');
	$routes->get('profil', 'Bidan\Bidan::profil');
});

$routes->group('pesan', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Order::index');
	$routes->add('create', 'Order::create');
	$routes->add('create/addalamat', 'Order::alamat_add');
	$routes->add('create/pickalamat', 'Order::alamat_pick');
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
