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


$routes->get('upload', 'MusicController::uploadform');
// Add a route for the 'add_playlist' method
$routes->get('music/add_playlist', 'MusicController::add_playlist');
$routes->post('music/add_playlist', 'MusicController::add_playlist');
$routes->get('music/delete_playlist/(:num)', 'MusicController::delete_playlist/$1');



