<?php

namespace Controllers;

use Model\ActiveRecord;
use MVC\Router;

class ProductoController extends ActiveRecord {

    public function paginainicio(Router $router){
        $router->render('productos/index', []);
    }
}