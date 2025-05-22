<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\CategoriaController;
use Controllers\ProductoController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);


//url's categorias
$router->get('/categorias', [CategoriaController::class, 'paginainicio']);
$router->post('/categorias/guardarAPI', [CategoriaController::class, 'guardarAPI']);
$router->get('/categorias/buscarAPI', [CategoriaController::class, 'buscarAPI']);
$router->post('/categorias/modificarAPI', [CategoriaController::class, 'modificarAPI']);
$router->get('/categorias/eliminar', [CategoriaController::class, 'eliminarAPI']);

//url's productos
$router->get('/productos', [ProductoController::class, 'paginainicio']);
$router->post('/productos/guardarAPI', [ProductoController::class, 'guardarAPI']);
$router->get('/productos/buscarAPI', [ProductoController::class, 'buscarAPI']);
$router->get('/productos/buscompraAPI', [ProductoController::class, 'buscompraAPI']);
$router->post('/productos/modificarAPI', [ProductoController::class, 'modificarAPI']);
$router->get('/productos/eliminar', [ProductoController::class, 'eliminarAPI']);
$router->get('/productos/comprado', [ProductoController::class, 'compradoAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
