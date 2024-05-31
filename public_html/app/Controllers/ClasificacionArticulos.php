<?php

namespace App\Controllers;

use App\Models\ClasificacionArticulos_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class ClasificacionArticulos extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Corregimientos
    * @return Response
    **/
    public function index()
    {
        $model = new ClasificacionArticulos_Model();
        if(!empty($_GET['grupo'])) {$Grupo = $_GET["grupo"];}else {$Grupo = null;}
        if(!empty($_GET['descripcion'])) {$descripcion = $_GET["descripcion"];}else {$descripcion = null;}

        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Clasificaciones recuperadas con éxito',
                'clasificacion' => $model->ObtenerClasificacionArticulos($Grupo,$descripcion)
            ]
        );
    }
}
