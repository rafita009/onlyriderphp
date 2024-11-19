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
                    <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo; ?></h1>

                    <?php if (isset($validation)) { ?>
                        <div class="alert alert-danger">
                            <?php echo $validation->listErrors(); ?>
                        </div>
                    <?php } ?>
                    <form method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>configuracion/actualizar" autocomplete="off">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Nombre de la tienda</label>
                                    <input class="form-control" id="tienda_nombre" name="tienda_nombre" type="text"
                                        value="<?php echo $nombre['valor'] ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>tienda Ruc</label>
                                    <input class="form-control" id="tienda_ruc" name="tienda_ruc" type="text" value="<?php echo $ruc['valor'] ?>" required />
                                </div>

                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Telefono de la tienda</label>
                                    <input class="form-control" id="tienda_telefono" name="tienda_telefono" type="text" value="<?php echo $telefono['valor'] ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Correo de la tienda</label>
                                    <input class="form-control" id="tienda_email" name="tienda_email" type="text" value="<?php echo $correo['valor'] ?>" required />
                                </div>

                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Direccion de la tienda</label>
                                    <textarea class="form-control" name="tienda_direccion" id="tienda_direccion" required><?php echo $direccion['valor'] ?></textarea>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Mensaje de la Factura</label>
                                    <textarea class="form-control" name="factura_mensaje" id="factura_mensaje" required><?php echo $mensaje['valor'] ?></textarea>
                                </div>

                            </div>
                           
                        </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label>Logotipo</label>
                                        <br>
                                        <img src="<?php echo base_url().'images/logotipo.png'?>"  class="img-responsive" width="" />
                                        <input type="file" id="tienda_logo" name="tienda_logo" accept="image/png" />
                                    </div>
                                </div>
                               <p class="text-danger">Cargar imagen en formato PNG de 150x150 pixeles</p> 
                            </div>
                        <a href="<?php echo base_url(); ?>dashboard" class="btn btn-primary">Regresar</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>


                    <!-- DataTales Example -->

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
    <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Desea Eliminar el Registro?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-light" type="button" data-dismiss="modal">No</button>

                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div>
        </div>
    </div>
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
        $('#modal-confirma').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
</body>

</html>