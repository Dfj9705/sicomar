<?php
namespace Controllers;

use Model\Insumos;
use MVC\Router;

class InsumosController
{

    public static function index(Router $router)
    {
        $busqueda = Insumos::fetchArray('SELECT * FROM codemar_unidades_medida');
        $router->render('insumos/index', ['busqueda' => $busqueda]);
    }







    public function guardarAPI()
    {
        getHeadersApi();
        // hasPermissionApi(['AMC_ADMIN']);



        try {

            $insumo = new Insumos($_POST);
            $dato = $insumo->insumo_desc;
            $sql = "SELECT * FROM codemar_insumos_operaciones where insumo_desc = '$dato' and insumo_situacion = 1 ";
            $existe = Insumos::fetchArray($sql);
            // echo json_encode($existe);
            // exit;
            if (count($existe) > 0) {
                echo json_encode([
                    "mensaje" => "El registro ya existe.",
                    "codigo" => 2,
                ]);
                exit;
            }

            $resultado = $insumo->crear();

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


    public static function buscarAPI()
    {
        // hasPermissionApi(['AMC_ADMIN']);
        try {
            getHeadersApi();
            $insumo = Insumos::fetchArray('SELECT * from codemar_insumos_operaciones where insumo_situacion = 1');
            echo json_encode($insumo);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }




    }

    public function modificarAPI()
    {
        getHeadersApi();


        try {

            $insumo_id = $_POST['insumo_id'];
            $valor = $_POST['insumo_desc'];
            $existe = Insumos::fetchArray("SELECT * from codemar_insumos_operaciones where insumo_desc = '$valor' AND insumo_situacion = 1");
            if (count($existe) > 0) {
                echo json_encode([
                    "mensaje" => "El valor no se modificó.",
                    "codigo" => 2,
                ]);
                exit;
            }

            $cambio = new Insumos($_POST);
            $cambiar = $cambio->guardar();


            if ($cambiar) {
                echo json_encode([
                    "mensaje" => "El registro se actualizó correctamente",
                    "codigo" => 1,
                ]);
                exit;
            } else {
                echo json_encode([
                    "mensaje" => "Error Ocurrio un error",
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
    } //fin de la funcion modificar

    public static function eliminarAPI()
    {
        getHeadersApi();
        try {

            $insumo = Insumos::find($_POST['insumo_id']);
            $insumo->insumo_situacion = 0;
            $resultado = $insumo->actualizar();
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    "mensaje" => "se eliminó el insumo",
                    "codigo" => 1,
                ]);
                exit;
            } else {
                echo json_encode([
                    "mensaje" => "ocurrio un error",
                    "codigo" => 0,
                ]);
                exit;

            }
        } catch (Exception $e) {
            echo json_encode([
                "detalle" => $e->getMessage(),
                "mensaje" => "Ocurrio un error en la base de datos",
                "codigo" => 4,
            ]);
            exit;

        }
    }


}