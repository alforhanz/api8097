<?php
namespace App\Controllers;

use App\Models\GetDevolverArticulo_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetDevolverArticulo extends BaseController
{
    protected $format = 'json';

    /**
     * Get a single client by ID
     */
    public function show($pOpcion)
    {

            $model = new GetDevolverArticulo_Model();
            $msg ="";
            
            if(!empty($_GET['pPedido'])) {$pPedido = $_GET["pPedido"];}else {$pPedido = null;}
            if(!empty($_GET['pArticulo'])) {$pArticulo = $_GET["pArticulo"];}else {$pArticulo = null;}
                        			
            if($pOpcion){	
                        

				switch ($pOpcion) {				

					case 'D':
                    $articulodevuelto  = $model->devolverArticulo($pPedido, $pArticulo);
                              return $this->getResponse(
                              [
                                  'msg'       => 'SUCCESS',
                                  'message'   => 'Pedido devuelto con exito',
                                  'articulodevuelto'   => $articulodevuelto 
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