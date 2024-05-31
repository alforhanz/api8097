<?php

namespace App\Controllers;

use App\Models\Provincias_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Provincias extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/
    public function index()
    {
        $model = new Provincias_Model();
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Provincias recuperados con éxito',
                'provincias' => $model->getProvincias()
            ]
        );
    }
}
