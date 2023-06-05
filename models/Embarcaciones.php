<?php

namespace Model;

class Embarcaciones extends ActiveRecord{

    protected static $tabla = 'codemar_embarcaciones'; //nombre de la tablaX
    protected static $columnasDB = ['EMB_NOMBRE','EMB_TIPO','EMB_SITUACION'];
    protected static $idTabla = 'EMB_ID';

    public $emb_id;
    public $emb_nombre;
    public $emb_tipo;
    public $emb_situacion;


    public function __construct($args = []){
        $this->emb_id = $args['emb_id'] ?? null;
        $this->emb_nombre = utf8_decode(mb_strtoupper(trim($args['emb_nombre']))) ??'';
        $this->emb_tipo = utf8_decode(mb_strtoupper(trim($args['emb_tipo']))) ??'';
        $this->emb_situacion = $args['emb_situacion'] ?? '1';
    }

} 