<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion shadow-sm" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/dashboard') ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-leaf"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Agro Nova</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?= base_url('/dashboard') ?>">
      <i class="fas fa-tachometer-alt"></i>
      <span>Escritorio</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Principal
  </div>

  <!-- Productos Section -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductos" aria-expanded="false" aria-controls="collapseProductos">
      <i class="fas fa-box"></i>
      <span>Productos</span>
    </a>
    <div id="collapseProductos" class="collapse" aria-labelledby="headingProductos" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones de Producto:</h6>
        <a class="collapse-item" href="<?= base_url('/productos') ?>">
          <i class="fas fa-box-open"></i> Todos los Productos
        </a>
        <a class="collapse-item" href="<?= base_url('/unidades') ?>">
          <i class="fas fa-balance-scale"></i> Unidades
        </a>
        <a class="collapse-item" href="<?= base_url('/categorias') ?>">
          <i class="fas fa-tags"></i> Categorías
        </a>
        <a class="collapse-item" href="<?= base_url('/proveedores') ?>">
          <i class="fas fa-truck"></i> Proveedores
        </a>
      </div>
    </div>
  </li>

  <!-- Clientes Section -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="false" aria-controls="collapseClientes">
      <i class="fas fa-user-friends"></i>
      <span>Clientes</span>
    </a>
    <div id="collapseClientes" class="collapse" aria-labelledby="headingClientes" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Administrar Clientes:</h6>
        <a class="collapse-item" href="<?= base_url('/clientes') ?>">
          <i class="fas fa-user-plus"></i> Agregar Cliente
        </a>
        <a class="collapse-item" href="<?= base_url('/clientes/eliminados') ?>">
          <i class="fas fa-user-slash"></i> Clientes Eliminados
        </a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Extras Heading -->
  <div class="sidebar-heading">
    Extras
  </div>

  <!-- Compras Section -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
      <i class="fas fa-truck"></i>
      <span>Compras</span>
    </a>
    <div id="collapseCompras" class="collapse" aria-labelledby="headingCompras" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones de Compras:</h6>
        <a class="collapse-item" href="<?= base_url('compras/nuevo') ?>">
          <i class="fas fa-file-invoice-dollar"></i> Nueva Compra
        </a>
        <a class="collapse-item" href="<?= base_url('compras') ?>">
          <i class="fas fa-list-alt"></i> Ver Compras
        </a>
      </div>
    </div>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="<?= base_url('ventas/caja') ?>">
      <i class="fas fa-cash-register"></i>
      <span>Caja</span>
    </a>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="<?= base_url('ventas') ?>">
      <i class="fas fa-shopping-cart"></i>
      <span>Ventas</span>
    </a>
  </li>

 <!-- Compras Section -->
 <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="false" aria-controls="collapseReportes">
      <i class="fas fa-chart-line"></i>
      <span>Reportes</span>
    </a>
    <div id="collapseReportes" class="collapse" aria-labelledby="headingReportes" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones de Reportes:</h6>
        <a class="collapse-item" href="<?= base_url('productos/mostrarMinimos') ?>">
          <i class="fas fa-file-invoice-dollar"></i> Reporte Minimos
        </a>
       
      </div>
    </div>
  </li>
  <!-- Reportes Section -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('reportes') ?>">
      <i class="fas fa-chart-line"></i>
      <span>Reportes</span>
    </a>
  </li>

  <!-- Administracion Section -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdministracion" aria-expanded="false" aria-controls="collapseAdministracion">
      <i class="fas fa-tools"></i>
      <span>Administración</span>
    </a>
    <div id="collapseAdministracion" class="collapse" aria-labelledby="headingAdministracion" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Configuraciones:</h6>
        <a class="collapse-item" href="<?= base_url('/configuracion') ?>">
          <i class="fas fa-cogs"></i> Configuración
        </a>
        <a class="collapse-item" href="<?= base_url('/usuarios') ?>">
          <i class="fas fa-users-cog"></i> Usuarios
        </a>
        <a class="collapse-item" href="<?= base_url('/logs') ?>">
          <i class="fas fa-list"></i> Logs
        </a>
        <a class="collapse-item" href="<?= base_url('/cajas') ?>">
          <i class="fas fa-cash-register"></i> Cajas
        </a>
        <a class="collapse-item" href="<?= base_url('/roles') ?>">
          <i class="fas fa-user-tag"></i> Roles
        </a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>