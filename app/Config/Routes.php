<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('.*', function() {
    // arahkan semua route yang tidak ketemu ke index.html Vue
    return view('index'); // pastikan ini memuat file index.html hasil build Vite
});
