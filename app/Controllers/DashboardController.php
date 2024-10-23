<?php

namespace App\Controllers;

use App\Models\AdministradoresModel;
use App\Models\ClientesModel;
use App\Models\ProductosModel;
use App\Models\VentasModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        // Instanciar los modelos
        $AdministradorModel = new AdministradoresModel();
        $ClientesModel = new ClientesModel();
        $ProductosModel = new ProductosModel();
        $VentasModel = new VentasModel();

        // Recoger los datos y combinarlos en un solo array
        $data = [
            'administradores' => $AdministradorModel->countAdministradores(),
            'clientes'        => $ClientesModel->countClientes(),
            'productos'       => $ProductosModel->countProductos(),
            'ventas'          => $VentasModel->countVentas(),
        ];

        // Pasar los datos a la vista y renderizar todas las partes necesarias
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('dashboard', ['result' => $data])
            . view('templates/footer');
    }
}
