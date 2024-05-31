<?php

namespace App\Controllers;

use App\Models\GetCategoriaCliente_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetCategoriaCliente extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/
    public function index()
    {
        $model = new GetCategoriaCliente_Model();
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Categorias recuperados con éxito',
                'categorias' => $model->getCategoriaCliente()
            ]
        );
    }
}
