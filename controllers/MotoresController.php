<?php

namespace Controllers;

use Model\Motores;
use MVC\Router;
class MotoresController{

    public static function index(Router $router)
    { 
        // hasPermission(['AMC_ADMIN']);

        $router->render('motores/index');
    }




}