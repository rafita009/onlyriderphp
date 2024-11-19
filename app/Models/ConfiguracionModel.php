<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracionModel extends Model
{
    protected $table = 'configuracion';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'valor'];
    
    // Desactivar todas las características que no necesitamos
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $useSoftUpdates = false;
    protected $useSoftCreates = false;

    protected $useTimestamps = true;
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedfield = '';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

 

    public function __construct()
    {
        parent::__construct();
    }
   
}