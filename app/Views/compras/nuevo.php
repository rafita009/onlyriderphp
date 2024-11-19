<?php
$id_compra = uniqid();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OnlyRiderPHP</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <!-- Agregar esto en el header de tu vista, antes de tus scripts -->
    <script>
        const BASE_URL = '<?= base_url() ?>/';
    </script>


</head>

<body id="page-top">
    <!-- Modal -->
    <div class="modal fade" id="alertaModal" tabindex="-1" role="dialog" aria-labelledby="alertaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document"> <!-- modal-sm para un modal pequeño -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertaModalLabel">Advertencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Debes agregar al menos un producto para completar la compra.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php echo view('admin/_partials/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <?php echo view('admin/_partials/navbar'); ?>
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <form method="POST" id="form_compra" name="form_compra" action="<?php echo base_url(); ?>compras/guarda" autocomplete="off">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <input type="hidden" id="id_producto" name="id_producto" />
                                    <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra; ?>" />
                                    <label>Codigo</label>
                                    <input class="form-control" id="codigo" name="codigo" type="text" autofocus placeholder="Escribe el codigo y enter" onkeyup="buscarProducto(event, this, this.value)" autofocus />
                                    <label for="codigo" id="resultado_error" style="color:red"></label>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Nombre del Producto</label>
                                    <select class="form-control" id="nombre" name="nombre" type="text" onchange="buscarProductoPorSelect()">
                                        <option value="">Seleccionar producto</option>
                                        <?php foreach ($productos as $producto) { ?>
                                            <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-1">
                                    <label>Cantidad</label>
                                    <input class="form-control" id="cantidad" name="cantidad" type="text" oninput="calcularSubtotal()" required />
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Proveedor</label>
                                    <select class="form-control" id="proveedor" name="proveedor" required />
                                    <option value="">Seleccionar proveedor</option>
                                    <?php foreach ($proveedores as $proveedor) { ?>
                                        <option value="<?php echo $proveedor['id']; ?>"><?php echo $proveedor['nombre']; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label>Precio de compra</label>
                                    <input class="form-control" id="precio_compra" name="precio_compra" type="text" disabled />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Subtotal</label>
                                    <input class="form-control" id="subtotal" name="subtotal" type="text" disabled />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label><br>&nbsp;</label>
                                    <button id="agregar_producto" name="agregar_producto" type="button" class="btn btn-primary" onclick="agregarProducto(id_producto.value,cantidad.value,'<?php echo $id_compra; ?>')">Agregar Producto</button>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive tablaProductos" width="100%">
                                <thead class="thead-dark">
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th width="1%"></th>

                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 offset-md-6">
                                <label style="font-weight: bold; font-size: 30px; text-align: center;">Total $</label>
                                <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;">
                                <button type="button" id="completa_compra" class="btn btn-success">Completar Compra</button>

                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php echo view('admin/_partials/footer'); ?>

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


   
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url(); ?>/assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url(); ?>/assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url(); ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url(); ?>/assets/js/demo/datatables-demo.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        console.log('Versión de jQuery:', jQuery.fn.jquery);
    </script>
    <script>
        $(document).ready(function() {
            $("#completa_compra").click(function() {
                let nFila = $("#tablaProductos tr").length;
                if (nFila < 2) {
                    $('#alertaModal').modal('show');

                } else {
                    $("#form_compra").submit();
                }
            });
        });

        function buscarProducto(e, tagCodigo, codigo) {
            const enterKey = 13;
            if (codigo !== '') {
                if (e.which === enterKey) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>productos/buscarPorCodigo/' + codigo,
                        dataType: "json",
                        success: function(resultado) {
                            if (resultado == 0) {
                                $(tagCodigo).val(''); // Asegurarse de que el paréntesis esté fuera de tagCodigo
                            } else {
                                $(tagCodigo).removeClass('has-error');
                                $("#resultado_error").html(resultado.error);

                                if (resultado.existe) {
                                    $("#id_producto").val(resultado.datos.id);
                                    $("#nombre").val(resultado.datos.id).trigger('change');
                                    $("#cantidad").val(1);
                                    $("#precio_compra").val(resultado.datos.precio_compra);
                                    $("#subtotal").val(resultado.datos.precio_compra);
                                    $("#cantidad").focus();
                                } else {
                                    // Limpiar los campos si el producto no existe
                                    $("#id_producto").val('');
                                    $("#nombre").val('');
                                    $("#cantidad").val('');
                                    $("#precio_compra").val('');
                                    $("#subtotal").val('');
                                    $("#cantidad").focus();
                                }
                            }
                        },
                        error: function() {
                            // Manejo de errores en caso de que la solicitud AJAX falle
                            console.error("Error al buscar el producto.");
                        }
                    });
                }
            }
        }

        function agregarProducto(id_producto, cantidad, id_compra) {
            if (id_producto != null && id_producto != 0 && cantidad > 0) {
                $.ajax({
                    url: '<?php echo base_url(); ?>temporalcompra/insertar/' + id_producto + '/' + cantidad + '/' + id_compra,
                    success: function(resultado) {
                        if (resultado == 0) {

                        } else {
                            var resultado = JSON.parse(resultado);

                            if (resultado.error == '') {
                                $("#tablaProductos tbody").empty();
                                $("#tablaProductos tbody").append(resultado.datos);
                                $("#total").val(resultado.total);
                                $("#id_producto").val('');
                                $("#codigo").val('');
                                $("#nombre").val('');
                                $("#cantidad").val('');
                                $("#precio_compra").val('');
                                $("#subtotal").val('');
                                $("#cantidad").focus();

                            }
                        }
                    },
                    error: function() {
                        // Manejo de errores en caso de que la solicitud AJAX falle
                        console.error("Error al buscar el producto.");
                    }
                });
            }
        }
        // Función para buscar por select (dropdown)
        function buscarProductoPorSelect() {
            const productoId = $("#nombre").val();

            if (productoId !== '') {
                $.ajax({
                    url: '<?php echo base_url(); ?>productos/buscarPorId/' + productoId,
                    dataType: "json",
                    success: function(resultado) {
                        if (resultado == 0) {
                            limpiarCampos();
                        } else {
                            $("#resultado_error").html(resultado.error);

                            if (resultado.existe) {
                                $("#id_producto").val(resultado.datos.id);
                                if (resultado.datos.codigo) {
                                    $("#codigo").val(resultado.datos.codigo);
                                }
                                $("#cantidad").val(1);
                                $("#precio_compra").val(resultado.datos.precio_compra);
                                $("#subtotal").val(resultado.datos.precio_compra);
                                $("#cantidad").focus();
                            } else {
                                limpiarCampos();
                            }
                        }
                    },
                    error: function() {
                        console.error("Error al buscar el producto por selección.");
                    }
                });
            } else {
                limpiarCampos();
            }
        }

        function eliminarProducto(id_producto, id_compra) {
            // Prevenir múltiples clics
            const btnEliminar = $(`[data-eliminar="${id_producto}"]`);
            if (btnEliminar.data('procesando')) {
                return;
            }
            btnEliminar.data('procesando', true);

            $.ajax({
                    url: `${BASE_URL}temporalcompra/eliminar/${id_producto}/${id_compra}`,
                    method: 'POST',
                    dataType: 'json'
                })
                .done(function(response) {
                    if (response.status === 'error') {
                        alert(response.message);
                        return;
                    }

                    // Si solo se actualizó la cantidad
                    if (response.accion === 'actualizado') {
                        const cantidadElement = $(`#cantidad_${id_producto}`);
                        cantidadElement.text(response.nueva_cantidad);
                        cantidadElement.addClass('cantidad-actualizada');
                        setTimeout(() => cantidadElement.removeClass('cantidad-actualizada'), 1000);
                    }

                    // Si se eliminó el producto
                    if (response.accion === 'eliminado') {
                        $(`#fila_${id_producto}`).fadeOut(400, function() {
                            $(this).remove();
                        });
                    }

                    // Actualizar el total
                    $("#total").val(response.total);

                    // Actualizar tabla si es necesario
                    if (response.datos) {
                        $("#tablaProductos tbody").html(response.datos);
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la petición:', textStatus, errorThrown);
                    alert('Error al procesar la solicitud');
                })
                .always(function() {
                    btnEliminar.data('procesando', false);
                });
        }
        function adicionarProducto(id_producto, id_venta) {
            // Prevenir múltiples clics
            const btnAgregar = document.querySelector(`button[data-agregar='${id_producto}']`);
            if ($(btnAgregar).data('procesando')) {
                return;
            }
            $(btnAgregar).data('procesando', true);

            $.ajax({
                    url: `${BASE_URL}temporalcompra/adicionar/${id_producto}/${id_venta}`,
                    method: 'POST',
                    dataType: 'json'
                })
                .done(function(response) {
                    if (response.status === 'error') {
                        alert(response.message);
                        return;
                    }

                    // Si solo se actualizó la cantidad
                    if (response.accion === 'actualizado') {
                        const cantidadElement = $(`#cantidad_${id_producto}`);
                        cantidadElement.text(response.nueva_cantidad);
                        cantidadElement.addClass('cantidad-actualizada');
                        setTimeout(() => cantidadElement.removeClass('cantidad-actualizada'), 1000);
                    }

                    // Si se eliminó el producto
                    if (response.accion === 'eliminado') {
                        $(`#fila_${id_producto}`).fadeOut(400, function() {
                            $(this).remove();
                        });
                    }

                    // Actualizar el total
                    $("#total").val(response.total);

                    // Actualizar tabla si es necesario
                    if (response.datos) {
                        $("#tablaProductos tbody").html(response.datos);
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la petición:', textStatus, errorThrown);
                    alert('Error al procesar la solicitud');
                })
                .always(function() {
                    $(btnAgregar).data('procesando', false);
                });
        }
        function calcularSubtotal() {
            // Obtener los valores de cantidad y precio de compra
            var cantidad = parseFloat(document.getElementById("cantidad").value) || 0;
            var precioCompra = parseFloat(document.getElementById("precio_compra").value) || 0;

            // Calcular el subtotal
            var subtotal = cantidad * precioCompra;

            // Actualizar el campo de subtotal con el valor calculado
            document.getElementById("subtotal").value = subtotal.toFixed(2);
        }
    </script>

</body>

</html>