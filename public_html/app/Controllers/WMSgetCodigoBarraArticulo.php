<?php

namespace App\Controllers;

use App\Models\WMSodenesDeCompras_Model;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class WMSgetCodigoBarraArticulo extends BaseController
{
    /**
     * Get a single client by ID
     */
    public function show_CodBars()
    {
        try {
            $model = new WMSodenesDeCompras_Model();
            //Definir los parametros
               
            $pCodigoBarra = !empty($_GET['pUsuario']) ? $_GET["pUsuario"] : null;
         
            $pArticulo = !empty($_GET['pBodega']) ? $_GET["pBodega"] : null;
            

            // Llama al procedimiento almacenado con los parámetros adecuados
            $ordenCompra = $model->sp_getOrdenesdeCompras($pCodigoBarra, $pArticulo);

            return $this->getResponse([
                'msg' => 'SUCCESS',
                'message' => 'Consulta recuperada con éxito',
                'ordenCompra' => $ordenCompra
            ]);
        } catch (Exception $e) {
            return $this->getResponse([
                'message' => 'No se pudo completar la consulta: ' . $e->getMessage()
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
