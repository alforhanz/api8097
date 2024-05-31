<?php

namespace App\Controllers;

use App\Models\GetRutas_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetRutas extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/
    public function index()
    {
        $model = new GetRutas_Model();
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Rutas recuperados con éxito',
                'rutas' => $model->GetRutas()
            ]
        );
    }
}
