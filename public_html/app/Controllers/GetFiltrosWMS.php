<?php

namespace App\Controllers;

use App\Models\GetFiltrosWMS_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetFiltrosWMS extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Filtros (clase, marca, tipo, subtipo, subtipo2, envase)
    * @return Response
    **/
    public function index()
    {
        $model = new GetFiltrosWMS_Model();
        if(!empty($_GET['clase'])) {$clase = $_GET["clase"];}else {$clase = null;}
        if(!empty($_GET['marca'])) {$marca = $_GET["marca"];}else {$marca = null;}
        if(!empty($_GET['tipo'])) {$tipo = $_GET["tipo"];}else {$tipo = null;}
		if(!empty($_GET['subtipo'])) {$subtipo = $_GET["subtipo"];}else {$subtipo = null;}
        if(!empty($_GET['subtipo2'])) {$subtipo2 = $_GET["subtipo2"];}else {$subtipo2 = null;}
        if(!empty($_GET['envase'])) {$envase = $_GET["envase"];}else {$envase = null;}

        $filtro = $model->GetFiltros('S',$clase,$marca,$tipo,$subtipo,$subtipo2,$envase);
		
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Filtros recuperados con Exito',
                'filtros' => $filtro
            ]
        );
    }
}
