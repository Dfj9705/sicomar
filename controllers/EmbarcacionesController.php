<?php

namespace Controllers;

use Model\Embarcaciones;
use MVC\Router;
class EmbarcacionesController{

    public static function index(Router $router)
    { 
        // hasPermission(['AMC_ADMIN']);

        $router->render('embarcaciones/index');
    }




}