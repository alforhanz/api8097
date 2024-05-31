<?php

namespace App\Controllers;

use App\Models\GetClienteNit_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetClienteNit extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/
    public function index()
    {
        $model = new GetClienteNit_Model();
        if(!empty($_GET['nit'])) {$nic = $_GET["nit"];}else {$nic = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Nic recuperados con éxito',
                'nic' => $model->GetClienteNit($nic)
            ]
        );
    }
}
