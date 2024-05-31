<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class WMSspLogin_Model extends Model
{
    //------------------------------------------------------------
    //  Login de usuario en el WMS
    //------------------------------------------------------------
    public function sp_Login($pUsuario, $pClave)
    {
        try {
            $db = db_connect();
            $sql = "{CALL [CLSA].[sp_Login] (?,?)}";
            $params = array($pUsuario, $pClave);
            $query = $db->query($sql, $params)->getResult();
            return $query;
        } catch (Exception $e) {
            throw new Exception('Error al ejecutar el procedimiento almacenado: ' . $e->getMessage());
        }
    }
}
