<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Home::index');
$routes->get('dashboard', 'Dashboard::index');

$routes->get('/unidades', 'Unidades::index');
$routes->get('/unidades/nuevo', 'Unidades::nuevo');
$routes->post('/unidades/insertar', 'Unidades::insertar');
$routes->get('/unidades/editar/(:num)', 'Unidades::editar/$1');
$routes->post('/unidades/actualizar', 'Unidades::actualizar');
$routes->get('/unidades/eliminar/(:num)', 'Unidades::eliminar/$1');
$routes->get('/unidades/eliminados', 'Unidades::eliminados');
$routes->get('/unidades/reingresar/(:num)', 'Unidades::reingresar/$1');


$routes->get('/categorias', 'Categorias::index');
$routes->get('/categorias/nuevo', 'Categorias::nuevo');
$routes->post('/categorias/insertar', 'Categorias::insertar');
$routes->get('/categorias/editar/(:num)', 'Categorias::editar/$1');
$routes->post('/categorias/actualizar', 'Categorias::actualizar');
$routes->get('/categorias/eliminar/(:num)', 'Categorias::eliminar/$1');
$routes->get('/categorias/eliminados', 'Categorias::eliminados');
$routes->get('/categorias/reingresar/(:num)', 'Categorias::reingresar/$1');


$routes->get('/productos', 'Productos::index');
$routes->get('/productos/nuevo', 'Productos::nuevo');
$routes->post('/productos/insertar', 'Productos::insertar');
$routes->get('/productos/editar/(:num)', 'Productos::editar/$1');
$routes->post('/productos/actualizar', 'Productos::actualizar');
$routes->get('/productos/eliminar/(:num)', 'Productos::eliminar/$1');
$routes->get('/productos/eliminados', 'Productos::eliminados');
$routes->get('/productos/reingresar/(:num)', 'Productos::reingresar/$1');
$routes->get('productos/buscarPorCodigo/(:any)', 'Productos::buscarPorCodigo/$1');
$routes->get('productos/buscarPorId/(:num)', 'Productos::buscarPorId/$1');
$routes->get('/productos/autocompleteData', 'Productos::autocompleteData');
$routes->get('/productos/muestraCodigos', 'Productos::muestraCodigos');
$routes->get('/productos/generaBarras', 'Productos::generaBarras');
$routes->get('/productos/mostrarMinimos', 'Productos::mostrarMinimos');
$routes->get('/productos/generaMinimosPdf', 'Productos::generaMinimosPdf');


$routes->get('/logs', 'Configuracion::verLogs');




$routes->get('/clientes', 'Clientes::index');
$routes->get('/clientes/nuevo', 'Clientes::nuevo');
$routes->post('/clientes/insertar', 'Clientes::insertar');
$routes->get('/clientes/editar/(:num)', 'CLientes::editar/$1');
$routes->post('/clientes/actualizar', 'Clientes::actualizar');
$routes->get('/clientes/eliminar/(:num)', 'Clientes::eliminar/$1');
$routes->get('/clientes/eliminados', 'Clientes::eliminados');
$routes->get('/clientes/reingresar/(:num)', 'Clientes::reingresar/$1');
$routes->get('/clientes/autocompleteData', 'Clientes::autocompleteData');


$routes->get('/proveedores', 'Proveedores::index');
$routes->get('/proveedores/nuevo', 'Proveedores::nuevo');
$routes->post('/proveedores/insertar', 'Proveedores::insertar');
$routes->get('/proveedores/editar/(:num)', 'Proveedores::editar/$1');
$routes->post('/proveedores/actualizar', 'Proveedores::actualizar');
$routes->get('/proveedores/eliminar/(:num)', 'Proveedores::eliminar/$1');
$routes->get('/proveedores/eliminados', 'Proveedores::eliminados');
$routes->get('/proveedores/reingresar/(:num)', 'Proveedores::reingresar/$1');

$routes->get('/configuracion', 'Configuracion::index');
$routes->post('/configuracion/actualizar', 'Configuracion::actualizar');

$routes->get('usuarios', 'Usuarios::index');
$routes->get('/usuarios/nuevo', 'Usuarios::nuevo');
$routes->post('/usuarios/insertar', 'Usuarios::insertar');
$routes->get('/usuarios/editar/(:num)', 'Usuarios::editar/$1');
$routes->post('/usuarios/actualizar', 'Usuarios::actualizar');
$routes->get('/usuarios/eliminar/(:num)', 'Usuarios::eliminar/$1');
$routes->get('/usuarios/eliminados', 'Usuarios::eliminados');
$routes->get('/usuarios/reingresar/(:num)', 'Usuarios::reingresar/$1');
$routes->post('/usuarios/valida', 'Usuarios::valida');
$routes->get('/usuarios/logout', 'Usuarios::logout');
$routes->get('/usuarios/cambia_password', 'Usuarios::cambia_password');
$routes->post('/usuarios/actualizar_password', 'Usuarios::actualizar_password');


$routes->get('roles', 'Roles::index');
$routes->get('/roles/nuevo', 'Roles::nuevo');
$routes->post('/roles/insertar', 'Roles::insertar');
$routes->get('/roles/editar/(:num)', 'Roles::editar/$1');
$routes->post('/roles/actualizar', 'Roles::actualizar');
$routes->get('/roles/eliminar/(:num)', 'Roles::eliminar/$1');
$routes->get('/roles/eliminados', 'Roles::eliminados');
$routes->get('/roles/reingresar/(:num)', 'Roles::reingresar/$1');
$routes->get('/roles/detalles/(:num)', 'Roles::detalles/$1');
$routes->post('/roles/guardaPermisos', 'Roles::guardaPermisos');



$routes->get('cajas', 'Cajas::index');
$routes->get('/cajas/nuevo', 'Cajas::nuevo');
$routes->post('/cajas/insertar', 'Cajas::insertar');
$routes->get('/cajas/editar/(:num)', 'Cajas::editar/$1');
$routes->post('/cajas/actualizar', 'Cajas::actualizar');
$routes->get('/cajas/eliminar/(:num)', 'Cajas::eliminar/$1');
$routes->get('/cajas/eliminados', 'Cajas::eliminados');
$routes->get('/cajas/reingresar/(:num)', 'Cajas::reingresar/$1');
$routes->get('/cajas/cierre/(:num)', 'Cajas::arqueo/$1');
$routes->get('/cajas/nueva_apertura', 'Cajas::nuevo_arqueo');

$routes->get('compras', 'Compras::index');
$routes->get('/compras/nuevo', 'Compras::nuevo');
$routes->post('/compras/guarda', 'Compras::guarda');
$routes->get('/compras/generaCompraPdf/(:num)', 'Compras::generaCompraPdf/$1');
$routes->get('/compras/muestraCompraPdf/(:num)', 'Compras::muestraCompraPdf/$1');



$routes->get('ventas', 'Ventas::index');
$routes->get('/ventas/caja', 'Ventas::venta');
$routes->post('/ventas/guarda', 'Ventas::guarda');
$routes->get('/ventas/muestraTicket/(:num)', 'Ventas::muestraTicket/$1');
$routes->get('/ventas/generaTicket/(:num)', 'Ventas::generaTicket/$1');
$routes->get('/ventas/eliminar/(:num)', 'Ventas::eliminar/$1');
$routes->get('/ventas/eliminados', 'Ventas::eliminados');


$routes->get('/temporalcompra/insertar/(:any)/(:num)/(:any)', 'TemporalCompra::insertar/$1/$2/$3');
$routes->get('/temporalcompra/cargaproductos/(:num)', 'TemporalCompra::cargaProductos/$1');

$routes->post('/temporalcompra/adicionar/(:any)/(:any)', 'TemporalCompra::adicionar/$1/$2');
$routes->post('/temporalcompra/eliminar/(:any)/(:any)', 'TemporalCompra::eliminar/$1/$2');
$routes->post('/temporalcompra/actualizarcantidad', 'TemporalCompra::actualizarCantidad');












?>  