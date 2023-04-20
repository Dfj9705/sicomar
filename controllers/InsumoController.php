<?php

namespace Controllers;

use Model\Insumos;
use MVC\Router;

class InsumoController
{

    public static function index(Router $router)
    {
        // hasPermission(['AMC_ADMIN']);

        $router->render('insumos/index');
    }

    public static function guardarAPI()
    {
        getHeadersApi();
        hasPermissionApi(['AMC_ADMIN']);
        try {
            // $_POST["desc"] = strtoupper($_POST["desc"]);
            $insumos = new Insumos($_POST);
            $valor = $insumos->desc;
            $existe = Insumos::SQL("SELECT * from codemar_insumos_operaciones where situacion =1 AND desc = '$valor'");
            // echo json_encode($existe);
            // exit;
            if (count($existe) > 0) {
                echo json_encode([
                    "mensaje" => "El registro ya existe",
                    "codigo" => 2,
                ]);
                exit;
            }

            $resultado = $insumos->guardar();

            if ($resultado['resultado'] == 1) {
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

    }

    ///////

    public static function buscarApi()
    {
        getHeadersApi();
        hasPermissionApi(['AMC_ADMIN']);
        $insumos = Insumos::where('situacion', '0', '>');
        echo json_encode($insumos);
    }

    public static function modificarAPI()
    {
        getHeadersApi();
        hasPermissionApi(['AMC_ADMIN']);

        try {
            // $_POST["desc"] = strtoupper($_POST["desc"]);
            $insumos = new Insumos($_POST);
            $valor = $insumos->desc;
            $existe = Insumos::SQL("SELECT * from codemar_insumos_operaciones where situacion =1 AND desc = '$valor'");
            if (count($existe) > 0) {
                echo json_encode([
                    "mensaje" => "El valor no se modificó.",
                    "codigo" => 2,
                ]);
                exit;
            }

            $resultado = $insumos->guardar();

            if ($resultado['resultado'] == 1) {
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
    }

    public static function eliminarAPI()
    {
        getHeadersApi();
        hasPermissionApi(['AMC_ADMIN']);

        $_POST['situacion'] = 0;
        $insumos = new Insumos($_POST);

        $resultado = $insumos->guardar();

        if ($resultado['resultado'] == 1) {
            echo json_encode([
                "resultado" => 1
            ]);

        } else {
            echo json_encode([
                "resultado" => 0
            ]);

        }
    }
    public static function cambioSituacionAPI()
    {
        getHeadersApi();
        hasPermissionApi(['AMC_ADMIN']);
        if ($_POST['situacion'] == 1) {
            $_POST['situacion'] = 2;
        } else {
            $_POST['situacion'] = 1;

        }
        $insumos = new Insumos($_POST);
        $resultado = $insumos->guardar();
        if ($resultado['resultado'] == 1) {
            echo json_encode([
                "resultado" => 1
            ]);

        } else {
            echo json_encode([
                "resultado" => 2
            ]);

        }
    }



}