<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('login', 'Login::auth');
$routes->get('/', 'Home::index', ['filter' => 'usersAuth']);
