<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//portal
$routes->get('/', 'Home::index');
// $routes->get('portal/pengajuans/create', 'PengajuanController::create');
// $routes->get('portal/jadwals/cari', 'JadwalController::cari');
// $routes->get('portal/galeris', 'GaleriController::index');

//dashboard admin
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/admin', 'DashboardController::index');

//divisi
$routes->get('/divisis', 'DivisiController::index');
$routes->get('/divisis/create', 'DivisiController::create');
$routes->post('/divisis/store', 'DivisiController::store');
$routes->get('/divisis/edit/(:num)', 'DivisiController::edit/$1');
$routes->post('/divisis/update/(:num)', 'DivisiController::update/$1');
$routes->get('/divisis/delete/(:num)', 'DivisiController::delete/$1');

//pengajuans
$routes->group('pengajuans', function ($routes) {
    $routes->get('/', 'PengajuanController::index');
    $routes->get('create', 'PengajuanController::create');
    $routes->post('store', 'PengajuanController::store');
    $routes->get('edit/(:num)', 'PengajuanController::edit/$1');
    $routes->post('update/(:num)', 'PengajuanController::update/$1');
    $routes->get('delete/(:num)', 'PengajuanController::delete/$1');
});
//detail
$routes->get('detail/(:num)', 'PengajuanController::detail/$1');

//jadwal 
$routes->get('jadwals', 'JadwalController::index');
$routes->get('jadwals/cari', 'JadwalController::cari');

//verifikasi
$routes->group('verifikasi', function ($routes) {
    $routes->get('edit/(:num)', 'VerifikasiController::edit/$1');
    $routes->post('update/(:num)', 'VerifikasiController::update/$1');
});

//Rating
$routes->get('ratings', 'RatingController::index');
$routes->get('ratings/create/(:num)', 'RatingController::create/$1');
$routes->post('ratings/store', 'RatingController::store');
$routes->get('ratings/edit/(:num)', 'RatingController::edit/$1');
$routes->post('ratings/update/(:num)', 'RatingController::update/$1');

$routes->delete('ratings/delete/(:num)', 'RatingController::delete/$1');
$routes->post('ratings/delete/(:num)', 'RatingController::delete/$1');

//galeri 
$routes->get('/galeris', 'GaleriController::index');


//berita
$routes->get('/beritas', 'BeritaController::index');
$routes->get('/beritas/create', 'BeritaController::create');
$routes->post('/beritas/store', 'BeritaController::store');
$routes->get('/beritas/edit/(:segment)', 'BeritaController::edit/$1');
$routes->post('/beritas/update/(:segment)', 'BeritaController::update/$1');
$routes->get('/beritas/delete/(:segment)', 'BeritaController::delete/$1');

$routes->get('beritas/halamanberita', 'BeritaController::halamanberita');


