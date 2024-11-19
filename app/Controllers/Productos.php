<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;
use App\Models\ProductosModel;
use App\Models\UnidadesModel;
use App\Models\DetalleRolesPermisosModel;


class Productos extends BaseController
{
    protected $productos, $detalleRoles, $session;
    protected $unidades;
    protected $categorias;
    protected $reglas;

    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->unidades = new UnidadesModel();
        $this->categorias = new CategoriasModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->session =  Session();


        helper(['form']);

        $this->reglas = [
            'codigo' => [
                'rules' => 'required|is_unique[productos.codigo]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} debe ser unico.',
                ]
            ],
            'nombre' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    public function index($activo = 1)
    {
       $permiso= $this->detalleRoles->verificaPermisos($this->session->id_rol, 'ProductosCatalogo');
       if(!$permiso){
        echo 'No tiene permiso para acceder a esta página';
        exit;
       }

        // Obtener productos con sus categorías
        $productos = $this->productos->getProductosConCategoria($activo);
        $data = ['titulo' => 'Productos', 'datos' => $productos];

        echo view('productos/productos', $data);
    }
    public function eliminados($activo = 0)
    {
        $productos = $this->productos->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Productos eliminados', 'datos' => $productos];

        echo view('productos/eliminados', $data);
    }
    public function nuevo()
    {
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $unidades = $this->unidades->where('activo', 1)->findAll();

        $data = ['titulo' => 'Agregar Productos', 'categorias' => $categorias, 'unidades' => $unidades];
        echo view('productos/nuevo', $data);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {
            $this->productos->save([
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('id_unidad'),
                'id_categoria' => $this->request->getPost('id_categoria')
            ]);

            $id = $this->productos->insertId();

            if ($imageFile = $this->request->getFiles()) {
                $contador = 1;
                foreach ($imageFile['img_producto'] as $img) {
                    $ruta = "images/productos/" . $id;
                    if (!file_exists($ruta)) {
                        mkdir($ruta, 0777, true);
                    }
                    if ($img->isValid() && !$img->hasMoved()) {
                        $img->move('./images/productos/', $id . '/foto_' . $contador . '.jpg');

                        $contador++;
                    }
                }
            }


            // $validacion = $this->validate([
            //     'img_producto' => [
            //         'uploaded[img_producto]',
            //         'mime_in[img_producto,image/jpg,image/jpeg]',
            //         'max_size[img_producto,4096]'
            //     ]
            //  ]  );
            //  if($validacion){
            //     $ruta_logo = "images/productos/".$id.".jpg";
            //     if(file_exists($ruta_logo)){
            //         unlink($ruta_logo);
            //     }
            //     $img= $this->request->getfile('img_producto');
            //     $img -> move('./images/productos', $id.'.jpg');

            //  }else{
            //     echo 'Error en la validacion';
            //     exit;
            //  }

            return redirect()->to(base_url() . 'productos');
        } else {
            $categorias = $this->categorias->where('activo', 1)->findAll();
            $unidades = $this->unidades->where('activo', 1)->findAll();

            $data = ['titulo' => 'Agregar Productos', 'categorias' => $categorias, 'unidades' => $unidades, 'validation' => $this->validator];

            echo view('productos/nuevo', $data);
        }
    }
    public function editar($id)
    {
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $unidades = $this->unidades->where('activo', 1)->findAll();
        $productos = $this->productos->where('id', $id)->first();
        $data = ['titulo' => 'Editar Productos', 'categorias' => $categorias, 'unidades' => $unidades, 'productos' => $productos];



        echo view('productos/editar', $data);
    }
    public function actualizar()
    {


        $this->productos->update($this->request->getPost('id'), [
            'codigo' => $this->request->getPost('codigo'),
            'precio_venta' => $this->request->getPost('precio_venta'),
            'nombre_corto' => $this->request->getPost('nombre_corto'),
            'precio_compra' => $this->request->getPost('precio_compra'),
            'stock_minimo' => $this->request->getPost('stock_minimo'),
            'inventariable' => $this->request->getPost('inventariable'),
            'id_unidad' => $this->request->getPost('id_unidad'),
            'existencias' => $this->request->getPost('existencias'),
            'id_categoria' => $this->request->getPost('id_categoria')
        ]);

        $id = $this->productos->insertId();

        if ($imageFile = $this->request->getFiles()) {
            $contador = 1;
            foreach ($imageFile['img_producto'] as $img) {
                $ruta = "images/productos/" . $id;
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                if ($img->isValid() && !$img->hasMoved()) {
                    $img->move('./images/productos/', $id . '/foto_' . $contador . '.jpg');

                    $contador++;
                }
            }
        }

        return redirect()->to(base_url() . 'productos');
    }
    public function eliminar($id)
    {
        $this->productos->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . 'productos');
    }
    public function reingresar($id)
    {
        $this->productos->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . 'productos');
    }
    public function buscarPorCodigo($codigo)
    {
        $this->productos->select('*');
        $this->productos->where('codigo', $codigo);
        $this->productos->where('activo', 1);
        $datos = $this->productos->get()->getRow();

        $res['existe'] = false;
        $res['datos'] = '';
        $res['error'] = '';

        if ($datos) {
            $res['datos'] = $datos;
            $res['existe'] = true;
        } else {
            $res['error'] = 'No existe el Producto';
            $res['existe'] = false;
        }
        echo json_encode($res);
    }
    public function buscarPorId($id)
    {
        $this->productos->select('*');
        $this->productos->where('id', $id);
        $this->productos->where('activo', 1);
        $datos = $this->productos->get()->getRow();

        $res['existe'] = false;
        $res['datos'] = '';
        $res['error'] = '';

        if ($datos) {
            $res['datos'] = $datos;
            $res['existe'] = true;
        } else {
            $res['error'] = 'No existe el Producto';
            $res['existe'] = false;
        }
        echo json_encode($res);
    }
    public function autocompleteData()
    {
        $returnData = array();
        $valor = $this->request->getGet('term');

        $productos = $this->productos
            ->groupStart()
            ->like('codigo', $valor)
            ->orLike('nombre', $valor)
            ->groupEnd()
            ->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->limit(50)  // Aumentamos el límite de resultados
            ->findAll();

        if (!empty($productos)) {
            foreach ($productos as $row) {
                $data['id'] = $row['id'];
                $data['value'] = $row['codigo'] . ' - ' . $row['nombre'];
                $data['codigo'] = $row['codigo'];
                $data['nombre'] = $row['nombre'];
                array_push($returnData, $data);
            }
        }

        echo json_encode($returnData);
    }
    public function generaBarras()
    {
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Codigos de barras");


        $productos = $this->productos->where('activo', 1)->findAll();
        foreach ($productos as $producto) {
            $codigo = $producto['codigo'];

            $generaBarcode = new \barcode_genera();
            $generaBarcode->barcode("images/barcode/" . $codigo . ".png", $codigo, 20, "horizontal", "code39", true);

            $pdf->Image("images/barcode/" . $codigo . ".png");
            // unlink("images/barcode/".$codigo ."png"); asi se borra las imagenes
        }
        $this->response->setHeader('Content-type', 'application/pdf');
        $pdf->Output('Codigo.pdf', 'I');
    }
    public function muestraCodigos()
    {
        return view('productos/ver_codigos');
    }
    public function generaMinimosPdf()
    {
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Productos con stock minimo");
        $pdf->SetFont("Arial", "B", 10);

        $pdf->Image("images/logotipo.png", 10, 5, 20);

        $pdf->Cell(0, 5, utf8_decode("Reporte de producto con stock mínimo"), 0, 1, 'C');
        $pdf->Ln(10);


        $pdf->Cell(40, 5, utf8_decode("Codigo"), 1, 0, "C");
        $pdf->Cell(85, 5, utf8_decode("Nombre"), 1, 0, "C");
        $pdf->Cell(30, 5, utf8_decode("Existencias"), 1, 0, "C");
        $pdf->Cell(30, 5, utf8_decode("Stock mínimo"), 1, 1, "C");

        $datosProductos =$this->productos->getProductosMinimo();
        foreach ($datosProductos as $producto){
            $pdf->Cell(40, 5, $producto['codigo'], 1, 0, "C");
            $pdf->Cell(85, 5, utf8_decode($producto['nombre']), 1, 0, "C");
            $pdf->Cell(30, 5, $producto['existencias'], 1, 0, "C");
            $pdf->Cell(30, 5,  $producto['stock_minimo'], 1, 1, "C");
    
        }


        $this->response->setHeader('Content-type', 'application/pdf');
        $pdf->Output('ProductoMinimo.pdf', 'I');
    }
    public function mostrarMinimos()
    {
        return view('productos/ver_minimos');
    }
}
