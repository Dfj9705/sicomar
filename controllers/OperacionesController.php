<?php
namespace Controllers;

use Exception;
use Model\Operaciones;
// use Model\TipoEmbarcacion;
use MVC\Router;

class OperacionesController{
    public static function index(Router $router){
        $router->render('operaciones/index', []);
        
    }

    public function guardarAPI(){
        getHeadersApi();
        try {
            
            $operacion = new Operaciones($_POST);
            $resultado = $operacion -> crear();


            if($resultado['resultado'] == 1){
                echo json_encode([
                    "mensaje" => "El registro se guardó correctamente",
                    "codigo" => 1,
                ]);
                exit;
            }else{
                echo json_encode([
                    "mensaje" => "Error al guardar registro",
                    "codigo" => 3,
                ]);
                exit;
            }
            
        } catch (Exception $e) {
            echo json_encode([
                "detalle" => $e->getMessage(),
                "mensaje" => "Ocurrió un error en base de datos",
                "codigo" => 4,
            ]);
            exit;
        }
    }
    public static function buscarAPI()
    {
        // hasPermissionApi(['AMC_ADMIN']);
        try {
            getHeadersApi();
            $operacion = Operaciones::fetchArray('SELECT * from codemar_tipos_operaciones where tipo_situacion = 1');
            echo json_encode($operacion);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }   




    }

    public function modificarAPI(){
        getHeadersApi();
        try {


            $tipo_id = $_POST['tipo_id'];
            $valor = $_POST['tipo_desc'];
        $existe = Operaciones::fetchArray("SELECT * from codemar_tipos_operaciones where tipo_situacion = 1 AND tipo_desc = '$valor'");
         
        if (count($existe)>0){
           echo json_encode([
               "mensaje" => "El valor no se modificó.",
               "codigo" => 2,
           ]);
           exit;
        }
            $embarcacion = new Operaciones($_POST);
            $resultado = $embarcacion -> actualizar();


            if($resultado['resultado'] == 1){
                echo json_encode([
                    "mensaje" => "El registro se actualizó correctamente",
                    "codigo" => 1,
                ]);
                exit;
            }else{
                echo json_encode([
                    "mensaje" => "Error al guardar registro",
                    "codigo" => 3,
                ]);
                exit;
            }
            
        } catch (Exception $e) {
            echo json_encode([
                "detalle" => $e->getMessage(),
                "mensaje" => "Ocurrió un error en base de datos",
                "codigo" => 4,
            ]);
            exit;
        }
    }
    public static function eliminarAPI(){
        getHeadersApi();
        // $id = $_GET['tipo_id'];
        try {
            $operacion = Operaciones::find($_POST['tipo_id']);
            $operacion->tipo_situacion = 0;
            $resultado = $operacion -> actualizar();


            if($resultado['resultado'] == 1){
                echo json_encode([
                    "mensaje" => "El registro se eliminó correctamente",
                    "codigo" => 1,
                ]);
                exit;
            }else{
                echo json_encode([
                    "mensaje" => "Error al guardar registro",
                    "codigo" => 0,
                ]);
                exit;
            }
            
        } catch (Exception $e) {
            echo json_encode([
                "detalle" => $e->getMessage(),
                "mensaje" => "Ocurrió un error en base de datos",
                "codigo" => 4,
            ]);
            exit;
        }
    }

}
