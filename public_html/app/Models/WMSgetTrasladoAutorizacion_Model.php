<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class WMSgetTrasladoAutorizacion_Model extends Model
{
    //------------------------------------------------------------
    //  CANTIDAD POR BODEGA
    //------------------------------------------------------------
    public function sp_getTrasladoAutorizacion($pSistema, $pUsuario, $pOpcion, $pPantalla, $pUserAutorizado, $pIdControl)
    {
        try {
            $db = db_connect();
            $sql = "{CALL [CLSA].[sp_getTrasladoAutorizacion] (?,?,?,?,?,?)}";
            $params = array($pSistema, $pUsuario, $pOpcion, $pPantalla, $pUserAutorizado, $pIdControl);
            $query = $db->query($sql, $params)->getResult();
            return $query;
        } catch (Exception $e) {
            throw new Exception('Error al ejecutar el procedimiento almacenado: ' . $e->getMessage());
        }
    }
}
