<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashbordController::index');

$routes->group('uang-masuk', ['namespace' => 'App\Controllers'], static function($routes) {
    $routes->get('/', 'UangMasukController::index', ['as' => 'uangmasuk.index']);
    $routes->get('create', 'UangMasukController::create', ['as' => 'uangmasuk.create']);
    $routes->post('store', 'UangMasukController::store', ['as' => 'uangmasuk.store']);
    $routes->get('edit/(:num)', 'UangMasukController::edit/$1', ['as' => 'uangmasuk.edit']);
    $routes->post('update', 'UangMasukController::update', ['as' => 'uangmasuk.update']);
    $routes->post('delete/(:num)', 'UangMasukController::delete/$1', ['as' => 'uangmasuk.delete']);
    $routes->post('print', 'UangMasukController::print', ['as' => 'uangmasuk.print']);
});

$routes->group('uang-keluar', ['namespace' => 'App\Controllers'], static function($routes) {
    $routes->get('/', 'UangKeluarController::index', ['as' => 'uangkeluar.index']);
    $routes->get('create', 'UangKeluarController::create', ['as' => 'uangkeluar.create']);
    $routes->post('store', 'UangKeluarController::store', ['as' => 'uangkeluar.store']);
    $routes->get('edit/(:num)', 'UangKeluarController::edit/$1', ['as' => 'uangkeluar.edit']);
    $routes->post('update', 'UangKeluarController::update', ['as' => 'uangkeluar.update']);
    $routes->post('delete/(:num)', 'UangKeluarController::delete/$1', ['as' => 'uangkeluar.delete']);
    $routes->post('print', 'UangKeluarController::print', ['as' => 'uangkeluar.print']);
});
