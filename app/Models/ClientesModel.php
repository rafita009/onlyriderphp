<?php
namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table = 'tab_clientes';
    protected $primaryKey = 'id_cliente';
   
    public function __construct()
    {
        parent::__construct();
    }
    public function countClientes() 
    {
         return $this->db->table($this->table)->countAllResults();
       
    }
}
?>