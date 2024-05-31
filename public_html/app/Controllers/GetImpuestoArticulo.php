<?php namespace App\Controllers;

use App\Models\GetImpuesto_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetImpuestoArticulo extends BaseController
{
    protected $format = 'json';
       /**
    * Get Impuesto Articulo
    **/ 
	
	    public function index()
    {
        $model = new GetImpuesto_Model();
        return $this->getResponse(
            [
				'msg'     => 'SUCCESS1',
                'message' => 'Impuesto recuperado con exito',
                'Impuesto' => $model->findTipoAll()
            ]
        );
    }
	
    public function show($id = null)
    {
        $model = new GetImpuesto_Model();
		$impuesto    = $model->GetImpuestoById($id);
        return $this->getResponse(
            [
				'msg'     => 'SUCCESS',
                'message' => 'Impuesto recuperado con exito',
                'impuesto' => $impuesto,
            ]
        );
    }

}