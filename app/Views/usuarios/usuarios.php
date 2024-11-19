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

                    <div>
                        <p>
                            <a href="<?php echo base_url(''); ?>usuarios/nuevo" class="btn btn-info">Agregar</a>
                            <a href="<?php echo base_url(''); ?>usuarios/eliminados" class="btn btn-danger">Eliminados</a>

                        </p>
                    </div>

                    <!-- DataTales Example -->

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Caja</th>
                                    <th>Rol</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($datos as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['id']; ?></td>
                                        <td><?php echo $dato['usuario']; ?></td>
                                        <td><?php echo $dato['nombre']; ?></td>
                                        <td><?php echo $dato['caja_nombre']; ?></td>
                                        <td><?php echo $dato['rol_nombre']; ?></td>
                                        <td> <a href="<?php echo base_url('usuarios/editar/' . $dato['id']); ?>"class="btn 
                                        btn-success"><i class="fas fa-pencil-alt"></i>Editar</a></td>
                                        <td> <a href="#" data-href="<?php echo base_url('usuarios/eliminar/' . 
                                        $dato['id']); ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" title="Eliminar registro" class="btn 
                                        btn-danger"><i class="fas fa-trash"></i></a></td>

                                    </tr>

                                <?php }   ?>

                            </tbody>
                        </table>
                    </div>
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
    <script>
        $('#modal-confirma').on('show.bs.modal', function (e){
            $(this).find('.btn-ok').attr('href',$(e.relatedTarget).data('href'));
        });
    </script>
</body>

</html>