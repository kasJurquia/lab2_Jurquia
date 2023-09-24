<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('music', 'MusicController::index');
$routes->post('music/upload', 'MusicController::upload');
$routes->get('music/play/(:num)', 'MusicController::play/$1');
$routes->get('music/delete/(:num)', 'MusicController::delete/$1');
$routes->get('music/delete_confirm/(:num)', 'MusicController::delete_confirm/$1');
