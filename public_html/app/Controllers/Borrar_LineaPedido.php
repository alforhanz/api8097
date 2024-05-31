<?php
namespace App\Controllers;

use App\Models\Pedidos_Model;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use \Firebase\JWT\JWT;
use Exception;

class Borrar_LineaPedido extends BaseController
{
    protected $format = 'json';
    /*
    * Get all MarcasVehiculo
    * @return Response
    */
    public function index()
    {
        $model = new Pedidos_Model();
        return $this->getResponse(
            [
                'message' => 'Tipo recuperados con exito',
                'Tipo' => 'index'
            ]
        );
    }
    /**
    * Create a new Client
    **/
    public function create()
    {
        $model = new Pedidos_Model();
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[6]|max_length[255]|validateUser[username, password]'
        ];
        $input = $this->getRequestInput($this->request);
        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

    }

    /**
     * Get a single client by ID
     */
    public function show($pTipoConsulta)
    {
        try {
            $msg ="";
            return $this->getResponse(
                [
                    'msg'        => $msg,
                    'message'    => 'Pedidos recuperado con exito',
                    'pedidos'    => $ArrPedido,
                ]
            );
       } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar el Cliente para la ID especificada'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($id)
    {
        try {
            $model = new ClientModel();
            $model->findClientById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $client = $model->findClientById($id);

            return $this->getResponse(
                [
                    'message' => 'Client updated successfully',
                    'client' => $client
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

    public function destroy($id)
    {
		
		try {
            $model = new Pedidos_Model();
                $input = $this->getRequestInput($this->request);
            if(!empty($input['pedido'])) {$pPedido = $input["pedido"];}else {$pPedido = null;}
            if(!empty($input['promo'])) {$pPromo = $input["promo"];}else {$pPromo = null;}
            if(!empty($input['articulo'])) {$pArticulo = $input["articulo"];}else {$pArticulo = null;}
            $model = $model->sp_delete_articulo_orden_taller($pPedido,$pArticulo, $id,$pPromo);
              return $this
                  ->getResponse(
                      [
                          'msg'     => $model,
                          'message' => 'El producto fue eliminado correctamente'
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
        // try {
            // $model = new Pedidos_Model();
                // $input = $this->getRequestInput($this->request);
            // if(!empty($input['pedido'])) {$pPedido = $input["pedido"];}else {$pPedido = null;}
            // if(!empty($input['promo'])) {$pPromo = $input["promo"];}else {$pPromo = null;}
            // if(!empty($input['articulo'])) {$pArticulo = $input["articulo"];}else {$pArticulo = null;}
            // $model = $model->sp_borrar_pedido_linea($pPedido,$pArticulo, $id);
            // if($model == 'ELIMINADO'){
              // return $this
                  // ->getResponse(
                      // [
                          // 'msg'     => 'SUCCESS',
                          // 'message' => 'El producto fue eliminado correctamente'
                      // ]
                  // );
            // }else {
              // return $this
                  // ->getResponse(
                      // [
                          // 'msg'     => 'FAIL',
                          // 'message' => 'El producto NO fue eliminado correctamente'
                      // ]
                  // );
            // }
        // } catch (Exception $exception) {
            // return $this->getResponse(
                // [
                    // 'message' => $exception->getMessage()
                // ],
                // ResponseInterface::HTTP_NOT_FOUND
            // );
        // }
    }
	
}
