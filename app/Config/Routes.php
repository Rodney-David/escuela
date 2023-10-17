<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('/holaMundo', 'Home::holaMundo');
$routes->get('/login', 'Login::index');
$routes->get('/register', 'Login::register');
$routes->post('/registro-de-usuarios', 'Login::guardar');
$routes->post('/inicio-de-usuarios', 'Login::iniciar');
$routes->get('/estudiantes', 'EstudiantesController::index');
$routes->get('/create', 'EstudiantesController::register');
$routes->post('/registro-de-estudiantes', 'EstudiantesController::guardar');
$routes->get('/editar/(:num)', 'EstudiantesController::editar/$1');
$routes->post('/editar_estudiantes/(:num)', 'EstudiantesController::actualizar/$1');
$routes->get('/eliminar/(:num)', 'EstudiantesController::eliminar/$1');
