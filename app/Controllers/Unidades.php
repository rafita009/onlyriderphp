<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnidadesModel;

class Unidades extends BaseController
{
    protected $unidades;
    protected $reglas;

    public function __construct()
    {
        $this->unidades = new UnidadesModel();
        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'nombre_corto' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    public function index($activo = 1)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades', 'datos' => $unidades];

        echo view('unidades/unidades', $data);
    }
    public function eliminados($activo = 0)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades eliminadas', 'datos' => $unidades];

        echo view('unidades/eliminados', $data);
    }
    public function nuevo()
    {
        $data = ['titulo' => 'Agregar Unidad'];
        echo view('unidades/nuevo', $data);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {
            $this->unidades->save(['nombre' => $this->request->getPost('nombre'), 'nombre_corto' =>
            $this->request->getPost('nombre_corto')]);
            return redirect()->to(base_url() . 'unidades');
        } else {
            $data = ['titulo' => 'Agregar Unidad', 'validation' => $this->validator];
            echo view('unidades/nuevo', $data);
        }
    }
    public function editar($id, $valid=null)
    {
        $unidad = $this->unidades->where('id', $id)->first();

        if($valid !=null){
            $data = ['titulo' => 'Editar Unidad', 'datos' => $unidad, 'validation'=> $valid];
        }else{
            $data = ['titulo' => 'Editar Unidad', 'datos' => $unidad];
        }
        echo view('unidades/editar', $data);
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {

            $this->unidades->update($this->request->getPost('id'), ['nombre' =>
            $this->request->getPost('nombre'), 'nombre_corto' => $this->request->getPost('nombre_corto')]);
            return redirect()->to(base_url() . 'unidades');
        }else{
            return $this->editar($this->request->getPost('id'),$this->validator);
        }
    }
    public function eliminar($id)
    {
        $this->unidades->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . 'unidades');
    }
    public function reingresar($id)
    {
        $this->unidades->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . 'unidades');
    }
}
