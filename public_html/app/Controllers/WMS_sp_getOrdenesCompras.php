<?php
// namespace App\Controllers;

// use App\Models\WMS_sp_getOrdenesCompras_Model;
// use CodeIgniter\HTTP\Response;
// use CodeIgniter\HTTP\ResponseInterface;
// use Exception;

// class WMS_sp_getOrdenesCompras extends BaseController
// {
//     protected $format = 'json';


//     /**
//      * Get a single client by ID
//      */
//     public function show($pOpcion)
//     {

//             $model = new WMS_sp_getOrdenesCompras_Model();
//             $msg ="";
           

//            	$pSistema="WMS";
//             if(!empty($_GET['pUsuario'])) {$pUsuario = $_GET["pUsuario"];}else {$pUsuario = null;}
//            	$pModulo = "WMS_BE"
//            	if(!empty($_GET['pConsecutivo'])) {$pConsecutivo = $_GET["pConsecutivo"];}else {$pConsecutivo = null;
//            	if(!empty($_GET['pOrden'])) {$pOrden = $_GET["pOrden"];}else {$pOrden = null;
//            	if(!empty($_GET['jsonDetalles'])) {$jsonDetalles = $_GET["jsonDetalles"];}else {$jsonDetalles = null;}
//            	$pArticulo = "";
//             $pLineaConsec = "";
//             $pLineaConteo = "";            
//            // if(!empty($_GET['pEstado'])) {$pEstado = $_GET["pEstado"];}else {$pEstado = null;}
// 			if(!empty($_GET['pBodega'])) {$pBodega = $_GET["pBodega"];}else {$pBodega = null;}
			

//     if($pOpcion){
		
// 		switch ($pOpcion) {
// 			case 'E':
// 		  try {
// 		            $model = new WMSodenesDeCompras_Model();
// 		            //Definir los parametros
// 		            $pSistema = "WMS";             
// 		            $pUsuario = !empty($_GET['pUsuario']) ? $_GET["pUsuario"] : null;
// 		            $pOpcion = 'E';
// 		            $pBodega = !empty($_GET['pBodega']) ? $_GET["pBodega"] : null;
// 		            //$pEstado = !empty($_GET['pEstado']) ? $_GET["pEstado"] : null;
// 		            $pEstado = 'E';
// 		            $pOrden = !empty($_GET['pOrden']) ? $_GET["pOrden"] : null;
		           

// 		            // Llama al procedimiento almacenado con los parámetros adecuados
// 		            $ordenCompra = $model->sp_getOrdenesdeCompras($pSistema, $pUsuario, $pOpcion,$pBodega,$pEstado, $pOrden);

// 		            return $this->getResponse([
// 		                'msg' => 'SUCCESS',
// 		                'message' => 'Consulta recuperada con éxito',
// 		                'ordenCompra' => $ordenCompra
// 		            ]);
// 		        } catch (Exception $e) {
// 		            return $this->getResponse([
// 		                'message' => 'No se pudo completar la consulta: ' . $e->getMessage()
// 		            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
// 		        }
// 			break;

// 			case 'D':
// 				 try {
// 				            $model = new WMSodenesDeCompras_Model();
// 				            //Definir los parametros
// 				             $pSistema = "WMS";             
// 				            $pUsuario = !empty($_GET['pUsuario']) ? $_GET["pUsuario"] : null;
				            
// 				            $pOpcion = 'D';
// 				            $pBodega = !empty($_GET['pBodega']) ? $_GET["pBodega"] : null;
// 				            $pEstado = !empty($_GET['pEstado']) ? $_GET["pEstado"] : null;
// 				            //$pEstado = 'E';
// 				            $pOrden = !empty($_GET['pOrden']) ? $_GET["pOrden"] : null;
// 				            // Llama al procedimiento almacenado con los parámetros adecuados
// 				            $detalleOC = $model->sp_getOrdenesdeCompraList($pSistema, $pUsuario, $pOpcion,$pBodega,$pEstado, $pOrden);

// 				            return $this->getResponse([
// 				                'msg' => 'SUCCESS',
// 				                'message' => 'Consulta recuperada con éxito',
// 				                'detalleOC' => $detalleOC
// 				            ]);
// 				        } catch (Exception $e) {
// 				            return $this->getResponse([
// 				                'message' => 'No se pudo completar la consulta: ' . $e->getMessage()
// 				            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
// 				        }
// 			break;			

// 			case 'G':
//    					try {
//                             if (!empty($_GET['jsonDetalles'])) {
//                                 $jsonDetalles = $_GET["jsonDetalles"];
//                                 $detalles = json_decode($jsonDetalles, true); // true para que sea un array asociativo
//                             } else {
//                                 $detalles = [];
//                             }

// 	              foreach ($detalles as $detalle) {
// 						    $pArticulo = $detalle['ARTICULO'];
// 						    $pLineaConsec = $detalle['CANT_CONSEC'];
// 						    $pLineaConteo = $detalle['CANT_LEIDA'];
						    
// 						    if ($pLineaConteo > 0) {
// 						        $contenedor = $model->spGuardaOrdenCompraLectura($pSistema, $pUsuario, 'G', $pModulo, $pConsecutivo, $pArticulo, $pLineaConsec, $pLineaConteo, $pEstado, $pBodega);
// 						    }
// 						}
							
// 					return $this->getResponse(
// 							[
// 							'msg'       => 'SUCCESS',
// 							'message'   => 'contenedor guardado con exito',
//                             'contenedor'   => $contenedor
//                          	]
//                  		 );

//             	} catch (Exception $e) {
//                 // Manejo del error
//                 return $this->getResponse([
//                     'msg' => 'ERROR',
//                     'message' => 'Error al guardar los detalles del contenedor' . $e->getMessage()
//                 ]);
//             }
// 			break;		

// 			case 'P':
//    					try {
//                             if (!empty($_GET['jsonDetalles'])) {
//                                 $jsonDetalles = $_GET["jsonDetalles"];
//                                 $detalles = json_decode($jsonDetalles, true); // true para que sea un array asociativo
//                             } else {
//                                 $detalles = [];
//                             }

// 	                      foreach ($detalles as $detalle) {
// 								    $pArticulo = $detalle['ARTICULO'];
// 								    $pLineaConsec = $detalle['CANT_CONSEC'];
// 								    $pLineaConteo = $detalle['CANT_LEIDA'];
								    
// 								    if ($pLineaConteo > 0) {										       
// 								        $contenedor = $model->spGuardaCont($pSistema, $pUsuario, 'P', $pModulo, $pConsecutivo, $pArticulo, $pLineaConsec, $pLineaConteo, $pEstado, $pBodega);
// 								    }
// 								}

							
// 							return $this->getResponse(
// 									[
// 									'msg'       => 'SUCCESS',
// 									'message'   => 'contenedor procesado con exito',
// 		                            'contenedor'   => $contenedor
// 		                         	]
//                          		 );

//                     	} catch (Exception $e) {
//                         // Manejo del error
//                         return $this->getResponse([
//                             'msg' => 'ERROR',
//                             'message' => 'Error al guardar los detalles del contenedor' . $e->getMessage()
//                         ]);
//                     }
// 			break;							
			
// 			default:					
// 			break;
// 		}
        
// 	}
//     }
// }

