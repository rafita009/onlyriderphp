<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\TemporalCompraModel;
use App\Models\DetalleCompraModel;
use App\Models\ProductosModel;
use App\Models\ProveedoresModel;
use App\Models\ConfiguracionModel;



class Compras extends BaseController
{
    protected $compras, $temporal_compra, $detalle_compra, $productos, $configuracion;
    protected $reglas;
    protected $proveedores;

    public function __construct()
    {
        $this->compras = new ComprasModel();
        $this->detalle_compra = new DetalleCompraModel();
        $this->proveedores = new ProveedoresModel();
        $this->productos = new ProductosModel();
        $this->configuracion = new ConfiguracionModel();
        helper(['form']);
    }
    public function index($activo = 1)
    {
       $compras = $this->compras->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Compras', 'compras'=> $compras];
        echo view('compras/compras', $data);
    }

    public function nuevo()
    {

        $productos = $this->productos->where('activo', 1)->findAll();
        $proveedores = $this->proveedores->where('activo', 1)->findAll();
        $data = ['titulo' => 'Agregar Compra', 'proveedores' => $proveedores, 'productos' => $productos];
        echo view('compras/nuevo', $data);
    }
    public function guarda()
    {
        $id_proveedor = $this->request->getPost('proveedor') ?: null; // Obtenemos el id del proveedor del formulario
        $id_compra = $this->request->getPost('id_compra');
        $total = preg_replace('/[\$,]/', '', $this->request->getPost('total'));

        $session = session();

        $resultadoId = $this->compras->insertaCompra($id_compra, $total, $session->id_usuario);
        $this->temporal_compra = new TemporalCompraModel();

        if ($resultadoId) {
            $resultadoCompra = $this->temporal_compra->porCompra($id_compra);
            foreach ($resultadoCompra as $row) {
                $this->detalle_compra->save([
                    'id_compra' => $resultadoId,
                    'id_producto' => $row['id_producto'],
                    'id_usuario' => $session->id_usuario,
                    'nombre' => $row['nombre'],
                    'cantidad' => $row['cantidad'],
                    'id_proveedor' => $id_proveedor,
                    'precio' => $row['precio'],
                ]);
                $this->productos = new ProductosModel();
                $this->productos->actualizaStock($row['id_producto'], $row['cantidad']);
            }
            $this->temporal_compra->eliminarCompra($id_compra); // Eliminamos la compra
        }
        return redirect()->to(base_url() . "compras/muestraCompraPdf/" . $resultadoId);
    }
    public function muestraCompraPdf($id_compra)
    {
        $data['id_compra'] = $id_compra;
       return view('compras/ver_compra_pdf', $data);
    }
    public function generaCompraPdf($id_compra)
    {
        $datosCompra = $this->compras->where('id', $id_compra)->first();
        $detalleCompra = $this->detalle_compra->select('detalle_compra.*, proveedores.nombre as nombre_proveedor, productos.codigo as codigo_producto')
            ->join('proveedores', 'detalle_compra.id_proveedor = proveedores.id', 'left')
            ->join('productos', 'detalle_compra.id_producto = productos.id', 'left')  // Agregar este join
            ->where('detalle_compra.id_compra', $id_compra)
            ->findAll();
        $nombreTienda =  $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        $direccionTienda =  $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Compra");
        $pdf->SetFont('Arial', 'B', '8');
        $pdf->Cell(195, 5, "Entrada de productos", 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', '8');
        $pdf->image(base_url() . '/images/logotipo.png', 5, 0, 20, 20, 'PNG');
        $pdf->Cell(50, 5, $nombreTienda, 0, 1, 'l');
        $pdf->SetFont('Arial', 'B', '8');
        $pdf->Cell(20, 5, 'Compra Nro: ', 0, 0, 'L'); 
        $pdf->SetFont('Arial', '', '8');  // Cambia a texto normal
        $pdf->Cell(50, 5, $id_compra, 0, 1, 'L');  
        $pdf->SetFont('Arial', 'B', '8');

        $pdf->Cell(20, 5, 'Proveedor: ', 0, 0, 'L');  // Texto "Proveedor:" en negrita
        $pdf->SetFont('Arial', '', '8');  // Cambia a texto normal
        $pdf->Cell(0, 5, $detalleCompra[0]['nombre_proveedor'], 0, 1, 'L');  // Nombre del proveedor en estilo normal

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', '8');
        $pdf->Cell(50, 5, $direccionTienda, 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', '8');
        $pdf->Cell(25, 5, utf8_decode('Fecha y hora: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', '8');
        $pdf->Cell(50, 5, $datosCompra['fecha_alta'], 0, 1, 'L');

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', '8');
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, 'Detalle de Productos ', 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, 'Nro', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Codigo', 1, 0, 'L');
        $pdf->Cell(77, 5, 'Nombre', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Precio', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Cantidad', 1, 0, 'L');
        $pdf->Cell(30, 5, 'Importe', 1, 1, 'L');


        $contador = 1;

        foreach ($detalleCompra as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(25, 5, $row['codigo_producto'], 1, 0, 'L');
            $pdf->Cell(77, 5, $row['nombre'], 1, 0, 'L');
            $pdf->Cell(25, 5, $row['precio'], 1, 0, 'L');
            $pdf->Cell(25, 5, $row['cantidad'], 1, 0, 'L');
            $importe = number_format($row['precio'] * $row['cantidad'], 2, '.', ',');
            $pdf->Cell(30, 5, '$' . $importe, 1, 1, 'R');
            $contador++;
        }
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', '8');
        $pdf->Cell(195, 5, 'Total $ ' . number_format($datosCompra['total'], 2, '.', ','), 0, 1, 'R');

        $this->response->setheader('Content-Type', 'application/pdf');
        $pdf->Output("compra_pdf.pdf", 'I');
    }
}
