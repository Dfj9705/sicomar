<?php

namespace Controllers;

use Model\Unidad_medida;
use MVC\Router;
class Unidad_medidaController{

    public static function index(Router $router)
    { 
        // hasPermission(['AMC_ADMIN']);

        $router->render('unidad_medida/index');
    }




}