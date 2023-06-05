<?php
namespace Controllers;
use Model\Tipo;
use MVC\Router;

class TipoController{
    public static function index(Router $router){
        $router->render('tipo/index',[]);
    }

    public function guardarAPI(){
        getHeadersApi();

        try {
           
            $tipo = new Tipo($_POST);
        
            $valor = $tipo->tipo_desc;
            $existe = Tipo::fetchfirst("SELECT * from codemar_tipos_embarcaciones where tipo_situacion = 1 AND tipo_desc = '$valor'");
            if (count($existe)>0){
               echo json_encode([
                   "mensaje" => "El registro ya existe",
                   "codigo" => 2, 
               ]);
               exit;
            }
             
            $resultado = $tipo->crear();
    
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
        // echo json_encode("hola");
        //     exit;
        $tipo = Tipo::where('tipo_situacion', '0','>');
        echo json_encode($tipo);
    }//fin de la funcion buscar 


    public function modificarAPI(){
        getHeadersApi();
       try {

        // $cambio = new Receptores($_POST);
        // echo json_encode($cambio);
        // exit;
        

                $id = $_POST['id'];
                $valor = $_POST['tipo_desc'];

                // echo json_encode($valor);
                // exit;




            $existe = Tipo::fetchfirst("SELECT * from codemar_tipos_embarcaciones where tipo_situacion = 1 AND tipo_desc = '$valor'");
             
            if ($existe){
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
            $cambio = new Tipo($_POST);
            $cambiar = $cambio-> guardar();
            if($cambiar){
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
    }//fin de la funcion modificar

    public function eliminarAPI(){
        getHeadersApi();

        $id = $_POST['id'];
$valor = $_POST['rec_desc'];
      
        $receptores = new Tipo($_POST);
        $_POST['rec_situacion'] = 0;
        $resultado = $receptores->eliminar();
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