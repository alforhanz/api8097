<?php
namespace App\Controllers;

use App\Models\Usuarios_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class BodegaUsuario extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/ 
    public function index()
    {
        $model = new Bodegas_Model();
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
        $model = new Bodegas_Model();
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
    public function show($sistema)
    {

        try {
            $model = new Bodegas_Model();
            if(!empty($_GET['usuario'])) {$pUser = $_GET["usuario"];}else {$pUser = null;}
            if(!empty($_GET['bodega'])) {$pBodega = $_GET["bodega"];}else {$pBodega = null;}
            if(!empty($_GET['grupo'])) {$pGrupo = $_GET["grupo"];}else {$pGrupo = null;}
         
            $bodegas = $model->BodegasUsuarios($sistema,$pUser,$pBodega,$pGrupo);
            return $this->getResponse(
                [
                    'msg'      => 'SUCCESS',
                    'message'  => 'Bodega recuperado con exito',
                    'bodegas'  => $bodegas,
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar la bodega para la ID especificada'
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