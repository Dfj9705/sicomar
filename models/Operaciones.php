<?php
namespace Model;

class Operaciones extends ActiveRecord{
    protected static $tabla = 'codemar_tipos_operaciones'; //nombre de la tablaX
    protected static $columnasDB = ['tipo_desc','tipo_situacion'];
    protected static $idTabla = 'tipo_id';

    public $tipo_id;
    public $tipo_desc;
    public $tipo_situacion;


    public function __construct($args = []){
        $this->tipo_id = $args['tipo_id'] ?? null;
        // $this->desc = $args['desc'] ?? '';
        $this->tipo_desc = utf8_decode(mb_strtoupper(trim($args['tipo_desc']))) ??'';
        $this->tipo_situacion = $args['tipo_situacion'] ?? '1';
    }

}

?>