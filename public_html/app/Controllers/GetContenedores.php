<?php
namespace App\Controllers;

use App\Models\GetContenedores_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetContenedores extends BaseController
{
    protected $format = 'json';


    /**
     * Get a single client by ID
     */
    public function show($pTipoConsulta)
    {

            $model = new GetContenedores_Model();
            $msg ="";
           
            if(!empty($_GET['pUsuario'])) {$pUsuario = $_GET["pUsuario"];}else {$pUsuario = null;}           
			if(!empty($_GET['pBodegaEnvia'])) {$pBodegaEnvia = $_GET["pBodegaEnvia"];}else {$pBodegaEnvia = null;}
			if(!empty($_GET['pBodegaSolicita'])) {$pBodegaSolicita = $_GET["pBodegaSolicita"];}else {$pBodegaSolicita = null;}
			
            if(!empty($_GET['pEstado'])) {$pEstado = $_GET["pEstado"];}else {$pEstado = null;}
            if(!empty($_GET['pFechaDesde'])) {$pFechaDesde = $_GET["pFechaDesde"];}else {$pFechaDesde = null;}
            if(!empty($_GET['pFechaHasta'])) {$pFechaHasta = $_GET["pFechaHasta"];}else {$pFechaHasta = null;}
            if(!empty($_GET['pConsecutivo'])) {$pConsecutivo = $_GET["pConsecutivo"];}else {$pConsecutivo = null;}
			if(!empty($_GET['pArticulo'])) {$pArticulo = $_GET["pArticulo"];}else {$pArticulo = null;}
			
			if(!empty($_GET['pBodega'])) {$pBodega = $_GET["pBodega"];}else {$pBodega = null;}
			if(!empty($_GET['jsonDetalles'])) {$jsonDetalles = $_GET["jsonDetalles"];}else {$jsonDetalles = null;}
			
            	$pArticulo = "";
                $pLineaConsec = "";
                $pLineaConteo = "";    

            if($pTipoConsulta){
				
				switch ($pTipoConsulta) {
					case 'R':

							$contenedor = $model->spContenedores('WMS', $pUsuario,'R', $pBodegaEnvia, $pBodegaSolicita, $pConsecutivo, $pEstado, $pFechaDesde, $pFechaHasta);
							  return $this->getResponse(
							  [
								  'msg'       => 'SUCCESS',
								  'message'   => 'contenedor recuperados con exito',
								  'contenedor'   => $contenedor
							  ]
						  );
					break;

					case 'E':

							$contenedor = $model->spContenedores('WMS', $pUsuario,'E', $pBodegaEnvia, $pBodegaSolicita, $pConsecutivo, $pEstado, $pFechaDesde, $pFechaHasta);
							  return $this->getResponse(
							  [
								  'msg'       => 'SUCCESS',
								  'message'   => 'contenedor recuperados con exito',
								  'contenedor'   => $contenedor
							  ]
						  );
					break;
					case 'L':
						 $contenedor = $model->spContenedores('WMS', $pUsuario,'L', $pBodegaEnvia, $pBodegaSolicita, $pConsecutivo, $pEstado, $pFechaDesde, $pFechaHasta);
                              return $this->getResponse(
                              [
                                  'msg'       => 'SUCCESS',
                                  'message'   => 'contenedor recuperados con exito',
                                  'contenedor'   => $contenedor
                              ]
                          );
					break;		

					case 'G':
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
										        //$contenedor = $model->spGuardaCont('WMS', $pUsuario, 'G', 'WMS_BC', $pConsecutivo, $pArticulo , $pLineaConsec, $pLineaConteo, $pEstado, $pBodega);
										        $contenedor = $model->spGuardaCont('WMS', $pUsuario, 'G', 'WMS_BC', $pConsecutivo, $pArticulo , $pLineaConsec, $pLineaConteo);
										    }
										}

									
									return $this->getResponse(
											[
											'msg'       => 'SUCCESS',
											'message'   => 'contenedor guardado con exito',
				                            'contenedor'   => $contenedor
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
										        //$contenedor = $model->spGuardaCont('WMS', $pUsuario, 'G', 'WMS_BC', $pConsecutivo, $pArticulo , $pLineaConsec, $pLineaConteo, $pEstado, $pBodega);
										        $contenedor = $model->spGuardaCont('WMS', $pUsuario, 'P', 'WMS_BC', $pConsecutivo, $pArticulo , $pLineaConsec, $pLineaConteo);
										    }
										}

									
									return $this->getResponse(
											[
											'msg'       => 'SUCCESS',
											'message'   => 'contenedor procesado con exito',
				                            'contenedor'   => $contenedor
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

