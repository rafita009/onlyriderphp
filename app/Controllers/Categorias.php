<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;

class Categorias extends BaseController
{
    protected $categorias;

    public function __construct()
    {
        $this->categorias = new CategoriasModel();
    }

    public function index($activo = 1)
    {
        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Categorias', 'datos' => $categorias];

        echo view('categorias/categorias', $data);
    }
    public function eliminados($activo = 0)
    {
        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Categorias eliminadas', 'datos' => $categorias];

        echo view('categorias/eliminados', $data);
    }
    public function nuevo()
    {
        $data = ['titulo' => 'Agregar Unidad'];
        echo view('categorias/nuevo', $data);
    }
    public function insertar()
    {
        $this->categorias->save(['nombre' => $this->request->getPost('nombre')]);
        return redirect()->to(base_url() . 'categorias');
    }
    public function editar($id)
    {
        $unidad = $this->categorias->where('id', $id)->first();

        $data = ['titulo' => 'Editar Categoria', 'datos' => $unidad];
        echo view('categorias/editar', $data);
    }
    public function actualizar()
    {
        $this->categorias->update( $this->request->getPost('id'), ['nombre' =>
        $this->request->getPost('nombre')]);
        return redirect()->to(base_url() . 'categorias');
    }
    public function eliminar($id)
    {
        $this->categorias->update( $id, ['activo'=> 0]);
        return redirect()->to(base_url() . 'categorias');
    }
    public function reingresar($id)
    {
        $this->categorias->update( $id, ['activo'=> 1]);
        return redirect()->to(base_url() . 'categorias');
    }
}
