<?php
namespace Controllers;
use Model\Insumos;
use MVC\Router;

class InsumosController{
    public static function index(Router $router){
        $busqueda = Insumos::fetchArray('SELECT * FROM codemar_unidades_medida');
        $router->render('insumos/index',['busqueda'=> $busqueda]);
    }
    
}

?>