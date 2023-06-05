<?php
namespace Controllers;
use Model\Motores;
use MVC\Router;


class MotoresController{
    public static function index(Router $router){
        $busqueda=  Motores::fetchArray('SELECT * FROM codemar_embarcaciones');
        $router->render('motores/index', [
            'busqueda' => $busqueda,

        ]);
    }

    public function guardarAPI(){
        getHeadersApi();

        try {
            $motores = new Motores ($_POST);
            $dato = $motores->mot_serie;
            $dato_embarcacion= $motores->mot_embarcaciones;
            $existe_embarcacion = Motores::fetchArray("SELECT * FROM codemar_motores  where mot_embarcaciones = '$dato_embarcacion' and mot_situacion = 1 ");
            $existe = Motores::fetchArray("SELECT * FROM codemar_motores where mot_serie = '$dato' and mot_situacion = 1 ");
            if (count($existe)>0 || count($existe_embarcacion)>0){
               echo json_encode([
                   "mensaje" => "El registro ya existe.",
                   "codigo" => 2,
               ]);
               exit;
            }
             
            $resultado = $motores->crear();
            // echo json_encode($resultado['resultado']);

            if($resultado['resultado'] == 1){
                echo json_encode([
                    "mensaje" => "El registro se guardó correctamente.",
                    "codigo" => 1,
                ]);
                
            }else{
                echo json_encode([
                    "mensaje" => "Ocurrió un error.",
                    "codigo" => 0,
                ]);
    
            }
        } catch (Exception $e) {
            echo json_encode([
                "detalle" => $e->getMessage(),       
                "mensaje" => "Ocurrió un error en la base de datos.",

                "codigo" => 4,
            ]);
        }
        
    }
    
    // fin de la funcion guardar usuarios



    // inicio de la funcion
    public function buscarAPI(){
        getHeadersApi();
        // echo json_encode("hola");
        //     exit;
        $motores = Motores::where('mot_situacion', '0','>');
        echo json_encode($motores);
    }

    public function modificarAPI(){
        getHeadersApi();
       try {
            // $_POST["desc"] = strtoupper($_POST["desc"]);
            $motores = new Motores($_POST);
            $valor = $motores->mot_serie;
            $existe = Motores::fetchArray("SELECT * from codemar_motores where mot_situacion = 1 AND mot_serie = '$valor'");

            if (count($existe)>0){
               echo json_encode([
                   "mensaje" => "El valor no se modificó.",
                   "codigo" => 2,
               ]);
               exit;
            }
    
            $resultado = $motores->crear();
    
            if($resultado['resultado'] == 1){
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
    }

    public function eliminarAPI(){
        getHeadersApi();
        $_POST['mot_situacion'] = 0;
        $motores = new Motores($_POST);
        
        $resultado = $motores->eliminar();

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

    // public function cambioSituacionAPI(){
    //     getHeadersApi();
        

    // if ($_POST['situacion'] == 1){
    //     $_POST['situacion'] = 2;
    // }else{
    //     $_POST['situacion'] = 1;

    //     }
    //     $usuarios = new Usuarios($_POST);
    //     $resultado = $usuarios->guardar();
    //     if($resultado['resultado'] == 1){
    //         echo json_encode([
    //             "resultado" => 1
    //         ]);
            
    //     }else{
    //         echo json_encode([
    //             "resultado" => 2
    //         ]);

    //     }
    // }


}
  