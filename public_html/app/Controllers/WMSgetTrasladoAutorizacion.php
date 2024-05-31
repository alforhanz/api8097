<?php

namespace App\Controllers;

use App\Models\WMSgetTrasladoAutorizacion_Model;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class WMSgetTrasladoAutorizacion extends BaseController
{
    /**
     * Get a single client by ID
     */
    public function show()
    {
        try {
            $model = new WMSgetTrasladoAutorizacion_Model();
            $pSistema = "WMS"; 

            // Define otros parámetros según sea necesario
            $pUsuario = !empty($_GET['pUsuario']) ? $_GET["pUsuario"] : null;
            $pOpcion = !empty($_GET['p_Opcion']) ? $_GET["p_Opcion"] : null;
            $pPantalla = !empty($_GET['pPantalla']) ? $_GET["pPantalla"] : null;
            $pUserAutorizado = !empty($_GET['pUserAutorizado']) ? $_GET["pUserAutorizado"] : null;
            $pIdControl = !empty($_GET['pIdControl']) ? $_GET["pIdControl"] : null;

            // Llama al procedimiento almacenado con los parámetros adecuados
            $respuesta = $model->sp_getTrasladoAutorizacion($pSistema, $pUsuario, $pOpcion, $pPantalla, $pUserAutorizado, $pIdControl);

            return $this->getResponse([
                'msg' => 'SUCCESS',
                'message' => 'Consulta recuperada con éxito',
                'respuesta' => $respuesta
            ]);
        } catch (Exception $e) {
            return $this->getResponse([
                'message' => 'No se pudo completar la consulta: ' . $e->getMessage()
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
