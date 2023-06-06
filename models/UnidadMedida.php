<?php

namespace Model;

class UnidadMedida extends ActiveRecord{
    
    protected static $tabla = 'codemar_unidades_medida'; //nombre de la tablaX
    protected static $columnasDB = ['uni_desc','uni_situacion'];
    protected static $idTabla = 'uni_id';

    public $uni_id;
    public $uni_desc;
    public $uni_situacion;


    public function __construct($args = []){
        $this->uni_id = $args['uni_id'] ?? null;
        // $this->desc = $args['desc'] ?? '';
        $this->uni_desc = utf8_decode(mb_strtoupper(trim($args['uni_desc']))) ??'';
        $this->uni_situacion = $args['uni_situacion'] ?? '1';
    }

}