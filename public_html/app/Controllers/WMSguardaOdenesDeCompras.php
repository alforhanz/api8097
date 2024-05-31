<?php
namespace App\Controllers;

use App\Models\WMSodenesDeCompras_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class WMSguardaOdenesDeCompras extends BaseController
{
    protected $format = 'json';


    /**
     * Get a single client by ID
     */
public function show($pTipoConsulta)
{

    $model = new WMSodenesDeCompras_Model();
    $msg ="";
   
    if(!empty($_GET['pUsuario'])) {$pUsuario = $_GET["pUsuario"];}else {$pUsuario = null;}           
    if(!empty($_GET['pEstado'])) {$pEstado = $_GET["pEstado"];}else {$pEstado = null;}
    if(!empty($_GET['pConsecutivo'])) {$pConsecutivo = $_GET["pConsecutivo"];}else {$pConsecutivo = null;}			
	if(!empty($_GET['pBodega'])) {$pBodega = $_GET["pBodega"];}else {$pBodega = null;}
	if(!empty($_GET['jsonDetalles'])) {$jsonDetalles = $_GET["jsonDetalles"];}else {$jsonDetalles = null;}
	
    	$pArticulo = "";
        $pLineaConsec = "";
        $pLineaConteo = "";    

    if($pTipoConsulta){
		
		switch ($pTipoConsulta) {
			
			case 'G':
   					try {

  							// $ordencompra = $model->spGuardaOrdenCompraLectura('WMS', 'PRUEBAPMA', 'G', 'WMS_BE', 'OC-0036957', '17.5R25 HIL' , 6, 5,null, null);

                            if (!empty($_GET['jsonDetalles'])) {
                                $jsonDetalles = $_GET["jsonDetalles"];
                                $detalles = json_decode($jsonDetalles, true); // true para que sea un array asociativo
                            } else {
                                $detalles = [];
                            }

	                      foreach ($detalles as $detalle) {
								    $pArticulo = $detalle['ARTICULO'];
								    $pLineaConsec = $detalle['CANT_CONSEC'];
								    $pLineaConteo = $detalle['CANT_LEIDA'];
								    
								    if ($pLineaConteo > 0) {								      
								         $ordencompra = $model->spGuardaOrdenCompraLectura('WMS', $pUsuario, 'G', 'WMS_BE', $pConsecutivo, $pArticulo , $pLineaConsec, $pLineaConteo,null, null);
								    }
								}

							
							return $this->getResponse(
									[
									'msg'       => 'SUCCESS',
									'message'   => 'Orden de compra guardada con exito',
		                            'ordencompra'   => $ordencompra
		                         	]
                         		 );

                    	} catch (Exception $e) {
                        // Manejo del error
                        return $this->getResponse([
                            'msg' => 'ERROR',
                            'message' => 'Error al guardar los detalles de la orden de compra... ' . $e->getMessage()
                        ]);
                    }
			break;		

			case 'P':
   					try {
                            if (!empty($_GET['jsonDetalles'])) {
                                $jsonDetalles = $_GET["jsonDetalles"];
                                $detalles = json_decode($jsonDetalles, true); // true para que sea un array asociativo
                            } else {
                                $detalles = [];
                            }

	                      foreach ($detalles as $detalle) {
								    $pArticulo = $detalle['ARTICULO'];
								    $pLineaConsec = $detalle['CANT_CONSEC'];
								    $pLineaConteo = $detalle['CANT_LEIDA'];
								    
								    if ($pLineaConteo > 0) {								       
								        $ordencompra = $model->spGuardaOrdenCompraLectura('WMS', $pUsuario, 'P', 'WMS_BE', $pConsecutivo, $pArticulo , $pLineaConsec, $pLineaConteo,null, null);
								    }
								}

							
							return $this->getResponse(
									[
									'msg'       => 'SUCCESS',
									'message'   => 'contenedor procesado con exito',
		                            'ordencompra'   => $ordencompra
		                         	]
                         		 );

                    	} catch (Exception $e) {
                        // Manejo del error
                        return $this->getResponse([
                            'msg' => 'ERROR',
                            'message' => 'Error al guardar los detalles del contenedor' . $e->getMessage()
                        ]);
                    }
			break;							
			
			default:					
			break;
		}
        
	}
}
}

