<?php

namespace Controllers;

use Model\ActiveRecord;
use MVC\Router;

class CategoriaController extends ActiveRecord {

    public function paginainicio(Router $router){
        $router->render('categorias/index', []);
    }
}