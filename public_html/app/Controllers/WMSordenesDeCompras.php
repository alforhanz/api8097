<?php
namespace App\Controllers;

use App\Models\WMSodenesDeCompras_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class WMSordenesDeCompras extends BaseController
{
	protected $format = 'json';
    /**
     * Get a single client by ID
     */
    public function show_OrdenesDeCompras($pTipoConsulta)
    {

          if($pTipoConsulta){
        
        switch ($pTipoConsulta) {
            
            case 'L':
                        try {
                            $model = new WMSodenesDeCompras_Model();
                            //Definir los parametros
                            $pSistema = "WMS";             
                            $pUsuario = !empty($_GET['pUsuario']) ? $_GET["pUsuario"] : null;
                            $pOpcion = !empty($_GET['pOpcion']) ? $_GET["pOpcion"] : null;
                            // $pOpcion = 'E';
                            $pBodega = !empty($_GET['pBodega']) ? $_GET["pBodega"] : null;
                            //$pEstado = !empty($_GET['pEstado']) ? $_GET["pEstado"] : null;
                            $pEstado = 'E';
                            $pOrden = !empty($_GET['pOrden']) ? $_GET["pOrden"] : null;
                   

                            // Llama al procedimiento almacenado con los parámetros adecuados
                            $ordenCompra = $model->sp_getOrdenesdeCompras($pSistema, $pUsuario, $pOpcion,$pBodega,$pEstado, $pOrden);

                            return $this->getResponse([
                                'msg' => 'SUCCESS',
                                'message' => 'Consulta recuperada con éxito',
                                'ordenCompra' => $ordenCompra
                                 ]);
                        } catch (Exception $e) {
                            return $this->getResponse([
                                'message' => 'No se pudo completar la consulta: ' . $e->getMessage()
                            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
                        }
        break;
        default:                   
        break;
            }
    }

}


//muestra las lioneas de una orden de compras
    public function show_OrdenDeComprasList()
    {
        try {
                 $model = new WMSodenesDeCompras_Model();
                    //Definir los parametros
                    $pSistema = "WMS";             
                    $pUsuario = !empty($_GET['pUsuario']) ? $_GET["pUsuario"] : null;            
                    $pOpcion = 'D';
                    $pBodega = !empty($_GET['pBodega']) ? $_GET["pBodega"] : null;
                    $pEstado = !empty($_GET['pEstado']) ? $_GET["pEstado"] : null;                    
                    $pOrden = !empty($_GET['pOrden']) ? $_GET["pOrden"] : null;
                   
                    // Llama al procedimiento almacenado con los parámetros adecuados
                    $detalleOC = $model->sp_getOrdenesdeCompraList($pSistema, $pUsuario, $pOpcion,$pBodega,$pEstado, $pOrden);

                    return $this->getResponse([
                        'msg' => 'SUCCESS',
                        'message' => 'Consulta recuperada con éxito',
                        'detalleOC' => $detalleOC
                            ]);
                        } catch (Exception $e) {
                            return $this->getResponse([
                        'message' => 'No se pudo completar la consulta: ' . $e->getMessage()
                            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
                        }
    }
    
}
 