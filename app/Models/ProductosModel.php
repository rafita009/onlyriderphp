<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table = 'tab_productos';
    protected $primaryKey = 'id_producto';
    
    public function __construct()
    {
        parent::__construct();
    }
    public function countProductos() 
    {
        return $this->db->table($this->table)->countAllResults();
      
    }
}

?>