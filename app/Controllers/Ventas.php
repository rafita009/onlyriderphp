<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\TemporalCompraModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductosModel;
use App\Models\ProveedoresModel;
use App\Models\ConfiguracionModel;
use App\Models\CajasModel;




class Ventas extends BaseController
{
    protected $ventas, $temporal_compra, $detalle_venta, $productos, $configuracion, $cajas,$session;



    public function __construct()
    {
        $this->ventas = new VentasModel();
        $this->detalle_venta = new DetalleVentaModel();
        $this->productos = new ProductosModel();
        $this->configuracion = new ConfiguracionModel();
        $this->cajas = new CajasModel();
        $this->session = session();
        helper(['form']);
    }
    public function index()
    {
        $datos = $this->ventas->obtener(1);
        $data = ['titulo' => 'Ventas', 'datos' => $datos];
        echo view('ventas/ventas', $data);
    }
    public function eliminados()
    {
        $datos = $this->ventas->obtener(0);
        $data = ['titulo' => 'Ventas eliminadas', 'datos' => $datos];
        echo view('ventas/eliminados', $data);
    }

    public function venta()
    {
        if(!isset($this->session->id_usuario)){ return redirect()->to(base_url());}

        $productos = $this->productos->where('activo', 1)->findAll();
        $data = ['titulo' => 'Venta', 'productos' => $productos];
        echo view('ventas/caja', $data);
    }
    public function guarda()
    {
        $id_venta = $this->request->getPost('id_venta');
        $forma_pago = $this->request->getPost('forma_pago');
        $id_cliente = $this->request->getPost('id_cliente');
        $total = preg_replace('/[\$,]/', '', $this->request->getPost('total'));

       
        $caja=$this->cajas->where('id', $this->session->id_caja)->first();
        $folio = $caja['folio'];
     

        $resultadoId = $this->ventas->insertaVenta($folio, $total, $this->session->id_usuario, $this->session->id_caja, $id_cliente, $forma_pago);
        $this->temporal_compra = new TemporalCompraModel();

        if ($resultadoId) {
            $folio++;
            $this->cajas->update($this->session->id_caja, ['folio' =>  $folio]);

            $resultadoCompra = $this->temporal_compra->porCompra($id_venta);
            foreach ($resultadoCompra as $row) {

                $this->detalle_venta->save([
                    'id_venta' => $resultadoId,
                    'id_producto' => $row['id_producto'],
                    'nombre' => $row['nombre'],
                    'cantidad' => $row['cantidad'],
                    'precio' => $row['precio'],
                ]);
                $this->productos = new ProductosModel();
                $this->productos->actualizaStock($row['id_producto'], $row['cantidad'], '-');
            }
            $this->temporal_compra->eliminarCompra($id_venta); // Eliminamos la compra
        }
        return redirect()->to(base_url() . "ventas/muestraTicket/" . $resultadoId);
    }
    public function muestraTicket($id_venta)
    {
        $data['id_venta'] = $id_venta;
        return view('ventas/ver_ticket', $data);
    }
    public function generaTicket($id_venta)
    {
        // Obtener datos de la venta con join a la tabla clientes
        $datosVenta = $this->ventas->select('ventas.*, clientes.nombre as nombre_cliente, clientes.identificacion,clientes.telefono, clientes.direccion')
            ->join('clientes', 'ventas.id_cliente = clientes.id')
            ->where('ventas.id', $id_venta)
            ->first();

        // Obtener detalle de venta con join a la tabla productos para obtener nombre_corto
        $detalleVenta = $this->detalle_venta
            ->select('detalle_venta.*, productos.nombre_corto')
            ->join('productos', 'detalle_venta.id_producto = productos.id')
            ->where('detalle_venta.id_venta', $id_venta)
            ->findAll();

        $nombreTienda =  $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        $direccionTienda =  $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;
        $mensajeTicket =  $this->configuracion->select('valor')->where('nombre', 'factura_mensaje')->get()->getRow()->valor;

        $pdf = new \FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetTitle("Venta");
        $pdf->SetFont('Arial', 'B', '9');
        $pdf->Cell(60, 5, $nombreTienda, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', '9');
        $pdf->image(base_url() . '/images/logotipo.png', 5, 0, 20, 20, 'PNG');
        $pdf->SetFont('Arial', '', '9');
        $pdf->Cell(70, 5, utf8_decode('Nota de Venta'), 0, 1, 'C');

        // Datos del cliente
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(20, 5, utf8_decode('Cliente: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', '9');
        $pdf->Cell(20, 5, $datosVenta['nombre_cliente'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(20, 5, utf8_decode('Cedula/Ruc: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', '9');
        $pdf->Cell(50, 5, $datosVenta['identificacion'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(20, 5, utf8_decode('Telefono: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', '9');
        $pdf->Cell(50, 5, $datosVenta['telefono'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', '9');
        $pdf->Cell(50, 5, $datosVenta['direccion'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', '9');
        $pdf->Cell(25, 5, utf8_decode('Fecha y hora: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', '9');
        $pdf->Cell(50, 5, $datosVenta['fecha_alta'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', '9');
        $pdf->Cell(15, 5, utf8_decode('Ticket:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', '9');
        $pdf->Cell(50, 5, $datosVenta['folio'], 0, 1, 'L');

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', '7');
        $pdf->Cell(7, 5, 'Cant.', 0, 0, 'L');
        $pdf->Cell(35, 5, 'Nombre', 0, 0, 'L');
        $pdf->Cell(15, 5, 'Precio', 0, 0, 'L');
        $pdf->Cell(15, 5, 'Importe', 0, 1, 'L');
        $pdf->SetFont('Arial', '', '7');

        foreach ($detalleVenta as $row) {
            $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
            // Usar el nombre_corto obtenido del join con productos
            $pdf->Cell(35, 5, $row['nombre_corto'], 0, 0, 'L');
            $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
            $importe = number_format($row['precio'] * $row['cantidad'], 2, '.', ',');
            $pdf->Cell(15, 5, '$' . $importe, 0, 1, 'R');
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', '8');
        $pdf->Cell(70, 5, 'Total $ ' . number_format($datosVenta['total'], 2, '.', ','), 0, 1, 'R');

        $pdf->Ln();
        $pdf->MultiCell(70, 4, $mensajeTicket, 0, 'C', 0);

        $this->response->setheader('Content-Type', 'application/pdf');
        $pdf->Output("ticket.pdf", 'I');
    }
    public function eliminar($id)
    {
        $productos = $this->detalle_venta->where('id_venta', $id)->findAll();
        foreach ($productos as $producto) {
            $this->productos->actualizaStock($producto['id_producto'], $producto['cantidad'], '+');
        }
        $this->ventas->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . 'ventas');
    }
}
