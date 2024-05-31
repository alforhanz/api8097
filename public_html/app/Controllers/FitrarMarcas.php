<?php

namespace App\Controllers;

use App\Models\FitrarMarcas_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class FitrarMarcas extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Corregimientos
    * @return Response
    **/
    public function index()
    {
        $model = new FitrarMarcas_Model();
        if(!empty($_GET['clase'])) {$clase = $_GET["clase"];}else {$clase = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Marcas recuperadas con éxito',
                'clasificacion' => $model->FiltrarMarcasClases($clase)
            ]
        );
    }
}
