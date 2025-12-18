<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//homepage
$routes->get('/', 'Home::index');
$routes->get('/home/(:any)', 'Home::play/$1');
$routes->post('/login', 'Home::login');
$routes->post('/create', 'Home::create');

//member area
$routes->get('/admin', 'Admin::index');
$routes->get('/marathon', 'Admin::manage_marathon');
$routes->get('/add', 'Admin::add_marathon');
$routes->get('/runners', 'Admin::manage_runners');
$routes->get('/registration', 'Admin::registration_form');