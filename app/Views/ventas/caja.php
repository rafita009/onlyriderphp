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
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">




    <!-- Custom styles for this page -->
    <link href="<?php echo base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script>
        const BASE_URL = '<?= base_url() ?>/';
    </script>
    <style>
        .ui-autocomplete {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 9999 !important;
        }

        .ui-menu-item {
            padding: 5px !important;
            border-bottom: 1px solid #f0f0f0;
        }

        .ui-menu-item:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .ui-menu-item-wrapper {
            padding: 5px !important;
        }
    </style>

</head>

<body id="page-top">
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
                    <?php $idVentaTmp = uniqid(); ?>
                    <br>
                    <form id="form_venta" name="form_venta" class="form_horizontal" method="POST" action="<?php echo base_url(); ?>ventas/guarda" autocomplete="off">

                        <input type="hidden" id="id_venta" name="id_venta" value="<?php echo $idVentaTmp ?>" />

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="ui-widget">
                                        <label>Cliente</label>
                                        <input type="hidden" id="id_cliente" name="id_cliente" value="1" />
                                        <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Escribe el nombre del cliente"
                                            value="Consumidor final" onkeyup="" autocomplete="off" required />
                                    </div>

                                </div>
                                <div class="col-sm-1">
                                    <br>
                                    <!-- Botón sin texto, solo ícono, que redirige a la página de agregar cliente -->
                                    <a href=" <?php echo base_url('clientes/nuevo') ?>" class="btn btn-primary">
                                        <i class="fas fa-user-plus"></i> <!-- Ícono de agregar cliente -->
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <label>Forma de Pago</label>
                                    <select name="forma_pago" id="forma_pago" class="form-control" required>
                                        <option value="001">Efectivo</option>
                                        <option value="002">Tarjeta de Credito o Debito</option>
                                        <option value="003">Transferencia</option>
                                    </select> 
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <input type="hidden" id="id_producto" name="id_producto" />
                                    <label>Código o Nombre del Producto</label>
                                    <input class="form-control"
                                        id="codigo"
                                        name="codigo"
                                        type="text"
                                        placeholder="Escribe el código o nombre del producto"
                                        onkeyup="agregarProducto(event, this.value, 1, <?php echo $idVentaTmp; ?>)"
                                        autofocus />
                                    <div class="col-sm-2">
                                        <label for="codigo" id="resultado_error" style="color:red"></label>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label style="font-weight: bold; font-size: 30px; text-align: center;">Total $</label>
                                    <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" id="completa_venta" class="btn btn-success">Completar Venta</button>

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
    <script src="<?php echo base_url(); ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        $(function() {
            $("#cliente").autocomplete({
                source: "<?php echo base_url(); ?>clientes/autocompleteData",
                minLength: 2,
                select: function(event, ui) {
                    event.preventDefault();
                    $("#id_cliente").val(ui.item.id);
                    $("#cliente").val(ui.item.value);
                }
            });
        });
        $(function() {
            $("#codigo").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>productos/autocompleteData",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            // Limitamos a mostrar máximo 10 resultados por página
                            response(data.slice(0, 10));
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    event.preventDefault();
                    $("#codigo").val(ui.item.codigo);
                    $("#id_producto").val(ui.item.id);

                    setTimeout(function() {
                        e = jQuery.Event("keypress");
                        e.which = 13;
                        agregarProducto(e, ui.item.id, 1, '<?php echo $idVentaTmp; ?>');
                    });
                }
            }).data("ui-autocomplete")._renderItem = function(ul, item) {
                // Personalizamos cómo se muestra cada ítem en la lista
                return $("<li>")
                    .addClass("ui-menu-item")
                    .append("<div class='ui-menu-item-wrapper'>" + item.value + "</div>")
                    .appendTo(ul);
            };

            // Modificar el estilo del menú de autocompletado
            $(".ui-autocomplete").css({
                "max-height": "300px", // Altura máxima del menú desplegable
                "overflow-y": "auto", // Hacer el menú scrolleable
                "overflow-x": "hidden" // Ocultar scroll horizontal
            });
        });


        function agregarProducto(s, id_producto, cantidad, id_venta) {
            let enterKey = 13;
            if (codigo != '') {
                if (e.which = enterKey) {
                    if (id_producto != null && id_producto != 0 && cantidad > 0) {
                        $.ajax({
                            url: '<?php echo base_url(); ?>temporalcompra/insertar/' + id_producto + '/' + cantidad + '/' + id_venta,
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
            }
        }

        function eliminarProducto(id_producto, id_venta) {
            // Prevenir múltiples clics
            const btnEliminar = $(`[data-eliminar="${id_producto}"]`);
            if (btnEliminar.data('procesando')) {
                return;
            }
            btnEliminar.data('procesando', true);

            $.ajax({
                    url: `${BASE_URL}temporalcompra/eliminar/${id_producto}/${id_venta}`,
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
        $(function() {
            $("#completa_venta").click(function() {
                let nFilas = $("#tablaProductos tr").length;
                if (nFilas < 2) {
                    alert("Debe agregar un producto")
                } else {
                    $("#form_venta").submit();

                }
            });
        });
    </script>
</body>

</html>