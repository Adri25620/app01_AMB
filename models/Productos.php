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
        'pro_comprado'
    ];
    public static $idTabla = 'pro_id';

    public $pro_id;
    public $pro_nombre;
    public $pro_cantidad;
    public $pro_categoria;
    public $pro_prioridad;
    public $pro_comprado;


    public function __construct($args = []){
        $this->pro_id = $args['pro_id'] ?? null;
        $this->pro_nombre = $args['pro_nombre'] ?? '';
        $this->pro_cantidad = $args['pro_cantidad'] ?? '';
        $this->pro_categoria = $args['pro_categoria'] ?? '';
        $this->pro_prioridad = $args['pro_prioridad'] ?? ''; 
        $this->pro_comprado = $args['pro_comprado'] ?? 1;   
        
    }
}
