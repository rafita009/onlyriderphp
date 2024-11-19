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
                   <!-- Encabezado con breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-key fa-sm text-gray-600"></i> <?php echo $titulo; ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light py-2 px-3 mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('roles') ?>">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Asignar Permisos</li>
            </ol>
        </nav>
    </div>

    <!-- Mensajes de alerta -->
    <?php if(session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i>
            <?= session()->getFlashdata('mensaje') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-1"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Tarjeta principal -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-shield-alt mr-1"></i> Configuración de Permisos
            </h6>
            <a href="<?= base_url('roles') ?>" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('roles/guardaPermisos'); ?>">
                <input type="hidden" name="id_rol" value="<?php echo $id_rol; ?>" />
                
                <!-- Grid de permisos -->
                <div class="row">
                    <?php 
                    // Agrupar permisos por categorías (puedes adaptar esto según tus necesidades)
                    $categorias = [
                        'Usuarios' => ['crear_usuario', 'editar_usuario', 'eliminar_usuario'],
                        'Productos' => ['crear_producto', 'editar_producto', 'eliminar_producto'],
                        'Reportes' => ['ver_reportes', 'exportar_reportes'],
                        // Añade más categorías según necesites
                    ];
                    
                    foreach ($permisos as $permiso): ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" 
                                       class="custom-control-input" 
                                       id="permiso_<?php echo $permiso['id']; ?>"
                                       name="permisos[]"
                                       value="<?php echo $permiso['id']; ?>"
                                       <?php echo (in_array($permiso['id'], $permisosAsignados)) ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="permiso_<?php echo $permiso['id']; ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $permiso['nombre'])); ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <hr>

                <!-- Botones de acción -->
                <div class="row">
                    <div class="col-12">
                        <div class="float-right">
                            <button type="reset" class="btn btn-secondary">
                                <i class="fas fa-undo mr-1"></i> Restablecer
                            </button>
                            <button type="submit" class="btn btn-primary ml-2">
                                <i class="fas fa-save mr-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Card con información adicional -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-info-circle mr-1"></i> Información Importante
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="small font-weight-bold">Gestión de Permisos </h5>
                    <p class="text-muted small">
                        Los permisos asignados determinarán qué acciones puede realizar el usuario con este rol.
                        Asegúrese de revisar cuidadosamente los permisos otorgados.
                    </p>
                </div>
                <div class="col-md-6">
                    <h5 class="small font-weight-bold">Seguridad </h5>
                    <p class="text-muted small">
                        Por seguridad, se recomienda seguir el principio de mínimo privilegio:
                        asignar solo los permisos estrictamente necesarios para cada rol.
                    </p>
                </div>
            </div>
        </div>
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
document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
    e.preventDefault();
    if (confirm('¿Está seguro de que desea restablecer todos los cambios?')) {
        this.form.reset();
    }
});
</script>
    <script>
        $('#modal-confirma').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
</body>

</html>