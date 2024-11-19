<?php

namespace App\Models;

use CodeIgniter\Model;

class ProveedoresModel extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre','activo','contacto'];

    protected $useTimestamps = true;

    protected $createdField = 'fecha_alta';
    protected $updatedField = 'fecha_edit';
    protected $deletedField = 'deleted_at';


    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function __construct()
    {
        parent::__construct();
    }
   
}