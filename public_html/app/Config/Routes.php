<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
/* --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
#$routes->get('/', 'Home::index');

//$routes->resource('marcas');

//Routes for Bremen E-Commerce (CRM Vendedores)
$routes->get('menu/(:num)', 'Menu::show/$1');

$routes->get('marcasv', 'Marcas_vehiculo::index'); // obtiene marcas que estan en el sistema GET
$routes->post('marcasv', 'Marcas_vehiculo::store');  // agregar una marca nueva POST
$routes->get('marcasv/(:num)', 'Marcas_vehiculo::show/$1'); // obtener una marca especifica por id
$routes->post('marcasv/(:num)', 'Marcas_vehiculo::update/$1'); // actualizar la marca POST
$routes->delete('marcasv/(:num)', 'Marcas_vehiculo::destroy/$1'); // eliminar la marca POST

$routes->get('clasificacionesv', 'GetClasificaciones::index'); // obtiene clasificaciones que estan en el sistema GET

$routes->get('modelosv', 'Modelos_vehiculo::index');
$routes->post('modelosv', 'Modelos_vehiculo::store');
$routes->get('modelosv/(:num)', 'Modelos_vehiculo::show/$1');
$routes->get('modelosv/(:num)/(:num)', 'Modelos_vehiculo::show/$1/$2');
$routes->post('modelosv/(:num)', 'Modelos_vehiculo::update/$1');
$routes->delete('modelosv/(:num)', 'Modelos_vehiculo::destroy/$1');

$routes->get('aniov', 'Anio_vehiculo::index');
$routes->post('aniov', 'Anio_vehiculo::store');
$routes->get('aniov/(:num)', 'Anio_vehiculo::show/$1');
$routes->get('aniov/(:num)/(:num)', 'Anio_vehiculo::show/$1/$2');
$routes->post('aniov/(:num)', 'Anio_vehiculo::update/$1');
$routes->delete('aniov/(:num)', 'Anio_vehiculo::destroy/$1');

$routes->get('versionest', 'VersionesTamano_vehiculo::index');
$routes->get('versionest/(:num)/(:num)/(:num)', 'VersionesTamano_vehiculo::show/$1/$2/$3');

$routes->get('rines/(:num)', 'BusquedaRines::show/$1');
$routes->get('llantas/(:num)', 'Llantas::show/$1');

$routes->get('pernos', 'Pernos_vehiculo::index');
$routes->get('pernos/(:num)', 'Pernos_vehiculo::show/$1');

$routes->get('distancias', 'Distancias_vehiculo::index');
$routes->get('distancias/(:num)', 'Distancias_vehiculo::show/$1');

$routes->get('tamano', 'TamanoRinPernos_vehiculo::index');
$routes->get('tamano/(:num)/(:num)', 'TamanoRinPernos_vehiculo::show/$1/$2');

$routes->get('filtros', 'Filtros::index');
$routes->get('filtros/(:num)', 'Filtros::show/$1');



$routes->get('seccion/(:num)/(:num)', 'Secciones::show/$1/$2');

$routes->get('tipo/(:num)', 'Tipo::show/$1');
$routes->get('subtipo/(:num)/(:num)', 'SubTipo::show/$1/$2');

$routes->get('detalle/(:num)', 'DetalleProducto::show/$1');

$routes->get('cliente/(:num)', 'Cliente::show/$1');
$routes->post('cliente', 'Cliente::store');
$routes->get('verificarnit/(:num)','VerificarNitCliente::show/$1');

$routes->get('pedidos/(:any)', 'Pedidos::show/$1');
$routes->post('pedidos', 'Pedidos::store'); // inserta pedidos en linea [CLSA].
 // inserta pedidos en linea [CLSA].[SP_PEDIDOS_WEB_ONLINE_PEDIDO]

$routes->get('insertarpedido', 'Insertar_Pedido::index'); // obtiene marcas que estan en el sistema GET
$routes->post('insertarpedido', 'Insertar_Pedido::create'); // inserta pedidos en linea [CLSA].[SP_PEDIDOS_WEB_ONLINE_PEDIDO]/ESTE INSERTA PEDIDO NUEVO/ACTUALIZA SI HAY ARTICULOS NUEVOS
$routes->get('insertarpedido/(:num)', 'Insertar_Pedido::show/$1'); // obtener una marca especifica por id
$routes->post('insertarpedido/(:num)', 'Insertar_Pedido::update/$1'); // actualizar la marca POST

$routes->post('actualizarcliente/(:num)', 'ActualizarCliente::update/$1'); // actualizar la marca POST

$routes->post('insertarcliente', 'InsertarCliente::create'); // inserta pedidos en linea [CLSA].

$routes->delete('borrarpedido/(:num)', 'Borrar_LineaPedido::destroy/$1');

$routes->get('image/(:any)', 'Image::show/$1');

$routes->get('bodegau/(:any)', 'BodegaUsuario::show/$1');

$routes->get('servicios/(:num)', 'Servicios::show/$1');
$routes->get('busqueda/(:num)', 'Buscador::show/$1');
$routes->get('reportes/(:num)', 'Reportes::show/$1');

$routes->get('promo/(:num)', 'Promociones::show/$1');

$routes->get('consecutivos/(:num)', 'ConsecutivoPedido::show/$1');

$routes->get('ventascliente', 'VentasCliente::index');
$routes->get('clasificacionarticulos', 'ClasificacionArticulos::index');
$routes->get('fitrarmarcas', 'FitrarMarcas::index');

// $routes->get('getinformeventafacturador', 'GetInformeVentaFacturador::index'); 

$routes->get('getimpuesto/(:num)', 'GetImpuestoArticulo::show/$1');


$routes->get('getinformeventafacturador', 'GetInformeVentaFacturador::index');

$routes->get('getinformeventafacturadoreco', 'GetInformeVentaFacturadorEco::index');


$routes->get('getvalidaordencompra', 'GetValidaOrdenCompra::index');

$routes->get('getarticulosbodega', 'GetArticulosBodega::index');

$routes->get('getexistenciabodega', 'GetExistenciaBodega::index');


$routes->get('verificarordentaller/(:any)', 'verificarOrdenTaller::create/$1'); // verifica si el pedido tiene orden de taller
$routes->post('verificarordentaller/(:any)', 'verificarOrdenTaller::validaranulado/$1'); // verifica el articulo en una linea especifica esta anulado o no 

$routes->get('getencuesta/(:any)', 'GetEncuestas::show/$1'); // Encuestas CRM Vendedor

//Routes for Norwing E-Commerce
$routes->get('getmetasvendedor', 'GetMetasVendedor::index');
$routes->get('getdescuentos', 'GetDescuentos::index');
$routes->get('norwingreportes/(:any)', 'NorwingGetReportes::index/$1');

///////////////////////Routes for WMS ////////////////////////////
$routes->get('wmslogin', 'WMSspLogin::login');//Establece la ruta al controlador para el login de usuarios
$routes->get('getdashinfo/(:num)', 'GetDashInfo::show/$1');
$routes->get('filtroswms', 'GetFiltrosWMS::index');
$routes->get('getverificacion/(:any)', 'GetVerificacion::show/$1'); //Establece la ruta al controlador GetVerificacion
$routes->get('guardadoparcial/(:any)', 'GetGuardadoParcial::show/$1');//Establece la ruta al controlador GetGuardadoParcial y actualizar filas eliminadas
$routes->get('procesarpedido/(:any)', 'GetProcesarPedido::show/$1');//Establece la ruta al controlador GetProcesarPedido
$routes->get('devolverarticulo/(:any)', 'GetDevolverArticulo::show/$1');//Establece la ruta al controlador GetDevolverArticulo
$routes->get('contenedor/(:any)', 'GetContenedores::show/$1');//Establece la ruta al controlador GetContenedor
$routes->get('wmsbusquedaarticulos/(:any)', 'WMSbusquedaArticulos::show/$1');//Establece la ruta al controlador de la búsqueda de articulos
$routes->get('wmsexistenciaarticulosporbodega/(:any)', 'WMSExistenciasArticuloBodegas::show/$1');//Establece la ruta al controlador de las existencias de los articulos por bodega
$routes->get('wmsautorizacioncontenedor', 'WMSgetTrasladoAutorizacion::show');//Establece la ruta al controlador de las existencias de los articulos por bodega
$routes->get('wmsordenesdecompras/(:any)', 'WMSordenesDeCompras::show_OrdenesDeCompras/$1');//Establece la ruta al controlador que trae la lista de las ordenes de compras
$routes->get('wmsordenesdecompraslist', 'WMSordenesDeCompras::show_OrdenDeComprasList');//Establece la ruta al controlador que trae la lista de las ordenes de compras
$routes->get('wmsguardaprocesaordendecompralist/(:any)', 'WMSguardaOdenesDeCompras::show/$1');//Establece la ruta al controlador que guarda parciálmente la lista de las ordenes de compras




//Routes for Dalbos
$routes->get('getrptventasdinamico', 'DBSGetReporteDinamicoVentas::index');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
        require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
