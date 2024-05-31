<?php

namespace App\Controllers;

use App\Models\GetArticulosBodega_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetArticulosBodega extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/
    public function index()
    {
        $model = new GetArticulosBodega_Model();
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Articulos recuperados con éxito',
                'articulos' => $model->getArticulosBodega()
            ]
        );
    }
}
