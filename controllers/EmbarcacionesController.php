<?php
namespace Controllers;

use Model\Embarcaciones;
use MVC\Router;

class EmbarcacionesController
{
    public static function index(Router $router)
    {
        $busqueda = Embarcaciones::fetchArray('SELECT * FROM codemar_tipos_embarcaciones');
        $router->render('embarcaciones/index', ['busqueda' => $busqueda]);
    }


    ///////////////
    public function guardarAPI()
    {
        getHeadersApi();
        // hasPermissionApi(['AMC_ADMIN']);



        try {

            $enbarcaciones = new Embarcaciones($_POST);
            $dato = $enbarcaciones->emb_nombre;
            $sql = "SELECT * FROM codemar_embarcaciones where emb_nombre = '$dato' and emb_situacion = 1 ";
            $existe = Embarcaciones::fetchArray($sql);
            // echo json_encode($existe);
            // exit;
            if (count($existe) > 0) {
                echo json_encode([
                    "mensaje" => "El registro ya existe.",
                    "codigo" => 2,
                ]);
                exit;
            }

            $resultado = $enbarcaciones->crear();

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
            $embarcaciones = Embarcaciones::fetchArray('SELECT * from codemar_embarcaciones');
            echo json_encode($embarcaciones);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }




    }

    public function modificarAPI()
    {
        getHeadersApi();


        try {


            $emb_id = $_POST['emb_id'];
            $valor = $_POST['emb_nombre'];
            $existe = Embarcaciones::fetchArray("SELECT * from codemar_embarcaciones where emb_id = 1 AND emb_situacion = $valor");


            echo json_encode($existe);
            exit;


            if (count($existe) > 0) {
                echo json_encode($_POST['emb_nombre']);
                echo json_encode([
                    "mensaje" => "El valor no se modificó.",
                    "codigo" => 2,
                ]);
                exit;
            }
            $emb_id = new Embarcaciones($_POST);
            echo json_encode($emb_id);
            exit;
            $resultado = $emb_id->actualizar();


            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    "mensaje" => "El registro se actualizó correctamente",
                    "codigo" => 1,
                ]);
                exit;
            } else {
                echo json_encode([
                    "mensaje" => "Error al guardar registro",
                    "codigo" => 3,
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
<?php
namespace Controllers;
use Model\Embarcaciones;
use MVC\Router;
