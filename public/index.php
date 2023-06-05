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

$router->get('/', [AppController::class, 'index']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
// Acá estarán las rutas correspondientes a unidad de medidas codemar
$router->get('/unidadmedida', [UnidadMedidaController::class, 'index']);
$router->post('/API/unidadmedida/guardar', [UnidadMedidaController::class, 'guardarAPI']);
$router->get('/API/unidadmedida/buscar', [UnidadMedidaController::class, 'buscarAPI']);
$router->post('/API/unidadmedida/modificar', [UnidadMedidaController::class, 'modificarAPI']);
$router->post('/API/unidadmedida/eliminar', [UnidadMedidaController::class, 'eliminarAPI']);


// Acá estaran las rutas correspondientes a los motores
$router->get('/motores', [MotoresController::class, 'index']);
$router->post('/API/motores/guardar', [MotoresController::class, 'guardarAPI']);
$router->get('/API/motores/buscar', [MotoresController::class, 'buscarAPI']);
$router->post('/API/motores/modificar', [MotoresController::class, 'modificarAPI']);
$router->post('/API/motores/eliminar', [MotoresController::class, 'eliminarAPI']);


// aca estaran las rutas para el crud de embarcaciones
$router->get('/embarcaciones', [EmbarcacionesController::class, 'index']);
$router->post('/API/embarcaciones/guardar', [EmbarcacionesController::class, 'guardarAPI']);
$router->get('/API/embarcaciones/buscar', [EmbarcacionesController::class, 'buscarAPI']);
$router->post('/API/embarcaciones/modificar', [EmbarcacionesController::class, 'modificarAPI']);
$router->post('/API/embarcaciones/eliminar', [EmbarcacionesController::class, 'eliminarAPI']);



// aca estaran las rutas para el crud de Tipo de embarcaciones
$router->get('/tipo', [TipoController::class, 'index']);
$router->post('/API/tipo/guardar', [TipoController::class, 'guardarAPI']);
$router->get('/API/tipo/buscar', [TipoController::class, 'buscarAPI']);
$router->post('/API/tipo/modificar', [TipoController::class, 'modificarAPI']);
$router->post('/API/tipo/eliminar', [TipoController::class, 'eliminarAPI']);


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