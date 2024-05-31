<?php

namespace App\Controllers;

use App\Models\Pedidos_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class ConsecutivoPedido extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/ 
    public function index()
    {
        $model = new MarcasVehiculo_Model();
        return $this->getResponse(
            [
                'msg' => 'SUCCESS',
                'message' => 'Marcas recuperados con exito',
                'marcas' => $model->findMarcasAll()
            ]
        );
    }
    /**
    * Create a new Client
    **/
    public function store()
    {
        $rules = [
            'name' => 'required',
//          'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[client.email]',
            'password' => 'required|max_length[255]'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $user  = $input['name'];
        $model = new MarcasVehiculo_Model();
        $model->save($input);
        $marcas = $model->where('name', $user)->first();
        return $this->getResponse(
            [
                'message' => 'Client added successfully',
                'client' => $marcas
            ]
        );
    }

    /**
     * Get a single client by ID
     */
    public function show($key)
    {
      // try {
            $model = new Pedidos_Model();
            if(!empty($_GET['user'])) {$pUser = $_GET["user"];}else {$pUser = null;}
            switch ($key) {
              case '1':
                $consecutivo = $model->sp_getCONSECUFA_USUARIO($pUser);
                break;
              case '2':
                if(!empty($_GET['numcons'])) {$pNumCons = $_GET["numcons"];}else {$pNumCons = null;}
                $consecutivo = $model->sp_PEDIDOS_WEB_ONLINE_CONSECUTIVO_PEDIDO($pNumCons);
                # code...
                break;
              default:
                # code...
                break;
            }
            
            return $this->getResponse(
                [
                    'msg' => 'SUCCESS',
                    'message' => 'Consecutivo recuperado con exito',
                    'consecutivo' => $consecutivo
                ]
            );
   /*     } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar la marca para la ID especificada'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }*/
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

            $model = new ClientModel();
            $client = $model->findClientById($id);
            $model->delete($client);

            return $this
                ->getResponse(
                    [
                        'message' => 'Client deleted successfully',
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