<?php

namespace App\Controllers;

use App\Models\VentasArticuloPorCliente_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class VentasCliente extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Corregimientos
    * @return Response
    **/
    public function index()
    {
        $model = new VentasArticuloPorCliente_Model();
        if(!empty($_GET['fechaini'])) {$Fechaini = $_GET["fechaini"];}else {$Fechaini = null;}
        if(!empty($_GET['fechafin'])) {$Fechafin = $_GET["fechafin"];}else {$Fechafin = null;}
		if(!empty($_GET['articulo'])) {$articulo = $_GET["articulo"];}else {$articulo = null;}
        if(!empty($_GET['CodeClient'])) {$CodeClient = $_GET["CodeClient"];}else {$CodeClient = null;}
        if(!empty($_GET['clase'])) {$clase = $_GET["clase"];}else {$clase = null;}
        if(!empty($_GET['marca'])) {$marca = $_GET["marca"];}else {$marca = null;}
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Articulos por cliente recuperados con éxito',
                'ventasporcliente' => $model->ObtenerArticuloPorCliente($Fechaini,$Fechafin,$clase,$marca,$articulo,$CodeClient)
            ]
        );
    }
}
