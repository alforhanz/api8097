<?php
namespace App\Controllers;

use App\Models\WMSbusquedaArticulos_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

use Exception;

class WMSbusquedaArticulos extends BaseController
{
    protected $format = 'json';
   
   /* public function index()
    {
        $model = new Buscador_Model();
        return $this->getResponse(
            [
                'message' => 'Tipo recuperados con exito',
                'Tipo' => $model->findTipoAll()
            ]
        );
    }*/
    /**
    * Create a new Client
    **/
  /*  public function store()
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
    }*/

    /**
     * Get a single client by ID
     */
    public function show($id)
    {
      /*
      MODULO BUSCADOR
      id: 1 para busqueda en general y Servicios
      id: 3 para busqueda de secciones
      id: 4 para busqueda de rines
      id: 5 para busqueda de llantas
      id: 6 para busqueda de filtros
      */
        try {
          switch ($id) {
        
              //Busqueda con Filtros para WMS
              case 1:
              $model = new WMSbusquedaArticulos_Model();
                  if(!empty($_GET['pArticulo'])) {$pArticulo = $_GET["pArticulo"];}else {$pArticulo = null;}
                  if(!empty($_GET['pClase'])) {$pClase = $_GET["pClase"];}else {$pClase = null;}
                  if(!empty($_GET['pMarca'])) {$pMarca = $_GET["pMarca"];}else {$pMarca = null;}
                  if(!empty($_GET['pUso'])) {$pUso = $_GET["pUso"];}else {$pUso = null;}
                  if(!empty($_GET['pEnvase'])) {$pEnvase = $_GET["pEnvase"];}else {$pEnvase = null;} 
                  if(!empty($_GET['pBodega'])) {$pBodega = $_GET["pBodega"];}else {$pBodega = null;}

                  $result = $model->Busqueda('S',null,$pArticulo,$pClase,$pMarca,$pUso,$pEnvase,$pBodega,0);
              break;
            default:
              # code...
              break;
          }
              return $this->getResponse(
                  [
                      'msg'        => 'SUCCESS',
                      'message'    => 'Busqueda recuperado con exito',
                      'data'    => $result,
                  ]
              );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Error en la busqueda'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}