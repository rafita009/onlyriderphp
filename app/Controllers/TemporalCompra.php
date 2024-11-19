<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TemporalCompraModel;
use App\Models\ProductosModel;
use Exception;

class TemporalCompra extends BaseController
{
    protected $temporal_compra, $productos;
    protected $reglas;

    public function __construct()
    {
        $this->temporal_compra = new TemporalCompraModel();
        $this->productos = new ProductosModel();
    }


    public function insertar($id_producto, $cantidad, $id_compra)
    {
        $error = '';
        $producto = $this->productos->where('id', $id_producto)->first();

        if ($producto) {
            $datosExiste = $this->temporal_compra->porIdProductoCompra($id_producto, $id_compra);
            if ($datosExiste) {

                $cantidad = $datosExiste->cantidad + $cantidad;
                $subtotal = $cantidad * $datosExiste->precio;

                $this->temporal_compra->actualizarProductoCompra($id_producto, $id_compra, $cantidad, $subtotal);
            } else {
                $subtotal = $cantidad * $producto['precio_compra'];

                $this->temporal_compra->save([
                    'folio' => $id_compra,
                    'id_producto' => $id_producto,
                    'codigo' => $producto['codigo'],
                    'nombre' => $producto['nombre'],
                    'cantidad' => $cantidad,
                    'precio' => $producto['precio_compra'],
                    'subtotal' => $subtotal
                ]);
            }
        } else {
            $error = 'No existe el producto';
        }
        $res['datos'] = $this->cargaProductos($id_compra);
        $res['total'] = number_format($this->totalProductos($id_compra), 2, '.', ',');
        $res['error'] = $error;
        echo json_encode($res);
    }
    public function cargaProductos($id_compra)
    {
        $resultado = $this->temporal_compra->porCompra($id_compra);
        $fila = '';
        $numfila = 0;
    
        foreach ($resultado as $row) {
            $numfila++;
            // Usar el ID del producto para identificar la fila
            $fila .= "<tr id='fila_" . $row['id_producto'] . "' class='producto-row'>";
            $fila .= "<td class='text-center'>" . $numfila . "</td>";
            $fila .= "<td>" . $row['codigo'] . "</td>";
            $fila .= "<td>" . $row['nombre'] . "</td>";
            $fila .= "<td class='text-right'>" . number_format($row['precio'], 2, '.', ',') . "</td>";
            // Agregar ID específico para la cantidad
            $fila .= "<td class='text-center'>
            <span id='cantidad_" . $row['id_producto'] . "' class='cantidad-producto'>" . 
            $row['cantidad'] . "</span>
            <button type='button' 
                    class='btn btn-outline-primary btn-sm ms-2' 
                    data-agregar='" . $row['id_producto'] . "'
                    onclick=\"adicionarProducto('" . $row['id_producto'] . "','" . $id_compra . "')\">
                <i class='fas fa-plus'></i>
            </button>
          </td>";
            $fila .= "<td class='text-right'>" . number_format($row['subtotal'], 2, '.', ',') . "</td>";
            $fila .= "<td class='text-center'>
                        <button type='button' 
                                class='btn btn-danger btn-sm delete-product' 
                                data-producto='" . $row['id_producto'] . "' 
                                data-compra='" . $id_compra . "' 
                                onclick=\"eliminarProducto('" . $row['id_producto'] . "','" . $id_compra . "')\">
                            <i class='fas fa-trash'></i>
                        </button>
                      </td>";
            $fila .= "</tr>";
        }
        
        // Si no hay productos, mostrar mensaje
        if ($numfila === 0) {
            $fila = "<tr><td colspan='7' class='text-center'>No hay productos agregados</td></tr>";
        }
        
        return $fila;
    }
    public function totalProductos($id_compra)
    {
        $resultado = $this->temporal_compra->porCompra($id_compra);
        $total = 0;

        foreach ($resultado as $row) {
            $total += $row['subtotal'];
        }
        return  $total;
    }
    public function eliminar($id_producto, $id_compra) {
        header('Content-Type: application/json');
        
        try {
            if (!$id_producto || !$id_compra) {
                throw new Exception('IDs no válidos');
            }
    
            $datosExiste = $this->temporal_compra->porIdProductoCompra($id_producto, $id_compra);
            
            if (!$datosExiste) {
                throw new Exception('Producto no encontrado');
            }
    
            $response = [
                'status' => 'success',
                'producto_id' => $id_producto,
                'cantidad_anterior' => $datosExiste->cantidad
            ];
    
            if ($datosExiste->cantidad > 1) {
                $cantidad = $datosExiste->cantidad - 1;
                $subtotal = $cantidad * $datosExiste->precio;
                $this->temporal_compra->actualizarProductoCompra($id_producto, $id_compra, $cantidad, $subtotal);
                $response['accion'] = 'actualizado';
                $response['nueva_cantidad'] = $cantidad;
            } else {
                $this->temporal_compra->eliminarProductoCompra($id_producto, $id_compra);
                $response['accion'] = 'eliminado';
            }
    
            $response['datos'] = $this->cargaProductos($id_compra);
            $response['total'] = number_format($this->totalProductos($id_compra), 2, '.', ',');
            
            echo json_encode($response);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function adicionar($id_producto, $id_compra) {
        header('Content-Type: application/json');
        
        try {
            if (!$id_producto || !$id_compra) {
                throw new Exception('IDs no válidos');
            }
    
            $datosExiste = $this->temporal_compra->porIdProductoCompra($id_producto, $id_compra);
            
            if (!$datosExiste) {
                throw new Exception('Producto no encontrado');
            }
    
            $response = [
                'status' => 'success',
                'producto_id' => $id_producto,
                'cantidad_anterior' => $datosExiste->cantidad
            ];
    
                $cantidad = $datosExiste->cantidad + 1;
                $subtotal = $cantidad * $datosExiste->precio;
                $this->temporal_compra->actualizarProductoCompra($id_producto, $id_compra, $cantidad, $subtotal);
                $response['accion'] = 'actualizado';
                $response['nueva_cantidad'] = $cantidad;
           
    
            $response['datos'] = $this->cargaProductos($id_compra);
            $response['total'] = number_format($this->totalProductos($id_compra), 2, '.', ',');
            
            echo json_encode($response);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    
}
