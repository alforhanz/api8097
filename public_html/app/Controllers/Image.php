<?php
namespace App\Controllers;

use App\Models\Image_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Image extends BaseController
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
            $model = new Image_Model();
            $url = 'http://192.168.3.8:8100/';
            $id = str_replace("%20", " ", $id);
            $default = $url.'images/th-img-no-disponile.jpg';
            header ('Content-Type: image/jpg');
            $imagen = $model->getImage($id);
            $imagen = $url.'images/'.$imagen.'.jpg';
            $exists = $this->url_exists($imagen)? 'existe' : 'no existe';
            if ($exists == 'existe') {
              readfile($imagen);
              echo 'existe';
            } else {
              readfile($default);
              echo 'no existe '.$id;
            } 
          /*   return $this->getResponse(
                [
                    'msg'        => 'SUCCESS',
                    'message'    => 'Imagen recuperado con exito',
                    'cliente'    => $imagen,
                ]
            );*/
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar la imagen para la ID especificada'
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

    public function url_exists( $imagen) {
      $h = get_headers($imagen);
      $status = array();
      preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
      return ($status[1] == 200);
    }
}