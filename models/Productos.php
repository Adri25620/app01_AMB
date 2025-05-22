<?php

namespace Model;

class Productos extends ActiveRecord
{

    public static $tabla = 'productos';
    public static $columnasDB = [

        'pro_nombre',
        'pro_cantidad',
        'pro_categoria',
        'pro_prioridad',
        'pro_comprado',
        'pro_situacion'
    ];
    public static $idTabla = 'pro_id';

    public $pro_id;
    public $pro_nombre;
    public $pro_cantidad;
    public $pro_categoria;
    public $pro_prioridad;
    public $pro_comprado;
    public $pro_situacion;


    public function __construct($args = []){
        $this->pro_id = $args['pro_id'] ?? null;
        $this->pro_nombre = $args['pro_nombre'] ?? '';
        $this->pro_cantidad = $args['pro_cantidad'] ?? '';
        $this->pro_categoria = $args['pro_categoria'] ?? '';
        $this->pro_prioridad = $args['pro_prioridad'] ?? ''; 
        $this->pro_comprado = $args['pro_comprado'] ?? 0;
        $this->pro_situacion = $args['pro_situacion'] ?? 1;   
        
    }


    public static function EliminarProductos($id){

        $sql = "UPDATE productos SET pro_situacion = 0 WHERE pro_id = $id";
        return self::SQL($sql);
    }


    public static function ProductoComprado($id){

        $sql = "UPDATE productos SET pro_comprado = 1 WHERE pro_id = $id AND pro_situacion = 1";
        return self::SQL($sql);
    }
}
