<?php
namespace App\Controllers;

use App\Models\WMSExistenciasArticuloBodegas_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class WMSExistenciasArticuloBodegas extends BaseController
{
    protected $format = 'json';
    
    /**
     * Get a single client by ID
     */
    public function show($id)
    {
        try {
          $model = new WMSExistenciasArticuloBodegas_Model();
         // if(!empty($_GET['user'])) {$pUser = $_GET["user"];}else {$pUser = null;}
          switch ($id) {
            case 1:
                  if(!empty($_GET['p_Articulo'])) {$p_Articulo = $_GET["p_Articulo"];}else {$p_Articulo = null;}
				  //if(!empty($_GET['p_Opcion'])) {$p_Opcion = $_GET["p_Opcion"];}else {$p_Opcion = null;}
                  $reporte = $model->sp_getExistenciaBodega($p_Articulo,'1');
              break;
            default:              
              break;
          }
          return $this->getResponse(
                          [
                              'msg'       => 'SUCCESS',
                              'message'   => 'Consulta recuperado con exito',
                              'reporte' => $reporte
                          ]
                      );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar la existencia '
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    } 
}