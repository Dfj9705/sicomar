<?php

namespace Controllers;

use Model\Operaciones;
use MVC\Router;
class OperacionesController{

    public static function index(Router $router)
    { 
        // hasPermission(['AMC_ADMIN']);

        $router->render('operaciones/index');
    }




}