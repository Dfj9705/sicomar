<?php
namespace Controllers;

use Model\Motores;
use MVC\Router;

class MotoresController
{
    public static function index(Router $router)
    {
        $busqueda = Motores::fetchArray('SELECT * FROM codemar_embarcaciones');
        $router->render('motores/index', [
            'busqueda' => $busqueda,

        ]);
    }
    public function guardarAPI()
    {
        getHeadersApi();
        // echo json_encode("Hola Humano");
        // exit;


        try {

            $motores = new Motores($_POST);
            $dato = $motores->mot_serie;
            $existe = Motores::fetchArray("SELECT * FROM codemar_motores where mot_serie = '$dato' and mot_situacion = 1 ");
            if (count($existe) > 0) {
                echo json_encode([
                    "mensaje" => "El registro ya existe.",
                    "codigo" => 2,
                ]);
                exit;
            }

            $resultado = $motores->crear();

            // echo json_encode($resultado['resultado']);

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    "mensaje" => "El registro se guardó correctamente.",
                    "codigo" => 1,
                ]);

            } else {
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
    public function buscarAPI()
    {
        getHeadersApi();
        // echo json_encode("hola");
        //     exit;
        $motores = Motores::where('mot_situacion', '0', '>');
        echo json_encode($motores);
    }

    public function modificarAPI()
    {
        getHeadersApi();
        try {

            // $cambio = new Receptores($_POST);
            // echo json_encode($cambio);
            // exit;

            $mot_id = $_POST['mot_id'];
            $valor = $_POST['mot_serie'];




            $existe = Motores::fetchArray("SELECT * FROM codemar_motores where mot_serie = '$valor' and mot_situacion = 1 ");

            if (count($existe) > 0) {
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
            $cambio = new Motores($_POST);
            $cambiar = $cambio->guardar();
            if ($cambiar) {
                echo json_encode([
                    "mensaje" => "El registro se guardo",
                    "codigo" => 1,
                ]);

            } else {
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
    } //fin de 

    public static function eliminarAPI()
    {
        getHeadersApi();




        //         $id = $_POST['id'];
// $valor = $_POST['rec_desc'];
        try {

            $motores = Motores::find($_POST['mot_id']);
            $motores->mot_situacion = 0;
            $resultado = $motores->actualizar();


            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    "mensaje" => "Se modifico la operación exitosamente.",
                    "codigo" => 1,
                ]);
                exit;

            } else {
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