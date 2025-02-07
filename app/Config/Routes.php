<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->group('/auth', function ($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
 });
 
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/starter', 'Home::starter', ['filter' => 'auth']);

$routes->group('user',['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
    $routes->get('show/(:num)', 'UserController::show/$1');
});

$routes->group('unit',['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UnitController::index');
    $routes->get('create', 'UnitController::create');
    $routes->post('store', 'UnitController::store');
    $routes->post('update/(:num)', 'UnitController::update/$1');
    $routes->get('edit/(:num)', 'UnitController::edit/$1');
    $routes->get('delete/(:num)', 'UnitController::delete/$1');
    $routes->get('show/(:num)', 'UnitController::show/$1');
});

$routes->group('karyawan',['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'KaryawanController::index');
    $routes->get('create', 'KaryawanController::create');
    $routes->post('store', 'KaryawanController::store');
    $routes->post('update/(:num)', 'KaryawanController::update/$1');
    $routes->get('edit/(:num)', 'KaryawanController::edit/$1');
    $routes->get('delete/(:num)', 'KaryawanController::delete/$1');
    $routes->get('show/(:num)', 'KaryawanController::show/$1');
});

$routes->group('departemen',['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'DepartemenController::index');
    $routes->get('create', 'DepartemenController::create');
    $routes->post('store', 'DepartemenController::store');
    $routes->post('update/(:num)', 'DepartemenController::update/$1');
    $routes->get('edit/(:num)', 'DepartemenController::edit/$1');
    $routes->get('delete/(:num)', 'DepartemenController::delete/$1');
    $routes->get('show/(:num)', 'DepartemenController::show/$1');
});

$routes->group('penempatan',['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'PenempatanController::index');
    $routes->get('create', 'PenempatanController::create');
    $routes->post('store', 'PenempatanController::store');
    $routes->post('update/(:num)', 'PenempatanController::update/$1');
    $routes->get('edit/(:num)', 'PenempatanController::edit/$1');
    $routes->get('delete/(:num)', 'PenempatanController::delete/$1');
    $routes->get('show/(:num)', 'PenempatanController::show/$1');
});

$routes->group('aset',['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'AsetController::index');
    $routes->get('create', 'AsetController::create');
    $routes->post('store', 'AsetController::store');
    $routes->post('update/(:num)', 'AsetController::update/$1');
    $routes->get('edit/(:num)', 'AsetController::edit/$1');
    $routes->get('delete/(:num)', 'AsetController::delete/$1');
    $routes->get('show/(:num)', 'AsetController::show/$1');
});


$routes->group('bakerusakan',['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'BaKerusakanController::index');
    $routes->get('create', 'BaKerusakanController::create');
    $routes->post('store', 'BaKerusakanController::store');
    $routes->post('update/(:num)', 'BaKerusakanController::update/$1');
    $routes->get('edit/(:num)', 'BaKerusakanController::edit/$1');
    $routes->get('delete/(:num)', 'BaKerusakanController::delete/$1');
    $routes->get('show/(:num)', 'BaKerusakanController::show/$1');
    $routes->get('cetak/(:num)', 'BaKerusakanController::cetak/$1');
    $routes->post('setujuikadep', 'BaKerusakanController::setujuikadep');
    $routes->post('tolakkadep', 'BaKerusakanController::tolakkadep');
    $routes->post('setujuikadis', 'BaKerusakanController::setujuikadis');
    $routes->post('tolakkadis', 'BaKerusakanController::tolakkadis');
});

$routes->group('laporan',['filter' => 'auth'], function ($routes) {
    $routes->get('barangrusak', 'AsetController::barangrusak');
    $routes->get('layakpakai', 'AsetController::layakpakai');
    $routes->get('penempatan', 'AsetController::penempatan');
    $routes->get('cetakrusak', 'AsetController::cetakrusak');
    $routes->get('cetaklayak', 'AsetController::cetaklayak');
    $routes->get('cetakpenempatan', 'AsetController::cetakpenempatan');
});

$routes->group('rekomendasi',['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'RekomendasiController::index');
    $routes->get('create', 'RekomendasiController::create');
    $routes->post('store', 'RekomendasiController::store');
    $routes->post('update/(:num)', 'RekomendasiController::update/$1');
    $routes->get('edit/(:num)', 'RekomendasiController::edit/$1');
    $routes->get('delete/(:num)', 'RekomendasiController::delete/$1');
    $routes->get('show/(:num)', 'RekomendasiController::show/$1');
    $routes->get('cetak/(:num)', 'RekomendasiController::cetak/$1');
    $routes->post('setujuikadep', 'RekomendasiController::setujuikadep');
    $routes->post('tolakkadep', 'RekomendasiController::tolakkadep');
    $routes->post('setujuikadis', 'RekomendasiController::setujuikadis');
    $routes->post('tolakkadis', 'RekomendasiController::tolakkadis');
});
