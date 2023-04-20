<?php

namespace Controllers;

use Model\Receptores;
use MVC\Router;
class ReceptoresController{

    public static function index(Router $router)
    { 
        // hasPermission(['AMC_ADMIN']);

        $router->render('receptores/index');
    }



}