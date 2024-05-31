<?php

namespace App\Controllers;

use App\Models\GetExistenciaBodega_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetExistenciaBodega extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/
    public function index()
    {
        $model = new GetExistenciaBodega_Model();
        if(!empty($_GET['Articulo'])) {$articulo = $_GET["Articulo"];}else {$articulo = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Existencia en bodega recuperados con éxito',
                'bodegas' => $model->getExistenciaBodega($articulo)
            ]
        );
    }
}
