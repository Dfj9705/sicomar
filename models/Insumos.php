<?php
namespace Model;
class Insumos extends ActiveRecord{

    protected static $tabla = 'codemar_insumos_operaciones'; //nombre de la tablaX
    protected static $columnasDB = ['INSUMO_DESC','INSUMO_UNIDAD','INSUMO_COLOR','INSUMO_SITUACION'];
    protected static $idTabla = 'INSUMO_ID';

    public $insumo_id;
    public $insumo_desc;
    public $insumo_unidad;
    public $insumo_color;
    public $insumo_situacion;


    public function __construct($args = []){
        $this->insumo_id = $args['insumo_id'] ?? null;
        $this->insumo_desc = utf8_decode(mb_strtoupper(trim($args['emb_nombre']))) ??'';
        $this->insumo_unidad = utf8_decode(mb_strtoupper(trim($args['insumo_unidad']))) ??'';
        $this->insumo_color = $args['insumo_color'] ?? null;
        $this->insumo_situacion = $args['insumo_situacion'] ?? '1';
    }
}


?>