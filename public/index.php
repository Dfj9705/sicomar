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
$router->comprobarRutas();