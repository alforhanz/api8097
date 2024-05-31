<?php

namespace App\Controllers;

use App\Models\GetInformeVentaFacturadorEco_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetInformeVentaFacturadorEco extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Corregimientos
    * @return Response
    **/
    public function index()
    {
        $model = new GetInformeVentaFacturadorEco_Model();
        if(!empty($_GET['facturador'])) {$Facturador = $_GET["facturador"];}else {$Facturador = null;}
        if(!empty($_GET['tipo'])) {$tipo = $_GET["tipo"];}else {$tipo = null;}
        if(!empty($_GET['resultado'])) {$resultado = $_GET["resultado"];}else {$resultado = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Ventas por cliente recuperados con éxito...8097',
                'ventasdefacturador' => $model->GetInformeVentaFacturadorEco($Facturador,$tipo,$resultado)
            ]
        );
    }
}
