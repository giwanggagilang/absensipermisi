<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'Auth::index');
$routes->get('/loginAdmin', 'Auth::loginAdmin');
