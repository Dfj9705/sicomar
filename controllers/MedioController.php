<?php
namespace Controllers;

use Model\Medio;
use MVC\Router;

class MedioController
{
    public static function index(Router $router)
    {
        $router->render('medio/index', []);
    }
    public function guardarAPI()
    {
        getHeadersApi();

        try {

            $medio = new Medio($_POST);
            $valor = $medio->medio_desc;
            $existe = Medio::fetchfirst("SELECT * FROM codemar_medios_comunicacion where medio_situacion = 1 AND medio_desc = '$valor'");
            if (count($existe) > 0) {
                echo json_encode([
                    "mensaje" => "El registro ya existe",
                    "codigo" => 2,
                ]);
                exit;
            }

            $resultado = $medio->crear();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    "mensaje" => "El registro se guardó",
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

    }
    public function buscarAPI()
    {
        getHeadersApi();

        try {

            // echo json_encode($_POST);
            // exit;
            $medio = Medio::where('medio_situacion', '0', '>');
            echo json_encode($medio);
        } catch (Exception $e) {
            echo json_encode($e->getMessage());

        }


    } //fin de la funcion buscar 

    public function modificarAPI()
    {
        getHeadersApi();
        try {
            $medio_id = $_POST['medio_id'];
            $valor = $_POST['medio_desc'];
            $existe = Medio::fetchfirst("SELECT * from codemar_medios_comunicacion where medio_situacion = 1 AND medio_desc = '$valor'");

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

            $cambio = new Medio($_POST);

            $cambiar = $cambio->actualizar();



            if ($cambiar) {
                echo json_encode([
                    "mensaje" => "El registro se Modificó",
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
    } //fin de la funcion modificar

    public static function eliminarAPI()
    {
        getHeadersApi();

        //         $id = $_POST['id'];
// $valor = $_POST['rec_desc'];
        try {

            $medio = Medio::find($_POST['medio_id']);
            $medio->medio_situacion = 0;
            $resultado = $medio->actualizar();


            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    "mensaje" => "Se modifico la operación exitosamente.",
                    "codigo" => 1,
                ]);

            } else {
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