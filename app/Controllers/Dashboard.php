<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\VentasModel;
use App\Models\ClientesModel;
use App\Models\ComprasModel;

class Dashboard extends BaseController
{
    protected $productosModel;
    protected $ventasModel;
    protected $comprasModel;
    protected $clientesModel, $session;

    public function __construct()
    {
        $this->productosModel = new ProductosModel();
        $this->ventasModel = new VentasModel();
        $this->comprasModel = new ComprasModel();
        $this->clientesModel = new ClientesModel();
        $this->session = session();
    }


    public function index()
    {
        
        if(!isset($this->session->id_usuario)){ return redirect()->to(base_url());}

        $totalProductos = $this->productosModel->totalProductos();
        $hoy = date('Y-m-d');
        $totalVentas = $this->ventasModel->totalDia($hoy); //2020-11-05
        $minimos = $this->productosModel->productosMinimo();


        $totalClientes = $this->clientesModel->totalClientes();
        $datos = ['totalProductos' => $totalProductos, 'totalVentas' => $totalVentas, 'totalClientes' => $totalClientes, 'minimos' => $minimos];

        return view('admin/dashboard', $datos);
    }
}
