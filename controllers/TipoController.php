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

                $tipo_id = $_POST['tipo_id'];
                $valor = $_POST['tipo_desc'];
            $existe = Tipo::fetchfirst("SELECT * from codemar_tipos_embarcaciones where tipo_situacion = 1 AND tipo_desc = '$valor'");
             
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

            $cambio = new Tipo($_POST);
            
            $cambiar = $cambio-> actualizar();
            // echo json_encode($cambiar);
            // exit;
           
           
          
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

    public static function eliminarAPI(){
        getHeadersApi();

//         $id = $_POST['id'];
// $valor = $_POST['rec_desc'];
try{

$tipo = Tipo::find($_POST['tipo_id']);
$tipo->tipo_situacion = 0;

$resultado= $tipo->actualizar();
// echo json_encode($tipo);
// exit;


if($resultado['resultado'] == 1){
    echo json_encode([
        "mensaje" => "Se modifico la operacion exitosamente.",
        "codigo" => 1,
    ]);
    
}else{
    echo json_encode([
        "mensaje" => "Ocurrió  un error.",
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

}
?>