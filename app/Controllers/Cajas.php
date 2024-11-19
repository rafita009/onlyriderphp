<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CajasModel;
use App\Models\ArqueoCajaModel;

class Cajas extends BaseController
{
    protected $cajas, $arqueoModel;
    protected $reglas;

    public function __construct()
    {
        $this->cajas = new CajasModel();
        $this->arqueoModel = new ArqueoCajaModel();
        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'numero_caja' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Caja Numero es obligatorio.'
                ]
            ]
        ];
    }

    public function index($activo = 1)
    {
        $cajas = $this->cajas->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Cajas', 'datos' => $cajas];

        echo view('cajas/cajas', $data);
    }
    public function eliminados($activo = 0)
    {
        $cajas = $this->cajas->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Cajas eliminadas', 'datos' => $cajas];

        echo view('cajas/eliminados', $data);
    }
    public function nuevo()
    {
        $data = ['titulo' => 'Agregar Caja'];
        echo view('cajas/nuevo', $data);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {
            $this->cajas->save(['numero_caja' => $this->request->getPost('numero_caja'), 'nombre' =>
            $this->request->getPost('nombre'), 'folio' => $this->request->getPost('folio')]);
            return redirect()->to(base_url() . 'cajas');
        } else {
            $data = ['titulo' => 'Agregar Caja', 'validation' => $this->validator];
            echo view('cajas/nuevo', $data);
        }
    }
    public function editar($id, $valid = null)
    {
        $unidad = $this->cajas->where('id', $id)->first();

        if ($valid != null) {
            $data = ['titulo' => 'Editar Cajas', 'datos' => $unidad, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar Cajas', 'datos' => $unidad];
        }
        echo view('cajas/editar', $data);
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {

            $this->cajas->update($this->request->getPost('id'), ['numero_caja' =>
            $this->request->getPost('numero_caja'), 'nombre' => $this->request->getPost('nombre'), 'folio' =>
            $this->request->getPost('folio')]);
            return redirect()->to(base_url() . 'cajas');
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    public function eliminar($id)
    {
        $this->cajas->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . 'cajas');
    }
    public function reingresar($id)
    {
        $this->cajas->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . 'cajas');
    }
    public function arqueo($idCaja)
    {
        $arqueos = $this->arqueoModel->getDatos($idCaja);

        $data = ['titulo' => 'Cierres de caja', 'datos' => $arqueos];

        echo view('cajas/arqueos', $data);
    }
    public function nuevo_arqueo(){
        $session = session();
        if($this->request->getMethod() == "POST"){
            $fecha = date('Y-m-d h:i:s');
            

        }else{
            $caja = $this->cajas->where('id',$session->id_caja)->first();
            $data = ['titulo' => 'Apertura de caja', 'caja' => $caja, 'session' => $session];

            return view('cajas/nuevo_arqueo', $data);
        }
    }
}
