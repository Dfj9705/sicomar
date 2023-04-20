<?php

namespace Controllers;

use Model\Tipo_embarcaciones;
use MVC\Router;
class Tipo_embarcacionesController{

    public static function index(Router $router)
    { 
        // hasPermission(['AMC_ADMIN']);

        $router->render('tipo_embarcaciones/index');
    }




}