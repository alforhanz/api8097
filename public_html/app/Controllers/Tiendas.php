<?php

namespace App\Controllers;

use App\Models\Tiendas_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Tiendas extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Corregimientos
    * @return Response
    **/
    public function index()
    {
        $model = new Tiendas_Model();
        if(!empty($_GET['user'])) {$User = $_GET["user"];}else {$User = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Tiendas recuperados con éxito',
                'tiendas' => $model->ObtenerTiendas($User)
            ]
        );
    }
}
