<?php

namespace App\Controllers;

use App\Models\VersionesTamanovehiculo_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class VersionesTamano_vehiculo extends BaseController
{
    protected $format    = 'json';
    /**
     * Get all Modelos
     * @return Response
     */
    public function index()
    {
        $model = new VersionesTamanovehiculo_Model();
        return $this->getResponse(
            [
                'message' => 'Marcas recuperados con exito',
                'marcas' => $model->findVersionesTamanoByIds()
            ]
        );
    }

    /**
     * Create a new Client
     */
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

        $user = $input['name'];
        $model = new ModelosVehiculo_Model();
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
    public function show($idmarca,$anio,$idmodelo)
    {
      //  try {
            $model = new VersionesTamanovehiculo_Model();
            $versiones = $model->findVersionesTamanoByIds(1,$idmarca,$anio,$idmodelo);
            $rines = $model->findVersionesTamanoByIds(2,$idmarca,$anio,$idmodelo);
            return $this->getResponse(
                [
                  'msg'     => 'SUCCESS',
                  'message' => 'Versiones y Rines recuperado con exito',
                  'versiones' => $versiones,
                  'rines' => $rines
                ]
            );
     /*   } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar el resultado con los filtros especificadas'
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