<?php
namespace App\Controllers;

use App\Models\GetVerificacion_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetVerificacion extends BaseController
{
    protected $format = 'json';


    /**
     * Get a single client by ID
     */
    public function show($pTipoConsulta)
    {

            $model = new GetVerificacion_Model();
            $msg ="";
            if(!empty($_GET['pBodega'])) {$pBodega = $_GET["pBodega"];}else {$pBodega = null;}
            if(!empty($_GET['pFechaDesde'])) {$pFechaDesde = $_GET["pFechaDesde"];}else {$pFechaDesde = null;}
            if(!empty($_GET['pFechaHasta'])) {$pFechaHasta = $_GET["pFechaHasta"];}else {$pFechaHasta = null;}
			if(!empty($_GET['pPedido'])) {$pPedido = $_GET["pPedido"];}else {$pPedido = null;}
			if(!empty($_GET['pUsuario'])) {$pUsuario = $_GET["pUsuario"];}else {$pUsuario = null;}
			if(!empty($_GET['pOpcion'])) {$pOpcion = $_GET["pOpcion"];}else {$pOpcion = null;}
            
			
            if($pTipoConsulta){
				
				switch ($pTipoConsulta) {
					case 'P':
							$pedidos = $model->listaPedidos('WEB', $pUsuario, $pOpcion, $pFechaDesde, $pFechaHasta, $pPedido, $pBodega,null,'N');
							  return $this->getResponse(
							  [
								  'msg'       => 'SUCCESS',
								  'message'   => 'Pedidos recuperados con exito',
								  'pedidos'   => $pedidos
							  ]
						  );
					break;
					case 'C':
						  $marcas    = $model->sp_getMarcasVehiculoLlantas();
							  return $this->getResponse(
							  [
								  'msg'       => 'SUCCESS',
								  'message'   => 'Marcas recuperado con exito',
								  'marcas' => $marcas
							  ]
						  );
					break;
					case 'O':
						  $marcas    = $model->sp_getMarcasVehiculoLlantas();
							  return $this->getResponse(
							  [
								  'msg'       => 'SUCCESS',
								  'message'   => 'Marcas recuperado con exito',
								  'marcas' => $marcas
							  ]
						  );
					break;
					case 'D':
							$lineaspedido = $model->detallePedido($pPedido, $pFechaDesde, $pFechaHasta, $pBodega);
							  return $this->getResponse(
							  [
								  'msg'       		=> 'SUCCESS',
								  'message'   		=> 'Detalle de Pedido recuperado con exito',
								  'lineaspedido'   	=> $lineaspedido
							  ]
						  );
					break;
					
					default:
					# code...
					break;
				}
                // if($pTipoConsulta == 'D'){
                      // foreach($pedidos as $key) {
                            // $vfacturardor = $key->NombreFacturador;
							// $vRuc         = $key->Contribuyente;
							// $vNombre      = $key->Nombre;
							// $vCliente     = $key->CLIENTE;
							// $vCobrador    = $key->NOMBRE_COBRADOR;
							// $vVendedor    = $key->NombreVendedor;
							// $vEmbarcar_a  = $key->Embarcar_a;
							// $vContacto	  = $key->Contacto;
							// $vTelefono	  = $key->Telefono1; 
                            // $vPedido      = $key->Pedido;
							// $vOrdenCom    = $key->ORDEN_COMPRA;
                            // $vFecha       = $key->Fecha_Pedido;
                            // $vsubtotal    = $key->Total_Mercaderia;
                            // $vtotalPagar  = $key->Total_A_Facturar;
							// $vdesc_promo  = $key->DESC_PROMO;
                            // $vimpuesto    = $key->Total_Impuesto1;
                            // $vtipoDoc     = $key->TIPO_DOCUMENTO;
                            // $vEstado      = $key->ESTADO;
                            // $vdescuento   = $key->Monto_descuento1;
                            // $vCondicionP  = $key->CONDICION_PAGO;
                            // $vPromo       = $key->CONTRATO;
                            // $vObservacion = $key->observaciones;
                            // $vExento      = $key->EXENTO_IMPUESTOS;
                            // $cantBodega   = $model->sp_getExistenciaArticuloBodega($key->Articulo,2,$pBodega);
                            // $prom         = explode('_',$key->COMENTARIO);
                            // if(count($prom) == 2){ 
                              // $promo = $prom[0];
                              // $pn = $prom[1];
                            // }else{
                              // $promo = 0; 
                              // $pn = $prom[0];
                            // }
                            // $vitems[] = array(
                                        // 'lineapedido'  => $key->PEDIDO_LINEA,
                                        // 'articulo'     => $key->Articulo,
                                        // 'descripcion'  => $key->DescripcionArticulo,
										// 'id_envase'    => $key->ID_ENVASE,
                                        // 'precio'       => $key->Precio_Unitario,
                                        // 'precio_origen'=> $key->PRECIO_ORIGEN,
                                        // 'nivel_precio' => $pn,
                                        // 'cantidad'     => $key->Cantidad_Pedida,
                                        // 'clase'        => $key->CLASE,
                                        // 'promo'        => $promo,
                                        // 'excento'      => $key->IMPUESTO,
										// 'valor_itbms'      => $key->VALOR_ITBMS,
                                        // 'tipo_art'     => $key->tipo, //T articulo tipo terminado y V articulo tipo servicio
                                        // 'stockbod'     => intval($cantBodega),
                                        // 'stock'        => ""
                              // );
                            // }
                      // $ArrPedido[] = array(
                            // 'pedido'           => $vPedido,
                            // 'facturador'       => $vfacturardor, 
                            // 'CLIENTE'          => $vCliente,
                            // 'RUC'              => $vRuc,
                            // 'NOMBRE'           => $vNombre,
							// 'Embarcar_a'       => $vEmbarcar_a,
							// 'cobrador'		   => $vCobrador,
							// 'vendedor'		   => $vVendedor, 
							// 'contacto'		   => $vContacto,	  
							// 'telefono'		   => $vTelefono,	  
                            // 'fecha'            => $vFecha,
                            // 'subtotal'         => $vsubtotal,
                            // 'total_a_facturar' => $vtotalPagar,
							// 'desc_promo' 	   => $vdesc_promo,
                            // 'impuesto'         => $vimpuesto,
                            // 'descuento'        => $vdescuento,
                            // 'tipo_doc'         => $vtipoDoc,
                            // 'estado'           => $vEstado,
                            // 'condicion_pago'   => $vCondicionP,
                            // 'Observacion'      => $vObservacion,
                            // 'items'            => $vitems,
                            // 'promo'            => $vPromo,
                            // 'exento_impuesto'  => $vExento,
							// 'ORDEN_COMPRA'     => $vOrdenCom
                      // );
                      // $msg ="SUCCESS";
                    // }

                // if($pTipoConsulta == 'R'){
                        // foreach($pedidos as $key) {
                            // $ArrPedido[] = array(
                                        // 'PEDIDO'           => $key->PEDIDO,
                                        // 'RUC_CEDULA'       => $key->RUC_CEDULA,
                                        // 'NOMBRE'           => $key->NOMBRE,
                                        // 'CLIENTE'          => $key->CLIENTE,
                                        // 'FECHA_PEDIDO'     => $key->FECHA_PEDIDO,
                                        // 'TIPO_DOCUMENTO'   => $key->TIPO_DOCUMENTO,
                                        // 'BODEGA'           => $key->BODEGA,
                                        // 'ESTADO'           => $key->ESTADO,
                                        // 'TOTAL_A_FACTURAR' => $key->TOTAL_A_FACTURAR,
										// 'VENDEDOR' 		   => $key->USUARIO	
                              // );
                            // }
                            // $msg ="SUCCESS";
			}
    }
}