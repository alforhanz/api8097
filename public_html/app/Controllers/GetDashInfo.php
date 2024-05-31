<?php
namespace App\Controllers;

use App\Models\GetDashInfo_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface; 
use Exception;

class GetDashInfo extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/ 
    public function index()
    {
        $model = new Buscador_Model();
        return $this->getResponse(
            [
                'message' => 'Tipo recuperados con exito',
                'Tipo' => $model->findTipoAll()
            ]
        );
    }
	
    public function show($id)
    {

        try {
          switch ($id) {
            case 1:
                  $model = new GetDashInfo_Model();
                  if(isset($_GET['usuario'])) {$pUsuario = $_GET["usuario"];}else {$pUsuario = null;}
                  $result = $model->GetDashInfo($pUsuario);
              break;
            default:
              # code...
              break;
          }
              return $this->getResponse(
                  [
                      'msg'        => 'SUCCESS',
                      'message'    => 'Busqueda recuperado con exito',
                      'data'    => $result,
                  ]
              );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar el Cliente para la ID especificada'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

}