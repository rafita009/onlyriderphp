<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre','usuario','password','nombre','id_caja','id_rol','activo'];

    protected $useTimestamps = true;

    protected $createdField = 'fecha_alta';
    protected $updatedField = 'fecha_modifica';
    protected $deletedField = 'deleted_at';


    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function __construct()
    {
        parent::__construct();
    }
   
}