<?php

namespace App\Models;

use CodeIgniter\Model;

class ComprasModel extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['folio','total','id_usuario','activo'];

    protected $useTimestamps = true;

    protected $createdField = 'fecha_alta';
    protected $updatedField = '';
    protected $deletedField = '';


    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function __construct()
    {
        parent::__construct();
    }
   public function insertaCompra($id_compra, $total, $id_usuario){
    $this->insert([
        'folio' => $id_compra,
        'total' => $total, 
        'id_usuario' => $id_usuario]);

        return $this->insertID();

   }
   public function totalCompras(){
    return $this->where('activo',1)->countAllResults();
   }
}