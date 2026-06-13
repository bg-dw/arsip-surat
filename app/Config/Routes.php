<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login/auth', 'Auth::loginAuth');
$routes->get('logout', 'Auth::logout');

$routes->group('', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('surat', 'Surat::index');
    $routes->get('surat/create', 'Surat::create');
    $routes->post('surat/store', 'Surat::store');
    $routes->get('surat/delete/(:num)', 'Surat::delete/$1');
    $routes->get('surat/download/(:num)', 'Surat::download/$1');
});
