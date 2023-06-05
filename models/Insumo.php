<?php

namespace Model;

class Insumos extends ActiveRecord
{

    protected static $tabla = 'codemar_insumos_operaciones'; //nombre de la tablaX
    protected static $columnasDB = ['INSUMO', 'MEDIDA', 'COLOR'];

    public $insumo;
    public $medida;
    public $color;


    public function __construct($args = [])
    {
        $this->insumo = $args['insumo'] ?? null;
        $this->medida = $args['medida'] ?? '';
        $this->color = $args['color'] ?? '1';
    }

}