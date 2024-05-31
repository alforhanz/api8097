<?php
namespace App\Controllers;

use App\Models\Cliente_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Cliente extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/ 
    public function index()
    {
        $model = new Cliente_Model();
        return $this->getResponse(
            [
                'message' => 'Tipo recuperados con exito',
                'Tipo' => $model->findTipoAll()
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
    public function show($id)
    {
        try {
              $model = new Cliente_Model();
              if(!empty($_GET['user'])) {$pUser = $_GET["user"];}else {$pUser = null;}
              if(!empty($_GET['categoria'])) {$pCategoria = $_GET["categoria"];}else {$pCategoria = null;}
              if(!empty($_GET['cliente'])) {$pCliente = $_GET["cliente"];}else {$pCliente = null;}
              if(!empty($_GET['opcion'])) {$pOpcion = $_GET["opcion"];}else {$pOpcion = null;}
              if(!empty($_GET['tipobusqueda'])) {$pTipoBusqueda = $_GET["tipobusqueda"];}else {$pTipoBusqueda = null;}
            if($id == 1){
            $cliente = $model->getBusquedaglobalClientes($pCliente,$pOpcion,$pCategoria,$pTipoBusqueda,$pUser);
              return $this->getResponse(
                  [
                      'msg'        => 'SUCCESS',
                      'message'    => 'Cliente recuperado con exito1',
                      'cliente'    => $cliente,
                  ]
              );
            }else if($id == 2){
                $fechaFinal = date('Ymd');
                $fechaInicial   = date("Ymd",strtotime($fechaFinal."- 1 month"));
                $cuenta  = $model->getEstadoDeCuenta_ClientesWeb('E', $pCliente, $fechaInicial, $fechaFinal,null,null);
                return $this->getResponse(
                  [
                      'msg'        => 'SUCCESS',
                      'message'    => 'Cliente recuperado con exito',
                      'cuenta'    => $cuenta
                  ]
              );
            }else{
              return $this->getResponse(
                  [
                      'msg'        => 'Fail', 
                      'message'    => 'Cliente recuperado con exito',
                  ]
              );
            }
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