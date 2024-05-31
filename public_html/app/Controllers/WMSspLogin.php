<?php

namespace App\Controllers;

use App\Models\WMSspLogin_Model;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class WMSspLogin extends BaseController
{
    /**
     * Get a single client by ID
     */
    public function login()
    {
        try {
            $model = new WMSspLogin_Model();            

            // Define otros parámetros según sea necesario
            $pUsuario = !empty($_GET['pUsuario']) ? $_GET["pUsuario"] : null;
            $pClave = !empty($_GET['pClave']) ? $_GET["pClave"] : null;
           
            // Llama al procedimiento almacenado con los parámetros adecuados
            $respuesta = $model->sp_Login($pUsuario, $pClave);

            return $this->getResponse(
                [
                    'msg' => 'SUCCESS',
                    'message' => 'Consulta recuperada con éxito',
                    'respuesta' => $respuesta
                ]
        );
        } catch (Exception $e) {
            return $this->getResponse([
                'message' => 'No se pudo completar la consulta: ' . $e->getMessage()
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}