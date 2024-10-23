<!-- Sidebar -->

<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>
            <div class="row">

                <!-- Posibles Clientes Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Administradores</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $result['administradores']; ?> <!-- Muestra solo el número de administradores -->

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-tie fa-2x text-gray-300"></i>
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
                                        Clientes</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $result['clientes']; ?> <!-- Muestra solo el número de clientes -->
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Productos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $result['productos']; ?> <!-- Muestra solo el número de productos -->
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
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Ventas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $result['ventas']; ?> <!-- Muestra solo el número de ventas -->

                                        <!-- Puedes agregar datos adicionales aquí -->
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Topbar -->
            <!-- Content Row -->
            <div class="row mt-4">
                <div class="col mb-4">
                    <a href="#" id="leads-btn" class="btn btn-info btn-block btn-tabla"
                        data-url="model/all_clientes.php">
                        Leads
                    </a>
                </div>
                <!-- JavaScript para simular el clic -->
                <script>
                    $(document).ready(function() {
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
        </div>
        <!-- Begin Page Content -->

        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <!-- End of Footer -->