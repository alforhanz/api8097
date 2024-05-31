<?php
namespace App\Controllers;

use App\Models\verificarOrdenTaller_Model;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use \Firebase\JWT\JWT;
use Exception;

class verificarOrdenTaller extends BaseController
{
    protected $format = 'json';

    public function index()
    {
        $model = new verificarOrdenTaller_Model();
        return $this->getResponse(
            [
                'message' => 'Respuesta recuperada con exito',
                'Tipo' => 'index'
            ]
        );
    }

    public function create($id)
    {
		//CREACION OBJETO MODEL
        $model = new verificarOrdenTaller_Model();
        // $input = $this->getRequestInput($this->request); 
       
        $resp = $model->verificarOrdenTaller($id);
        			
		//respuesta a retornar
        return $this->getResponse
		(
            [
              'msg'     => 'SUCCESS', 
              'message' => $resp, 
            ]
        );
    }
	
	public function validaranulado($id) 
    {
		try {
            $model = new verificarOrdenTaller_Model();
                $input = $this->getRequestInput($this->request);
            if(!empty($input['pedido'])) {$pPedido = $input["pedido"];}else {$pPedido = null;}
            if(!empty($input['articulo'])) {$pArticulo = $input["articulo"];}else {$pArticulo = null;}
            $model = $model->sp_validaarticuloanuladotaller($pPedido,$id,$pArticulo);
              return $this
                  ->getResponse(
                      [
                          'msg'     => 'SUCCESS',
                          'message' => $model 
                      ]
                  );
        } catch (Exception $exception) { 
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }


}