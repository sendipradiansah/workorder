<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('workorder', 'WorkOrder::index');

$routes->group('workorder', function($routes){
    $routes->get('add', 'WorkOrder::add');
    $routes->post('insert', 'WorkOrder::insert');
    $routes->get('detail/(:num)', 'WorkOrder::detail/$1');
    $routes->get('edit/(:num)', 'WorkOrder::edit/$1');
    $routes->post('update/(:num)', 'WorkOrder::update/$1');
    $routes->post('delete/(:num)', 'WorkOrder::delete/$1');
});

$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->group('user', function($routes){
    $routes->get('get_list_operator', 'User::getListOperator');
});

