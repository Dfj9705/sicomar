<?php
namespace Controllers;
use Model\Receptores;
use MVC\Router;

class ReceptoresController{

    public static function index(Router $router){
        $router->render('receptores/index');
    }

    public function guardarAPI(){
        getHeadersApi();

        try {
           
            $receptores = new Receptores($_POST);
        
            $valor = $receptores->rec_desc;
            $existe = Receptores::fetchfirst("SELECT * from codemar_receptor_comunicacion where rec_situacion = 1 AND rec_desc = '$valor'");
            if (count($existe)>0){
               echo json_encode([
                   "mensaje" => "El registro ya existe",
                   "codigo" => 2, 
               ]);
               exit;
            }
             
            $resultado = $receptores->crear();
    
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
        $receptores = Receptores::where('rec_situacion', '0','>');
        echo json_encode($receptores);
    }//fin de la funcion buscar 


    public function modificarAPI(){
        getHeadersApi();
       try {

        // $cambio = new Receptores($_POST);
        // echo json_encode($cambio);
        // exit;
        

$id = $_POST['id'];
$valor = $_POST['rec_desc'];




            $existe = Receptores::fetchfirst("SELECT * from codemar_receptor_comunicacion where rec_situacion = 1 AND rec_desc = '$valor'");
             
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
            $cambio = new Receptores($_POST);
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

$receptores = Receptores::find($_POST['rec_id']);
$receptores->rec_situacion = 0;
$resultado= $receptores->actualizar();


if($resultado['resultado'] == 1){
    echo json_encode([
        "mensaje" => "Se modifico la operación exitosamente.",
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

        

}}}
    
?>