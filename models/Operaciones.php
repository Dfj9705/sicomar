<?php
namespace Model;

use Model\ActiveRecord;

class Operaciones extends ActiveRecord
{
    protected static $tabla = 'codemar_tipos_operaciones';
    protected static $columnasDB = ['tipo_desc', 'tipo_situacion'];
    protected static $idTabla = 'tipo_id';

    public $tipo_id;
    public $tipo_desc;
    // public $emb_tipo;
    public $tipo_situacion;

    public function __construct($args = [])
    {
        $this->tipo_id = $args['tipo_id'] ?? null;
        $this->tipo_desc = utf8_decode(trim(mb_strtoupper($args['tipo_desc']))) ?? '';
        // $this->emb_tipo = $args['emb_tipo'] ?? '';
        $this->tipo_situacion = $args['tipo_situacion'] ?? '1';
    }


}

?>