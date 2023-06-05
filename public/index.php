<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\InsumoController;
use Controllers\EmbarcacionesController;
use Controllers\MediosController;
use Controllers\MotoresController;
use Controllers\OperacionesController;
use Controllers\ReceptoresController;
use Controllers\Tipo_embarcacionesController;
use Controllers\Unidad_MedidaController;


$router = new Router();
$router->setBaseURL('/sicomar');

$router->get('/', [AppController::class,'index']);

$router->get('/insumos', [InsumoController::class , 'index']);
$router->post('/API/insumos/guardar', [InsumoController::class, 'guardarAPI'] );
$router->get('/API/insumos/buscar', [InsumoController::class, 'buscarAPI'] );
$router->post('/API/insumos/modificar', [InsumoController::class, 'modificarAPI'] );
$router->post('/API/insumos/eliminar', [InsumoController::class, 'eliminarAPI'] );

//////Enbarcaciones

$router->get('/embarcaciones', [embarcacionesController::class , 'index']);;
// $router->post('/API/Enbarcaciones/guardar', [EnbarcacionesController::class, 'guardarAPI'] );
// $router->get('/API/Enbarcaciones/buscar', [EnbarcacionesController::class, 'buscarAPI'] );
// $router->post('/API/Enbarcaciones/modificar', [EnbarcacionesController::class, 'modificarAPI'] );
// $router->post('/API/Enbarcaciones/eliminar', [EnbarcacionesController::class, 'eliminarAPI'] );

$router->get('/medios', [MediosController::class , 'index']);
// $router->post('/API/Medios/guardar', [MediosController::class, 'guardarAPI'] );
// $router->get('/API/Medios/buscar', [MediosController::class, 'buscarAPI'] );
// $router->post('/API/Medios/modificar', [MediosController::class, 'modificarAPI'] );
// $router->post('/API/Medios/eliminar', [MediosController::class, 'eliminarAPI'] );

$router->get('/motores', [MotoresController::class , 'index']);
// $router->post('/API/Motores/guardar', [MotoresController::class, 'guardarAPI'] );
// $router->get('/API/Motores/buscar', [MotoresController::class, 'buscarAPI'] );
// $router->post('/API/Motores/modificar', [MotoresController::class, 'modificarAPI'] );
// $router->post('/API/Motores/eliminar', [MotoresController::class, 'eliminarAPI'] );

$router->get('/operaciones', [OperacionesController::class , 'index']);
// $router->post('/API/Operaciones/guardar', [OperacionesController::class, 'guardarAPI'] );
// $router->get('/API/Operaciones/buscar', [OperacionesController::class, 'buscarAPI'] );
// $router->post('/API/Operaciones/modificar', [OperacionesController::class, 'modificarAPI'] );
// $router->post('/API/Operaciones/eliminar', [OperacionesController::class, 'eliminarAPI'] );

$router->get('/receptores', [ReceptoresController::class , 'index']);
// $router->post('/API/Receptores/guardar', [ReceptoresController::class, 'guardarAPI'] );
// $router->get('/API/Receptores/buscar', [ReceptoresController::class, 'buscarAPI'] );
// $router->post('/API/Receptores/modificar', [ReceptoresController::class, 'modificarAPI'] );
// $router->post('/API/Receptores/eliminar', [ReceptoresController::class, 'eliminarAPI'] );

$router->get('/tipo_embarcaciones', [Tipo_embarcacionesController::class , 'index']);
// $router->post('/API/Tipo_enbarcaciones/guardar', [Tipo_enbarcacionesController::class, 'guardarAPI'] );
// $router->get('/API/Tipo_enbarcaciones/buscar', [Tipo_enbarcacionesController::class, 'buscarAPI'] );
// $router->post('/API/Tipo_enbarcaciones/modificar', [Tipo_enbarcacionesController::class, 'modificarAPI'] );
// $router->post('/API/Tipo_enbarcaciones/eliminar', [Tipo_enbarcacionesController::class, 'eliminarAPI'] );


$router->get('/unidad_medida', [Unidad_medidaController::class , 'index']);
// $router->post('/API/Unidad_medida/guardar', [Unidad_medidaController::class, 'guardarAPI'] );
// $router->get('/API/Unidad_medida/buscar', [Unidad_medidaController::class, 'buscarAPI'] );
// $router->post('/API/Unidad_medida/modificar', [Unidad_medidaController::class, 'modificarAPI'] );
// $router->post('/API/Unidad_medida/eliminar', [Unidad_medidaController::class, 'eliminarAPI'] );

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
