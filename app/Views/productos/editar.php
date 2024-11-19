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
                    <?php \Config\Services::validation()->listErrors(); ?>
                    <form method="post" action="<?php echo base_url(); ?>productos/actualizar" enctype="multipart/form-data" autocomplete="off">
                        <?php csrf_field(); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo $productos['id']; ?>" />
                        <div class="form-group">
                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    <label>Nombre</label>
                                    <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $productos['nombre']; ?>"
                                        required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Codigo</label>
                                    <input class="form-control" id="codigo" name="codigo" type="text" value="<?php echo $productos['codigo']; ?>"
                                        autofocus required />
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label>Nombre corto</label>
                                    <input class="form-control" id="nombre_corto" name="nombre_corto" type="text" maxlength="20" value="<?php echo $productos['nombre_corto']; ?>"
                                        required />
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Unidad</label>
                                    <select class="form-control" id="id_unidad" name="id_unidad" required>
                                        <option value="">Seleccionar unidad</option>
                                        <?php foreach ($unidades as $unidad) { ?>
                                            <option value="<?php echo $unidad['id']; ?>" <?php if (
                                                                                                $unidad['id'] ==
                                                                                                $productos['id_unidad']
                                                                                            ) {
                                                                                                echo 'selected';
                                                                                            } ?>> <?php echo $unidad['nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Categoria</label>
                                    <select class="form-control" id="id_categoria" name="id_categoria" required>
                                        <option value="">Seleccionar categoria</option>
                                        <?php foreach ($categorias as $categoria) { ?>
                                            <option value="<?php echo $categoria['id']; ?>" <?php if (
                                                                                                $categoria['id'] ==
                                                                                                $productos['id_categoria']
                                                                                            ) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo $categoria['nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Precio venta</label>
                                    <input class="form-control" id="precio_venta" name="precio_venta" type="text" value="<?php echo $productos['precio_venta']; ?>"
                                        required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Precio Compra</label>
                                    <input class="form-control" id="precio_compra" name="precio_compra" type="text" value="<?php echo $productos['precio_compra']; ?>"
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Stock minimo</label>
                                    <input class="form-control" id="stock_minimo" name="stock_minimo" type="text" value="<?php echo $productos['inventariable']; ?>"
                                        required />

                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Existencias</label>
                                    <input class="form-control" id="existencias" name="existencias" type="text" value="<?php echo $productos['existencias']; ?>"
                                        required />
                                </div>
                                <div class="col-12 col-sm-2">
                                    <label>Llevar Inventario</label>
                                    <select id="inventariable" name="inventariable" class="form-control">
                                        <option value="1" <?php if ($productos['inventariable'] == 1) {
                                                                echo 'selected';
                                                            } ?>>Si</option>
                                        <option value="0" <?php if ($productos['inventariable'] == 0) {
                                                                echo 'selected';
                                                            } ?>>No</option>
                                    </select>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label>Imagen</label>
                                        <br>
                                        <img src="<?php echo base_url() . 'images/productos/'.$productos['id'].'/foto_1.jpg'; ?>" class="img-responsive" width="" />

                                        <input type="file" id="img_producto" name="img_producto" accept="image/*" multiple />
                                    </div>
                                </div>
                                <p class="text-danger">Cargar imagen en formato JPG de 150x150 pixeles</p>
                            </div>
                        </div>
                        <a href="<?php echo base_url(); ?>productos" class="btn btn-primary">Regresar</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>

            <!-- /.container-fluid -->


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

</body>

</html>