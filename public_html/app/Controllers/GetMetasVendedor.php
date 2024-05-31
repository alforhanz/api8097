<?php

namespace App\Controllers;

use App\Models\GetMetasVendedor_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetMetasVendedor extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Corregimientos
    * @return Response
    **/
    public function index()
    {
        $model = new GetMetasVendedor_Model();
        if(!empty($_GET['tipo'])) {$tipo = $_GET["tipo"];}else {$tipo = null;}
        if(!empty($_GET['vendedor'])) {$vendedor = $_GET["vendedor"];}else {$vendedor = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Metas por vendedor recuperadas con éxito...8097',
                'metasvendedor' => $model->GetMetasVendedor($tipo,$vendedor)
            ]
        );
    }
}
