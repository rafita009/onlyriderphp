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
    <link href="<?php echo base_url();?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url();?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url();?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                    <form method="post" action="<?php echo base_url(); ?>clientes/actualizar" autocomplete="off">
                        <input type="hidden" id="id" name="id" value="<?php echo $clientes['id']; ?>" />
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Nombre</label>
                                    <input class="form-control" id="nombre" maxlength="25" name="nombre" type="text" value="<?php echo $clientes['nombre']; ?>"
                                        autofocus required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Direccion</label>
                                    <input class="form-control" maxlength="25" id="direccion" name="direccion" type="text" value="<?php echo $clientes['direccion']; ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Telefono</label>
                                    <input class="form-control" maxlength="20" id="telefono" name="telefono" type="text" value="<?php echo $clientes['telefono']; ?>" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Correo</label>
                                    <input class="form-control" maxlength="25" id="correo" name="correo" type="text" value="<?php echo $clientes['correo']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Cedula/Ruc</label>
                                    <input class="form-control" maxlength="18" id="identificacion" name="identificacion" type="text" value="<?php echo $clientes['identificacion']; ?>" />
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url(); ?>clientes" class="btn btn-primary">Regresar</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
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
    <script src="<?php echo base_url();?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url();?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url();?>/assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url();?>/assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url();?>/assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url();?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url();?>/assets/js/demo/datatables-demo.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

</body>

</html>