<?php
namespace Model;

class Receptores extends ActiveRecord{
    protected static $tabla = 'codemar_receptor_comunicacion'; //nombre de la tablaX
    protected static $columnasDB = ['rec_desc','rec_situacion'];
    protected static $idTabla = 'rec_id';

    public $rec_id;
    public $rec_desc;
    public $rec_situacion;


    public function __construct($args = []){
        $this->rec_id = $args['rec_id'] ?? null;
        // $this->desc = $args['desc'] ?? '';
        $this->rec_desc = utf8_decode(mb_strtoupper(trim($args['rec_desc']))) ??'';
        $this->rec_situacion = $args['rec_situacion'] ?? '1';
    }

}

?>