<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('api', function ($routes) {
    $routes->post('login', 'Api\AuthController::login');
    $routes->post('register', 'Api\AuthController::register');

    $routes->get('users', 'Api\UserController::index');
    $routes->get('users/(:num)', 'Api\UserController::show/$1');
    $routes->post('users', 'Api\UserController::create');
    $routes->put('users/(:num)', 'Api\UserController::update/$1');
    $routes->delete('users/(:num)', 'Api\UserController::delete/$1');

    $routes->get('search/name/(:any)', 'Api\UserController::searchByName/$1');
    $routes->get('search/nim/(:num)', 'Api\UserController::searchByNIM/$1');
    $routes->get('search/ymd/(:num)', 'Api\UserController::searchByYMD/$1');
});
