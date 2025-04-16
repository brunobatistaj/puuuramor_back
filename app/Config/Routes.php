<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// API - Animais
$routes->post('/api/postAnimal', 'Api::postAnimal');
$routes->put('/api/updateAnimal/(:num)', 'Api::updateAnimal/$1');
$routes->delete('/api/deleteAnimal/(:num)', 'Api::deleteAnimal/$1');

// API - Produtos
$routes->post('/api/postProduto', 'Api::postProduto');
$routes->put('/api/updateProduto/(:num)', 'Api::updateProduto/$1');
$routes->delete('/api/deleteProduto/(:num)', 'Api::deleteProduto/$1');

// API - Banners
$routes->post('/api/postBanner', 'Api::postBanner');
$routes->put('/api/updateBanner/(:num)', 'Api::updateBanner/$1');
$routes->delete('/api/deleteBanner/(:num)', 'Api::deleteBanner/$1');
