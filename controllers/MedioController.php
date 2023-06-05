<?php
namespace Controllers;
use Model\Medio;
use MVC\Router;

class MedioController{
    public static function index(Router $router){
        $router->render('medio/index',[]);
    }
}

?>