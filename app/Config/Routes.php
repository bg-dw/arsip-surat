<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Auth::index');
// $routes->get('login', 'Auth::index');
// $routes->post('login/auth', 'Auth::loginAuth');
// $routes->get('logout', 'Auth::logout');

// ============================================================================
// 1. RUTE PUBLIK (Bebas Akses / Tanpa Filter)
// ============================================================================
$routes->get('auth/login', 'Auth::login');
$routes->get('auth/ssoCallback', 'Auth::ssoCallback'); // Wajib Publik!
$routes->get('auth/logout', 'Auth::logout');


// ============================================================================
// 2. RUTE TERPROTEKSI (Wajib Login SSO)
// ============================================================================
$routes->group('', ['filter' => 'SsoAuthFilter'], function ($routes) {

    // Dashboard
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

    // CRUD Surat
    $routes->get('surat', 'Surat::index');
    $routes->get('surat/create', 'Surat::create');
    $routes->post('surat/store', 'Surat::store');
    $routes->get('surat/delete/(:num)', 'Surat::delete/$1');
    $routes->get('surat/download/(:num)', 'Surat::download/$1');

    // CRUD Kategori
    $routes->get('kategori', 'Kategori::index');
    $routes->get('kategori/create', 'Kategori::create');
    $routes->post('kategori/store', 'Kategori::store');
    $routes->get('kategori/edit/(:num)', 'Kategori::edit/$1');
    $routes->post('kategori/update/(:num)', 'Kategori::update/$1');
    $routes->get('kategori/delete/(:num)', 'Kategori::delete/$1');

    // Log Aktivitas
    $routes->get('log', 'Log::index');

});
