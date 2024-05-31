<?php
namespace App\Controllers;

use App\Models\GetGuardadoParcial_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetGuardadoParcial extends BaseController
{
    protected $format = 'json';

    /**
     * Get a single client by ID
     */
    public function show($pOpcion)
    {

            $model = new GetGuardadoParcial_Model();
            $msg ="";
            if(!empty($_GET['pUsuario'])) {$pUsuario = $_GET["pUsuario"];}else {$pUsuario = null;}
            //if(!empty($_GET['pOpcion'])) {$pOpcion = $_GET["pOpcion"];}else {$pOpcion = null;}
            //if(!empty($_GET['pModulo'])) {$pModulo = $_GET["pModulo"];}else {$pModulo = null;}
            if(!empty($_GET['pConsecutivoPed'])) {$pConsecutivoPed = $_GET["pConsecutivoPed"];}else {$pConsecutivoPed = null;}
            if(!empty($_GET['pPedido'])) {$pPedido = $_GET["pPedido"];}else {$pPedido = null;}
            if(!empty($_GET['jsonDetalles'])) {$jsonDetalles = $_GET["jsonDetalles"];}else {$jsonDetalles = null;}

            if(!empty($_GET['pArticulo'])) {$pArticulo = $_GET["pArticulo"];}else {$pArticulo = null;}
            //if(!empty($_GET['pLineaConsec'])) {$pLineaConsec = $_GET["pLineaConsec"];}else {$pLineaConsec = null;}
            //if(!empty($_GET['pLineaConteo'])) {$pLineaConteo = $_GET["pLineaConteo"];}else {$pLineaConteo = null;}
            if(!empty($_GET['pBodega'])) {$pBodega = $_GET["pBodega"];}else {$pBodega = null;}
         

            			
            if($pOpcion){
				
                $pArticulo = "";
                $pLineaConsec = "";
                $pLineaConteo = "";                

				switch ($pOpcion) {
          //GUARDADO PARCIAL
					case 'G':
                    try {
                            if (!empty($_GET['jsonDetalles'])) {
                                $jsonDetalles = $_GET["jsonDetalles"];
                                $detalles = json_decode($jsonDetalles, true); // true para que sea un array asociativo
                            } else {
                                $detalles = [];
                            }

                            foreach ($detalles as $detalle) 
                            {
                                $pArticulo = $detalle['ARTICULO'];
                                $pLineaConsec = $detalle['CANT_CONSEC'];
                                $pLineaConteo = $detalle['CANT_LEIDA'];
                                $pedidoguardado = $model->guardadoParcial('W', $pUsuario, $pOpcion, 'WMS_VP', $pConsecutivoPed, $pArticulo, $pLineaConsec,$pLineaConteo,'N',$pBodega);
                            }
							  return $this->getResponse(
							  [
								  'msg'       => 'SUCCESS',
								  'message'   => 'Pedido guardado con exito',
								  'pedidoguardado'   => $pedidoguardado
							  ]
						  );

                        } catch (Exception $e) {
                            // Manejo del error
                            return $this->getResponse([
                                'msg' => 'ERROR',
                                'message' => 'Error al procesar los detalles del pedido' . $e->getMessage()
                            ]);
                        }
					break;
          //PROCESAR
					case 'P':
						  $pedidoguardado = $model->guardadoParcial('W', $pUsuario, $pOpcion, 'WMS_VP', $pConsecutivoPed, $pArticulo, $pLineaConsec,$pLineaConteo,'N',$pBodega);
                              return $this->getResponse(
                              [
                                  'msg'       => 'SUCCESS',
                                  'message'   => 'Pedido guardado con exito',
                                  'pedidoguardado'   => $pedidoguardado
                              ]
                          );
					break;		
          //ELIMINAR ARTICULOS
					case 'E':
                    $articuloemilinado  = $model->ActualizarFilasEliminadas('W',$pUsuario, $pOpcion,'WMS_VP',$pConsecutivoPed,$pArticulo,null,null,'N',$pBodega);
                              return $this->getResponse(
                              [
                                  'msg'       => 'SUCCESS',
                                  'message'   => 'Pedido devuelto con exito',
                                  'articuloemilinado'   => $articuloemilinado 
                              ]
                          );
                    break;                  
					default:
					# code...
					break;
				}

			}
    }
}