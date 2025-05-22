<?php

use CodeIgniter\Router\RouteCollection;

// AUTHENTICATE
$routes->group('login', ['namespace' => 'App\Controllers'], static function($routes) {
    $routes->get('/', 'AuthController::index', ['as' => 'login']);
    $routes->post('process', 'AuthController::loginProcess', ['as' => 'login.process']);
});
$routes->get('logout', 'AuthController::logout', ['as' => 'logout']);

// DASHBOARD
$routes->get('/', 'DashbordController::index', ['as' => 'dashboard', 'filter' => 'auth']);
$routes->post('/filter', 'DashbordController::filter', ['as' => 'dashboard.filter', 'filter' => 'auth']);

$routes->group('uang-masuk', ['namespace' => 'App\Controllers', 'filter' => 'auth'], static function($routes) {
    $routes->get('/', 'UangMasukController::index', ['as' => 'uangmasuk.index']);
    $routes->get('create', 'UangMasukController::create', ['as' => 'uangmasuk.create', 'filter' => 'role:Bendahara']);
    $routes->post('store', 'UangMasukController::store', ['as' => 'uangmasuk.store', 'filter' => 'role:Bendahara']);
    $routes->get('edit/(:num)', 'UangMasukController::edit/$1', ['as' => 'uangmasuk.edit', 'filter' => 'role:Bendahara']);
    $routes->post('update', 'UangMasukController::update', ['as' => 'uangmasuk.update', 'filter' => 'role:Bendahara']);
    $routes->post('delete/(:num)', 'UangMasukController::delete/$1', ['as' => 'uangmasuk.delete', 'filter' => 'role:Bendahara']);
    $routes->post('print', 'UangMasukController::print', ['as' => 'uangmasuk.print']);
});

$routes->group('uang-keluar', ['namespace' => 'App\Controllers'], static function($routes) {
    $routes->get('/', 'UangKeluarController::index', ['as' => 'uangkeluar.index']);
    $routes->get('create', 'UangKeluarController::create', ['as' => 'uangkeluar.create', 'filter' => 'role:Bendahara']);
    $routes->post('store', 'UangKeluarController::store', ['as' => 'uangkeluar.store', 'filter' => 'role:Bendahara']);
    $routes->get('edit/(:num)', 'UangKeluarController::edit/$1', ['as' => 'uangkeluar.edit', 'filter' => 'role:Bendahara']);
    $routes->post('update', 'UangKeluarController::update', ['as' => 'uangkeluar.update', 'filter' => 'role:Bendahara']);
    $routes->post('delete/(:num)', 'UangKeluarController::delete/$1', ['as' => 'uangkeluar.delete', 'filter' => 'role:Bendahara']);
    $routes->post('print', 'UangKeluarController::print', ['as' => 'uangkeluar.print']);
});

$routes->get('/unauthorized', function() {
    return view('main/auth/unauthorized');
});
