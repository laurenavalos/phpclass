<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home/(:any)', 'Home::play/$1');
$routes->get('/admin', 'Admin::index');

