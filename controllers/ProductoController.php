<?php

namespace Controllers;

use Exception;
use Model\Productos;
use Model\Categorias;
use Model\ActiveRecord;
use MVC\Router;

class ProductoController extends ActiveRecord
{

    public function paginainicio(Router $router)
    {
        $categorias = Categorias::all();
        $productos = Productos::all();

        $router->render('productos/index', [
            'categorias' => $categorias,
            'productos' => $productos
        ]);
    }



    public static function guardarAPI()
    {

        getHeadersApi();

        $_POST['pro_nombre'] = htmlspecialchars($_POST['pro_nombre']);
        $_POST['pro_nombre'] = ucwords(strtolower($_POST['pro_nombre']));

        $cantidad_nombres = strlen($_POST['pro_nombre']);

        if ($cantidad_nombres < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el nombre debe de ser mayor a dos'
            ]);
            return;
        }

        $nombreProducto = $_POST['pro_nombre'];
        $sql = "SELECT COUNT(*) as total FROM productos WHERE LOWER(pro_nombre) = LOWER('$nombreProducto') AND pro_situacion = 1 AND pro_comprado = 0";
        $resultado = self::fetchArray($sql);

        if ($resultado[0]['total'] > 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Ya existe un producto con el nombre "' . $nombreProducto . '". Por favor ingresá un nombre diferente.'
            ]);
            return;
        }

        $_POST['pro_cantidad'] = filter_var($_POST['pro_cantidad'], FILTER_VALIDATE_INT);

        if ($_POST['pro_cantidad'] === false || $_POST['pro_cantidad'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Debe de ingresar un numero mayor a 0'
            ]);
            return;
        }

        $_POST['pro_categoria'] = filter_var($_POST['pro_categoria'], FILTER_VALIDATE_INT);
        if ($_POST['pro_categoria'] === false || $_POST['pro_categoria'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Debe seleccionar una categoría válida'
            ]);
            return;
        }

        $_POST['pro_prioridad'] = htmlspecialchars($_POST['pro_prioridad']);
        $_POST['pro_prioridad'] = ucwords(strtolower($_POST['pro_prioridad']));

        $prioridad = $_POST['pro_prioridad'];

        if ($prioridad == "A" || $prioridad == "M" || $prioridad == "B") {


            try {


                $data = new Productos([
                    'pro_nombre' => $_POST['pro_nombre'],
                    'pro_cantidad' => $_POST['pro_cantidad'],
                    'pro_categoria' => $_POST['pro_categoria'],
                    'pro_prioridad' => $_POST['pro_prioridad'],
                    'pro_comprado' => 0,
                    'pro_situacion' => 1
                ]);

                $crear = $data->crear();


                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Exito, el producto ha sido registrado correctamente'
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
                'mennsaje' => 'Los detinos solo puedes ser "A, M, B"'
            ]);
            return;
        }
    }


    public static function buscarAPI()
    {

        try {

            $sql = "SELECT cat_nom,* FROM productos
            JOIN categorias ON pro_categoria = cat_id 
            WHERE pro_situacion = 1 AND pro_comprado = 0
            ORDER BY 
            CASE pro_prioridad 
                WHEN 'A' THEN 1
                WHEN 'M' THEN 2
                WHEN 'B' THEN 3
            ELSE 4
            END ASC,
          pro_nombre ASC";;
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Productos pendientes obtenidos correctamente',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener los productos pendientes',
                'detalle' => $e->getMessage(),
            ]);
        }
    }


    public static function buscompraAPI()
    {
        try {

            $sql = "SELECT cat_nom,* FROM productos
            JOIN categorias ON pro_categoria = cat_id 
            WHERE pro_situacion = 1 AND pro_comprado = 1";
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Productos comprados obtenidos correctamente',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener los productos comprados',
                'detalle' => $e->getMessage(),
            ]);
        }
    }


    public static function modificarAPI()
    {

        getHeadersApi();

        $id = $_POST['pro_id'];
        $_POST['pro_nombre'] = htmlspecialchars($_POST['pro_nombre']);
        $_POST['pro_nombre'] = ucwords(strtolower($_POST['pro_nombre']));

        $cantidad_nombres = strlen($_POST['pro_nombre']);

        if ($cantidad_nombres < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el nombre debe de ser mayor a dos'
            ]);
            return;
        }

        $nombreProducto = $_POST['pro_nombre'];
        $sql = "SELECT COUNT(*) as total FROM productos WHERE LOWER(pro_nombre) = LOWER('$nombreProducto') AND pro_situacion = 1 AND pro_id != $id AND pro_comprado = 0";
        $resultado = self::fetchArray($sql);

        if ($resultado[0]['total'] > 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Ya existe otro producto con el nombre "' . $nombreProducto . '". Por favor ingresá un nombre diferente.'
            ]);
            return;
        }

        $_POST['pro_cantidad'] = filter_var($_POST['pro_cantidad'], FILTER_VALIDATE_INT);

        if ($_POST['pro_cantidad'] === false || $_POST['pro_cantidad'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mennsaje' => 'Debe de ingresar un numero mayor a 0'
            ]);
            return;
        }

        $_POST['pro_categoria'] = filter_var($_POST['pro_categoria'], FILTER_VALIDATE_INT);
        if ($_POST['pro_categoria'] === false || $_POST['pro_categoria'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Debe seleccionar una categoría válida'
            ]);
            return;
        }

        $_POST['pro_prioridad'] = htmlspecialchars($_POST['pro_prioridad']);
        $_POST['pro_prioridad'] = ucwords(strtolower($_POST['pro_prioridad']));

        $prioridad = $_POST['pro_prioridad'];

        if ($prioridad == "A" || $prioridad == "M" || $prioridad == "B") {

            try {

                $data = Productos::find($id);
                $data->sincronizar([
                    'pro_nombre' => $_POST['pro_nombre'],
                    'pro_cantidad' => $_POST['pro_cantidad'],
                    'pro_categoria' => $_POST['pro_categoria'],
                    'pro_prioridad' => $_POST['pro_prioridad'],
                    'pro_comprado' => 0,
                    'pro_situacion' => 1
                ]);
                $data->actualizar();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Exito, el producto ha sido modificado correctamente'
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
                'mennsaje' => 'Los detinos solo puedes ser "A, M, B"'
            ]);
            return;
        }
    }


    public static function eliminarAPI()
    {
        try {

            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

            $ejecutar = Productos::EliminarProductos($id);

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


    public static function compradoAPI()
    {
        try {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

            if (!$id || $id <= 0) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'ID de producto inválido'
                ]);
                return;
            }

            $ejecutar = Productos::ProductoComprado($id);

            if ($ejecutar) {
                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'El producto se marcó como comprado correctamente'
                ]);
            } else {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'No se pudo actualizar el producto'
                ]);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al cambiar el estado del producto',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
