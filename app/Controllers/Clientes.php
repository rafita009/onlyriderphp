<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;
use App\Models\ClientesModel;
use App\Models\UnidadesModel;

class Clientes extends BaseController
{
    protected $clientes;
    protected $reglas;

    public function __construct()
    {
        $this->clientes = new ClientesModel();


        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} debe ser unico.',
                ]
            ],

        ];
    }

    public function index($activo = 1)
    {
        $clientes = $this->clientes->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Clientes', 'datos' => $clientes];

        echo view('clientes/clientes', $data);
    }
    public function eliminados($activo = 0)
    {
        $clientes = $this->clientes->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Clientes eliminados', 'datos' => $clientes];

        echo view('clientes/eliminados', $data);
    }
    public function nuevo()
    {


        $data = ['titulo' => 'Agregar Clientes'];
        echo view('clientes/nuevo', $data);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {
            $this->clientes->save([
                'nombre' => $this->request->getPost('nombre'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'correo' => $this->request->getPost('correo'),
                'identificacion' => $this->request->getPost('identificacion')
            ]);
            return redirect()->to(base_url() . 'ventas/caja');
        } else {


            $data = ['titulo' => 'Agregar Clientes',  'validation' => $this->validator];

            echo view('clientes/nuevo', $data);
        }
    }
    public function editar($id)
    {



        $clientes = $this->clientes->where('id', $id)->first();
        $data = ['titulo' => 'Editar Clientes', 'clientes' => $clientes];



        echo view('clientes/editar', $data);
    }
    public function actualizar()
    {


        $this->clientes->update($this->request->getPost('id'), [
            'nombre' => $this->request->getPost('nombre'),
            'direccion' => $this->request->getPost('direccion'),
            'telefono' => $this->request->getPost('telefono'),
            'correo' => $this->request->getPost('correo'),
            'identificacion' => $this->request->getPost('identificacion')
        ]);


        return redirect()->to(base_url() . 'clientes');
    }
    public function eliminar($id)
    {
        $this->clientes->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . 'clientes');
    }
    public function reingresar($id)
    {
        $this->clientes->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . 'clientes');
    }
    public function autocompleteData()
    {
        $returnData = array();

        $valor = $this->request->getGet('term');

        $clientes = $this->clientes->like('nombre', $valor)->where('activo', 1)->findAll();
        if (!empty($clientes)) {
            foreach ($clientes as $row) {
                $data['id'] = $row['id'];
                $data['value'] = $row['nombre'];
                array_push($returnData, $data);
            }
        }
        echo json_encode($returnData);
    }
}
