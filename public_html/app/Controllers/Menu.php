<?php
namespace App\Controllers;

use App\Models\Menu_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Menu extends BaseController
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
    //    try {
              $model = new Menu_Model();
              if(!empty($_GET['user'])) {$pUsuario = $_GET["user"];}else {$pUsuario = null;}
              if(!empty($_GET['sistema'])) {$pTipoSistema = $_GET["sistema"];}else {$pTipoSistema = null;}
              if(!empty($_GET['tipoMenu'])) {$ptipoMenu = $_GET["tipoMenu"];}else {$ptipoMenu = null;}
              if(!empty($_GET['modulo'])) {$pModulo = $_GET["modulo"];}else {$pModulo = null;}
              $menu = $model->sp_getModulosUsuario($pUsuario,$pTipoSistema,$ptipoMenu);
              $submenu = $model->sp_getPrivilegiosModulosUsuario($pUsuario,$pTipoSistema,$pModulo);
              // echo "<pre>";
              // print_r($menu);
              // echo "</pre>";
              // echo "<pre>";
              // print_r($submenu);
              // echo "</pre>";
              // die();
              $i=1;
                foreach($menu as $x) {
                    $arrMenu[]  = array(
                                        'ID'             => $i,
                                        'MODULO'         => $x->MODULO,
                                        'SUBMODULO'      => 0,
                                        'DESCRIPCION'    => $x->DESCRIPCION,
                                        'PARENT'         =>  -1
                              );
                    $i++;
                }
                foreach($submenu as $z) {
                      $arrMenu[]  = array(
                                        'ID'             => $i,
                                        'MODULO'         => 0,
                                        'SUBMODULO'      => $z->SUBMODULO,
                                        'DESCRIPCION'    => $z->DESCRIPCION,
                                        'PARENT'         => $z->MODULO
                                );
                      $i++;
                }      



    //             id: 1,
    // href: "#",
    // text: "Pedidos",
    // icon: "app_registration",
              return $this->getResponse(
                  [
                      'msg'        => 'SUCCESS',
                      'message'    => 'Menu recuperado con exito',
                      'menu'       => $arrMenu
                  ]
              );
    /*    } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar el Cliente para la ID especificada'
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