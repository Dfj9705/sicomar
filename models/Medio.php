<?php
namespace Model;

class Medio extends ActiveRecord{

    protected static $tabla = 'codemar_medios_comunicacion'; //nombre de la tablaX
    protected static $columnasDB = ['medio_desc','medio_situacion'];
    protected static $idTabla = 'medio_id';

    public $medio_id;
    public $medio_desc;
    public $medio_situacion;


    public function __construct($args = []){
        $this->medio_id = $args['medio_id'] ?? null;
        $this->medio_desc = utf8_decode(mb_strtoupper(trim($args['medio_desc']))) ??'';
        // $this->mot_embarcaciones = utf8_decode(mb_strtoupper(trim($args['mot_embarcaciones']))) ??'';
        $this->medio_situacion = $args['medio_situacion'] ?? '1';
    }


}

?>