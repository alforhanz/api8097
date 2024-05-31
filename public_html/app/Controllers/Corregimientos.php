<?php

namespace App\Controllers;

use App\Models\Corregimientos_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Corregimientos extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Corregimientos
    * @return Response
    **/
    public function index()
    {
        $model = new Corregimientos_Model();
        if(!empty($_GET['iddistrito'])) {$idDistrito = $_GET["iddistrito"];}else {$idDistrito = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Corregimientos recuperados con éxito',
                'corregimientos' => $model->getCorregimientos($idDistrito)
            ]
        );
    }
}
