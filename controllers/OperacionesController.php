<?php
namespace Controllers;
// use Model\Patrullaje;
use Models\Operaciones;
use MVC\Router;


class OperacionesController {
    public static function index(Router $router){
        $router->render('operaciones/index',[]);
    }
    public function guardarAPI(){
        getHeadersApi();

        try {
           echo json_encode($_POST);
           exit;
            $operaciones = new Operaciones($_POST);
        
            $valor = $operaciones->tipo_desc;
            $existe = Operaciones::fetchArray("SELECT * from codemar_tipos_operaciones where tipo_situacion = 1 AND tipo_desc = '$valor'");
            if (count($existe)>0){
               echo json_encode([
                   "mensaje" => "El registro ya existe",
                   "codigo" => 2, 
               ]);
               exit;
            }
             
            $resultado = $operaciones->guardar();
    
            if($resultado['resultado'] == 1){
                echo json_encode([
                    "mensaje" => "El registro se guardó",
                    "codigo" => 1,
                ]);
                
            }else{
                echo json_encode([
                    "mensaje" => "Ocurrió un error",
                    "codigo" => 0,

                ]);
    
            }
        } catch (Exception $e) {
            echo json_encode([
                "detalle" => $e->getMessage(),       
                "mensaje" => "Ocurrió un error en base de datos",

                "codigo" => 4,
            ]);
        }
        
    }
    public function buscarAPI(){
        getHeadersApi();
        try{
        $operaciones = Operaciones::where('tipo_situacion', '0','>');
        echo json_encode($operaciones);
        }catch (Exception $e){
            echo json_encode([
                "detalle" => $e->getMessage(),       
                 ]);


        }
       
    
    }//fin de la funcion buscar 


    public function modificarAPI(){
        getHeadersApi();
       try {

        // $cambio = new Receptores($_POST);
        // echo json_encode($cambio);
        // exit;
        


$id = $_POST['id'];
$valor = $_POST['tipo_desc'];




            $existe = Operaciones::fetchfirst("SELECT * from codemar_tipos_operaciones where tipo_situacion = 1 AND tipo_desc = '$valor'");
             
            if (count($existe)>0){
               echo json_encode([
                   "mensaje" => "El valor no se modificó.",
                   "codigo" => 2,
               ]);
               exit;
            }
    
            // $cambio =  new Receptores ([
            //     'rec_id' => $id,
            //     'rec_desc' => $valor,
            //     'rec_situacion' => "1" 
            // ]);
            $cambio = new Operaciones($_POST);
            $cambiar = $cambio-> guardar();
            if($cambiar){
                echo json_encode([
                    "mensaje" => "El registro se guardo",
                    "codigo" => 1,
                ]);
                
            }else{
                echo json_encode([
                    "mensaje" => "Ocurrió un error",
                    "codigo" => 0,
                ]);

            }
        } catch (Exception $e) {
            echo json_encode([
                "detalle" => $e->getMessage(),       
                "mensaje" => "Ocurrió un error en base de datos",

                "codigo" => 4,
            ]);
        }
    }//fin de la funcion modificar

    public function eliminarAPI(){
        getHeadersApi();

        $id = $_POST['id'];
$valor = $_POST['rec_desc'];
      
        $operaciones = new Operaciones($_POST);
        $_POST['tipo_situacion'] = 0;
        $resultado = $operaciones->eliminar();
        if($resultado['resultado'] == 1){
            echo json_encode([
                "resultado" => 1
            ]);
            
        }else{
            echo json_encode([
                "resultado" => 0
            ]);

        }
    }
}

?>