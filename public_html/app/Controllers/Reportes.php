<?php
namespace App\Controllers;

use App\Models\Reportes_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Reportes extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/ 
    public function index()
    {
        $model = new Reportes_Model();
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
          $model = new Reportes_Model();
          if(!empty($_GET['user'])) {$pUser = $_GET["user"];}else {$pUser = null;}
          switch ($id) {
            case 1:
                  if(!empty($_GET['art'])) {$art = $_GET["art"];}else {$art = null;}
                  $reporte = $model->sp_getPreciosVendedor($pUser, $art);
              break;
            case 2:
                  if(!empty($_GET['art'])) {$art = $_GET["art"];}else {$art = null;}
                  if(!empty($_GET['cliente'])) {$cliente = $_GET["cliente"];}else {$cliente = null;}
                  if(!empty($_GET['factura'])) {$factura = $_GET["factura"];}else {$factura = null;}
                  $reporte = $model->sp_getUltimasComprasCliente($pUser,'R',$cliente,$art,$factura);
              break;
            case 3:
                  if(!empty($_GET['art'])) {$art = $_GET["art"];}else {$art = null;}
				  if(!empty($_GET['p_Opcion'])) {$p_Opcion = $_GET["p_Opcion"];}else {$p_Opcion = null;}
                  $reporte = $model->sp_getExistenciaBodega($art,$p_Opcion);
              break;
            default:
              # code...
              break;
          }
          return $this->getResponse(
                          [
                              'msg'       => 'SUCCESS',
                              'message'   => 'Consulta recuperado con exito',
                              'reporte' => $reporte
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