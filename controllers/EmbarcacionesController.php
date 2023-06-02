<?php
namespace Controllers;
use Model\Embarcaciones;
use MVC\Router;

class EmbarcacionesController{
    public static function index(Router $router){
        $busqueda = Embarcaciones::fetchArray('SELECT * FROM codemar_tipos_embarcaciones');
        $router->render('embarcaciones/index',['busqueda'=> $busqueda]);
    }
}
?> 