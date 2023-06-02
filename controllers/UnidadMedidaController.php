<?php
namespace Controllers;
use Model\UnidadMedida;
use MVC\Router;

class UnidadMedidaController{
    public static function index(Router $router){
        $router->render('unidadmedida/index',[]);
    }
    public function guardarAPI(){
        getHeadersApi();

        try {
           
            $medida = new UnidadMedida($_POST);
        
            $valor = $medida->uni_desc;
            $existe = UnidadMedida::fetchfirst("SELECT * from codemar_unidades_medida where uni_situacion = 1 AND uni_desc = '$valor'");
            if (count($existe)>0){
               echo json_encode([
                   "mensaje" => "El registro ya existe",
                   "codigo" => 2, 
               ]);
               exit;
            }
             
            $resultado = $medida->crear();
    
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
        $medida = UnidadMedida::where('uni_situacion', '0','>');
        echo json_encode($medida);
    }//fin de la funcion buscar  


    public function modificarAPI(){
        getHeadersApi();
       try {

        // $cambio = new Receptores($_POST);
        // echo json_encode($cambio);
        // exit;
        
$id = $_POST['id'];
$valor = $_POST['uni_desc'];




            $existe = UnidadMedida::fetchfirst("SELECT * from codemar_unidades_medida where uni_situacion = 1 AND uni_desc = '$valor'");
             
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
            $cambio = new UnidadMedida($_POST);
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

    public static function eliminarAPI(){
        getHeadersApi();


        

//         $id = $_POST['id'];
// $valor = $_POST['rec_desc'];
try{

$unidad = UnidadMedida::find($_POST['uni_id']);
$unidad->uni_situacion = 0;
$resultado= $unidad->actualizar();


if($resultado['resultado'] == 1){
    echo json_encode([
        "mensaje" => "Se modifico la operación exitosamente.",
        "codigo" => 1,
    ]);
    exit;
    
}else{
    echo json_encode([
        "mensaje" => "Ocurrió  un error.",
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
?>