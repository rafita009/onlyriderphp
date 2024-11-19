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
               

                   
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Bienvenido <?= session()->get('nombre') ?>
                        </h1>
                        <a href="configuracion/respaldo/downloadFile.php"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generar Respaldo
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Posibles Clientes Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="<?php echo base_url();?>ventas">Ventas del Dia</a>
                                                </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo $totalVentas ['total'] ?>
                                                <!-- <//?php echo htmlspecialchars($result['administradores']); ?> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Clientes Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a class="text-success" href="<?php echo base_url();?>clientes">Clientes</a>
                                                </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalClientes ?>
                                                <!-- <//?php echo htmlspecialchars($result['clientes']); ?> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Clientes Potenciales Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <a class="text-info" href="<?php echo base_url();?>productos">Productos</a>
                                                </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo $totalProductos; ?>

                                                <!-- <//?php echo htmlspecialchars($result['productos']); ?> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Funcionalidades Adicionales Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a class="text-warning" href="<?php echo base_url();?>productos/mostrarMinimos">Productos con Stock minimo</a>
                                                </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 
                                                <?php echo $minimos; ?>
                                                <!-- Puedes agregar datos adicionales aquí -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mensaje en la página -->
                
                    <div class="row mt-4">
                        <div class="col mb-4">
                            <a href="#" id="leads-btn" class="btn btn-info btn-block btn-tabla"
                                data-url="model/all_clientes.php">
                                Leads
                            </a>
                        </div>
                        <!-- JavaScript para simular el clic -->
                        <script>
                            $(document).ready(function () {
                                // Simular el clic en el botón de Leads al cargar la página
                                $("#leads-btn").click();
                            });
                        </script>
                        <div class="col mb-4">
                            <a href="#" class="btn btn-primary btn-block btn-tabla"
                                data-url="model/clientes_potenciales.php">
                                Clientes Potenciales
                            </a>
                        </div>
                        <div class="col mb-4">
                            <a href="#" class="btn btn-success btn-block btn-tabla"
                                data-url="model/clientes_recurrentes.php">
                                Clientes Recurrentes
                            </a>
                        </div>

                        <div class="col mb-4">
                            <a href="clientes_fijos.php" class="btn btn-warning btn-block btn-tabla"
                                data-url="model/clientes_fijos.php">
                                Clientes Fijos
                            </a>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Possible Clients Module -->



                        <!-- Clients Module -->
                        <!-- Mostrar la tabla de Clientes -->
                        <!-- Clients Module -->
                        <div class="table-responsive">
                            <!-- Contenedor para las tablas de clientes -->
                            <div id="clientes-tabla-container" class="table-responsive mt-4">
                                <!-- Las tablas se cargarán aquí -->
                            </div>

                        </div>
                    </div>
                                


                    <!-- /.container-fluid -->

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
        $('#modal-confirma').on('show.bs.modal'),
            function(e) {
                $(this).find('btn-ok').attr('href', $(e.relatedTarget).data('href'));
            }
    </script>

</body>

</html>