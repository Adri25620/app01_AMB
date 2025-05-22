<?php

namespace Controllers;

use Exception;
use Model\Categorias;
use Model\ActiveRecord;
use MVC\Router;

class CategoriaController extends ActiveRecord
{

    public function paginainicio(Router $router)
    {
        $router->render('categorias/index', []);
    }


    public static function guardarAPI()
    {

        getHeadersApi();

        $_POST['cat_nom'] = htmlspecialchars($_POST['cat_nom']);
        $_POST['cat_nom'] = ucwords(strtolower($_POST['cat_nom']));

        $cantidad_nombre = strlen($_POST['cat_nom']);
        if ($cantidad_nombre > 2) {

            try {

                $data = new Categorias([
                    'cat_nom' => $_POST['cat_nom'],
                    'cat_situacion' => 1
                ]);

                $crear = $data->crear();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Exito, se registro la categoria'
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Error al guardar',
                    'detalle' => $e->getMessage(),
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'El nombre es invalido porque no tiene sentido'
            ]);
            return;
        }
    }


    public static function buscarAPI(){

        try {

            $sql = "SELECT * FROM categorias where cat_situacion = 1";
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Categorias obtenidas correctamente',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener las categorias',
                'detalle' => $e->getMessage(),
            ]);
        }
    }


    public static function modificarAPI() {

        getHeadersApi();

        $id = $_POST['cat_id'];
        $_POST['cat_nom'] = htmlspecialchars($_POST['cat_nom']);
        $_POST['cat_nom'] = ucwords(strtolower($_POST['cat_nom']));

        $cantidad_nombre = strlen($_POST['cat_nom']);
        if ($cantidad_nombre > 2) {

            try {

                $data = Categorias::find($id);
                $data->sincronizar([
                    'cat_nom' => $_POST['cat_nom'],
                    'cat_situacion' => 1
                ]);
                $data->actualizar();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Exito, se modifico la categoria'
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Error al guardar',
                    'detalle' => $e->getMessage(),
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'El nombre es invalido porque no tiene sentido'
            ]);
            return;
        }
    }


    public static function EliminarAPI() {

        try{

            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

            $ejecutar = Categorias::EliminarCategorias($id);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'El registro ha sido eliminado correctamente'
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Eliminar',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
