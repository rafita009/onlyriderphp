<?php
namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table = 'tab_ventas';
    protected $primaryKey = 'id_venta';
    
    public function __construct()
    {
        parent::__construct();

    }
    public function countVentas() 
    {
        return $this->db->table($this->table)->countAllResults();
      
    }
}