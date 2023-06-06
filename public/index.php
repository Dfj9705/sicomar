<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AppController;
use Controllers\UnidadMedidaController;
use Controllers\MotoresController;
use Controllers\EmbarcacionesController;
use Controllers\TipoController;
use Controllers\ReceptoresController;
use Controllers\MedioController;
use Controllers\OperacionesController;
use Controllers\InsumosController;

$router = new Router();
$router->setBaseURL('/sicomar');


// aca estaran las rutas para el crud de Receptores


$router->get('/receptores', [ReceptoresController::class, 'index']);
$router->post('/API/receptores/guardar', [ReceptoresController::class, 'guardarAPI']);
$router->get('/API/receptores/buscar', [ReceptoresController::class, 'buscarAPI']);
$router->post('/API/receptores/modificar', [ReceptoresController::class, 'modificarAPI']);
$router->post('/API/receptores/eliminar', [ReceptoresController::class, 'eliminarAPI']);


// aca estaran las rutas para el Crud de Medios de Comunicacion
$router->get('/medio', [MedioController::class, 'index']);


// Aca estaran las rutas para el Crud de Patrullajes
$router->get('/operaciones', [OperacionesController::class, 'index']);
$router->post('/API/operaciones/guardar', [OperacionesController::class, 'guardarAPI']);
$router->get('/API/operaciones/buscar', [OperacionesController::class, 'buscarAPI']);
$router->post('/API/operaciones/modificar', [OperacionesController::class, 'modificarAPI']);
$router->post('/API/operaciones/eliminar', [OperacionesController::class, 'eliminarAPI']);


// aca estaran las rutas para el crud de insumos
$router->get('/insumos', [InsumosController::class, 'index']);
$router->post('/API/insumos/guardar', [InsumosController::class, 'guardarAPI']);
$router->get('/API/insumos/buscar', [InsumosController::class, 'buscarAPI']);
$router->post('/API/insumos/modificar', [InsumosController::class, 'modificarAPI']);
$router->post('/API/insumos/eliminar', [InsumosController::class, 'eliminarAPI']);



$router->comprobarRutas();