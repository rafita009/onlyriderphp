<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'codigo',
        'nombre',
        'nombre_corto',
        'precio_venta',
        'precio_compra',
        'existencias',
        'stock_minimo',
        'inventariable',
        'id_unidad',
        'id_categoria',
        'activo'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'fecha_alta';
    protected $updatedField = '';
    protected $deletedField = 'deleted_at';


    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function __construct()
    {
        parent::__construct();
    }
    public function actualizaStock($id_producto, $cantidad, $operador = '+')
    {
        $this->set('existencias', "existencias $operador $cantidad", false);
        $this->where('id', $id_producto);
        $this->update();
    }
    public function getProductosConCategoria($activo = 1)
    {
        return $this->select('productos.*, categorias.nombre AS categoria_nombre')
            ->join('categorias', 'categorias.id = productos.id_categoria', 'left')
            ->where('productos.activo', $activo)
            ->findAll();
    }

    public function totalProductos()
    {
        return $this->where('activo', 1)->countAllResults(); // num_rows
    }
    public function productosMinimo()
    {
        $where = "stock_minimo >= existencias AND inventariable=1 AND activo = 1";
        $this->where($where);
        $sql = $this->countAllResults();
        return $sql;
    }
    public function getProductosMinimo()
    {
        $where = "stock_minimo >= existencias AND inventariable=1 AND activo = 1";
        return $this->where($where)->findAll();
    }
}
