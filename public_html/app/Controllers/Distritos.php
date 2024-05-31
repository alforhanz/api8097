<?php

namespace App\Controllers;

use App\Models\Distritos_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Distritos extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/
    public function index()
    {
        $model = new Distritos_Model();
        if(!empty($_GET['idprovincia'])) {$idProvincia = $_GET["idprovincia"];}else {$idProvincia = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Distritos recuperados con éxito',
                'distritos' => $model->getDistritos($idProvincia)
            ]
        );
    }
}
