<?php

namespace App\Controllers;

use App\Models\GetValidaOrdenCompra_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetValidaOrdenCompra extends BaseController
{
    protected $format = 'json';
    /**
    * Valida si existe orden de compra
    * @return Response
    **/
    public function index()
    {
        $model = new GetValidaOrdenCompra_Model();
        if(!empty($_GET['pCliente'])) {$pCliente = $_GET["pCliente"];}else {$pCliente = null;}
        if(!empty($_GET['pOrdenCompra'])) {$pOrdenCompra = $_GET["pOrdenCompra"];}else {$pOrdenCompra = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Orden Comprobada',
                'existe_orden_compra' => $model->GetValidaOrdenCompra($pCliente,$pOrdenCompra)
            ]
        );
    }
}
