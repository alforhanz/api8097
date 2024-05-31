<?php

namespace App\Controllers;

use App\Models\Clasificaciones_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetClasificaciones extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Clasificaciones
    * @return Response
    **/ 
    public function index()
    {
        $model = new Clasificaciones_Model();
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Clasificaciones recuperados con exito',
                'categorias' => $model->findClasificacionesAll()
            ]
        );
    }
  }