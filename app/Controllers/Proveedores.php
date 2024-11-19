<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProveedoresModel;

class Proveedores extends BaseController
{
    protected $proveedores;

    public function __construct()
    {
        $this->proveedores = new ProveedoresModel();
    }

    public function index($activo = 1)
    {
        $proveedores = $this->proveedores->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Proveedores', 'datos' => $proveedores];

        echo view('proveedores/proveedores', $data);
    }
    public function eliminados($activo = 0)
    {
        $proveedores = $this->proveedores->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Proveedores eliminados', 'datos' => $proveedores];

        echo view('proveedores/eliminados', $data);
    }
    public function nuevo()
    {
        $data = ['titulo' => 'Agregar Proveedor'];
        echo view('proveedores/nuevo', $data);
    }
    public function insertar()
    {
        $this->proveedores->save(['nombre' => $this->request->getPost('nombre'), 'contacto'=> $this->request->getPost('contacto')]);
        return redirect()->to(base_url() . 'proveedores');
    }
    public function editar($id)
    {
        $unidad = $this->proveedores->where('id', $id)->first();

        $data = ['titulo' => 'Editar Proveedor', 'datos' => $unidad];
        echo view('proveedores/editar', $data);
    }
    public function actualizar()
    {
        $this->proveedores->update( $this->request->getPost('id'), ['nombre' =>
        $this->request->getPost('nombre'), 'contacto' => $this->request->getPost('contacto')]);
        return redirect()->to(base_url() . 'proveedores');
    }
    public function eliminar($id)
    {
        $this->proveedores->update( $id, ['activo'=> 0]);
        return redirect()->to(base_url() . 'proveedores');
    }
    public function reingresar($id)
    {
        $this->proveedores->update( $id, ['activo'=> 1]);
        return redirect()->to(base_url() . 'proveedores');
    }
}
