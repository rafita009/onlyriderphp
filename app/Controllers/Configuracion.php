<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;
use App\Models\LogsModel;

class Configuracion extends BaseController
{
    protected $configuracion;
    protected $reglas, $logs;

    public function __construct()
    {
        $this->configuracion = new ConfiguracionModel();
        $this->logs = new LogsModel();
        helper(['form', 'upload']);

        $this->reglas = [
            'tienda_nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'tienda_ruc' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    public function index($activo = 1)
    {
        $nombre = $this->configuracion->where('nombre', 'tienda_nombre')->first();
        $ruc = $this->configuracion->where('nombre', 'tienda_ruc')->first();
        $telefono = $this->configuracion->where('nombre', 'tienda_telefono')->first();
        $direccion = $this->configuracion->where('nombre', 'tienda_direccion')->first();
        $correo = $this->configuracion->where('nombre', 'tienda_email')->first();
        $mensaje = $this->configuracion->where('nombre', 'factura_mensaje')->first();

        $data = ['titulo' => 'Configuracion', 'nombre' => $nombre, 'ruc' => $ruc, 'telefono' => $telefono, 'direccion' => $direccion, 'correo' => $correo, 'mensaje' => $mensaje];

        echo view('configuracion/configuracion', $data);
    }


    public function actualizar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {
            try {
                $db = db_connect();
                
                // Lista de configuraciones a actualizar
                $configuraciones = [
                    'tienda_nombre' => $this->request->getPost('tienda_nombre'),
                    'tienda_ruc' => $this->request->getPost('tienda_ruc'),
                    'tienda_telefono' => $this->request->getPost('tienda_telefono'),
                    'tienda_direccion' => $this->request->getPost('tienda_direccion'),
                    'tienda_email' => $this->request->getPost('tienda_email'),
                    'factura_mensaje' => $this->request->getPost('factura_mensaje')
                ];
                 $validacion = $this->validate([
                    'tienda_logo' => [
                        'uploaded[tienda_logo]',
                        'mime_in[tienda_logo,image/png]',
                        'max_size[tienda_logo,4096]'
                    ]
                 ]  );
                 if($validacion){
                    $ruta_logo = "images/logotipo.png";
                    if(file_exists($ruta_logo)){
                        unlink($ruta_logo);
                    }
                    $img= $this->request->getfile('tienda_logo');
                    $img -> move('./images', 'logotipo.png');

                 }else{
                    echo 'Error en la validacion';
                    exit;
                 }
                // Actualizar cada configuración
                foreach ($configuraciones as $nombre => $valor) {
                    $db->query("UPDATE configuracion SET valor = ? WHERE nombre = ?", [$valor, $nombre]);
                }

                $db->close();
                
                session()->setFlashdata('mensaje', 'Configuración actualizada correctamente');
                return redirect()->to(base_url() . 'configuracion');

            } catch (\Exception $e) {
                log_message('error', '[ERROR] {exception}', ['exception' => $e]);
                session()->setFlashdata('error', 'Error al actualizar la configuración');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }
    }
    public function verLogs(){
      $logs= $this->logs->findAll();
      
      $data = ['titulo' => 'Logs', 'logs'=> $logs];
      echo view('logs/logs', $data);
    }
}
