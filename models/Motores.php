<?php

namespace Model;

class Motores extends ActiveRecord{

    protected static $tabla = 'codemar_motores'; //nombre de la tablaX
    protected static $columnasDB = ['mot_serie','mot_embarcacion','mot_situacion'];
    protected static $idTabla = 'mot_id';

    public $mot_id;
    public $mot_serie;
    public $mot_embarcacion;
    public $mot_situacion;


    public function __construct($args = []){
        $this->mot_id = $args['mot_id'] ?? null;
        $this->mot_serie = utf8_decode(mb_strtoupper(trim($args['mot_serie']))) ??'';
        $this->mot_embarcacion = utf8_decode(mb_strtoupper(trim($args['mot_embarcacion']))) ??'';
        $this->mot_situacion = $args['mot_situacion'] ?? '1';
    }

} 