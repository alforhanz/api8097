<?php
namespace App\Controllers;

use App\Models\GetProcesarPedido_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetProcesarPedido extends BaseController
{
    protected $format = 'json';

    /**
     * Get a single client by ID
     */
    public function show($pOpcion)
    {

            $model = new GetProcesarPedido_Model();
            $msg ="";
            if(!empty($_GET['pUsuario'])) {$pUsuario = $_GET["pUsuario"];}else {$pUsuario = null;}
            if(!empty($_GET['pConsecutivoPed'])) {$pConsecutivoPed = $_GET["pConsecutivoPed"];}else {$pConsecutivoPed = null;}
            if(!empty($_GET['jsonDetalles'])) {$jsonDetalles = $_GET["jsonDetalles"];}else {$jsonDetalles = null;}
            if(!empty($_GET['pBodega'])) {$pBodega = $_GET["pBodega"];}else {$pBodega = null;}
         
     
            if($pOpcion){
                
                $pArticulo = "";
                $pLineaConsec = "";
                $pLineaConteo = "";                

                switch ($pOpcion) {
                    case 'P':
                    try {

                            $detalles = json_decode($jsonDetalles, true); // true para que sea un array asociativo

                            foreach ($detalles as $detalle) 
                            {
                                $pArticulo = $detalle['ARTICULO'];
                                $pLineaConsec = $detalle['CANT_CONSEC'];
                                $pLineaConteo = $detalle['CANT_LEIDA'];
                                $pedidoguardado = $model->procesarPedido('W', $pUsuario, $pOpcion, 'WMS_VP', $pConsecutivoPed, $pArticulo, $pLineaConsec,$pLineaConteo,'N',$pBodega);
                            }
                              return $this->getResponse(
                              [
                                  'msg'       => 'SUCCESS',
                                  'message'   => 'Pedido procesado con exito',
                                  'pedidoprocesado'   => $pedidoguardado
                              ]
                          );

                        } catch (Exception $e) {
                            // Manejo del error
                            return $this->getResponse([
                                'msg' => 'ERROR',
                                'message' => 'Error al procesar pedido: ' . $e->getMessage()
                            ]);
                        }
                    break;                                         
                    default:
                    # code...
                    break;
                }

            }
    }
}