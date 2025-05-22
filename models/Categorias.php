<?php

namespace Model;

class Categorias extends ActiveRecord
{

    public static $tabla = 'categorias';
    public static $columnasDB = [

        'cat_nom',
        'cat_situacion'
    ];
    public static $idTabla = 'cat_id';

    public $cat_id;
    public $cat_nom;
    public $cat_situacion;


    public function __construct($args = []){
        $this->cat_id = $args['cat_id'] ?? null;
        $this->cat_nom = $args['cat_nom'] ?? '';
        $this->cat_situacion = $args['cat_situacion'] ?? 1;
    }

    public static function EliminarCategorias($id){

        $sql = "UPDATE categorias SET cat_situacion = 0 WHERE cat_id = $id";

        return self::SQL($sql);
    }
}