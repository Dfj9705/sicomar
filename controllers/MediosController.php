<?php

namespace Controllers;

use Model\Medios;
use MVC\Router;
class MediosController{

    public static function index(Router $router)
    { 
        // hasPermission(['AMC_ADMIN']);

        $router->render('medios/index');
    }




}