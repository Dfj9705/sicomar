<?php

namespace Model;

class Motores extends ActiveRecord{

    protected static $tabla = 'codemar_motores'; //nombre de la tablaX
    protected static $columnasDB = ['MOT_SERIE','MOT_EMBARCACIONES','MOT_SITUACION'];
    protected static $idTabla = 'MOT_ID';

    public $mot_id;
    public $mot_serie;
    public $mot_embarcaciones;
    public $mot_situacion;


    public function __construct($args = []){
        $this->mot_id = $args['mot_id'] ?? null;
        $this->mot_serie = utf8_decode(mb_strtoupper(trim($args['mot_serie']))) ??'';
        $this->mot_embarcaciones = utf8_decode(mb_strtoupper(trim($args['mot_embarcaciones']))) ??'';
        $this->mot_situacion = $args['mot_situacion'] ?? '1';
    }

} 