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
$routes->get('/create-estudiantes', 'EstudiantesController::register');
$routes->post('/registro-de-estudiantes', 'EstudiantesController::guardar');
$routes->get('/editar-estudiantes/(:num)', 'EstudiantesController::editar/$1');
$routes->post('/actualizar-estudiantes/(:num)', 'EstudiantesController::actualizar/$1');
$routes->get('/eliminar-estudiantes/(:num)', 'EstudiantesController::eliminar/$1');

$routes->get('/session', 'Login::session');

$routes->get('/cursos', 'CursosController::index');
$routes->get('/create-cursos', 'CursosController::register');
$routes->post('/registro-de-cursos', 'CursosController::guardar');
$routes->get('/editar-cursos/(:num)', 'CursosController::editar/$1');
$routes->post('/actualizar-cursos/(:num)', 'CursosController::actualizar/$1');
$routes->get('/eliminar-cursos/(:num)', 'CursosController::eliminar/$1');

$routes->get('/ver_inscripciones/(:num)', 'CursosController::ver/$1');
$routes->get('/inscribir-cursos/(:num)', 'CursosController::inscribir/$1');
$routes->post('/guardar-inscripcion/(:num)', 'CursosController::guardarInscripcion/$1');
$routes->get('/edit_inscripcion/(:num)', 'CursosController::editar_inscripcion/$1');
$routes->post('/actualizar_inscripcion/(:num)', 'CursosController::actualizarInscripcion/$1');
$routes->get('/eliminar_inscripcion/(:num)', 'CursosController::eliminar_inscripcion/$1');

$routes->get('/materias', 'MateriasController::index');
$routes->get('/create_materias', 'MateriasController::register');
$routes->post('/registro_de_materias', 'MateriasController::guardar');
$routes->get('/editar_materias/(:num)', 'MateriasController::editar/$1');
$routes->post('/actualizar_materias/(:num)', 'MateriasController::actualizar/$1');
$routes->get('/eliminar_materias/(:num)', 'MateriasController::eliminar/$1');

$routes->get('/generarExcel_estudiantes', 'EstudiantesController::generarExcel');
$routes->get('/generarExcel_inscripciones/(:num)', 'CursosController::generarExcel/$1');