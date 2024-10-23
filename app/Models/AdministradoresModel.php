<?php

namespace App\Models;

use CodeIgniter\Model;

class AdministradoresModel extends Model
{
    protected $table = 'tab_administradores';
    protected $primaryKey = 'id_administrador';

    public function __construct()
    {
        parent::__construct();
    }
    public function countAdministradores() 
    {
        return $this->db->table($this->table)->countAllResults();
      
    }
}
