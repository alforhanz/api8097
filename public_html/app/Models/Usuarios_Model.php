<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Usuarios_Model extends Model
{
    public function BodegasUsuarios($sistema=null, $usuario=null,$bodega=null,$grupo=null)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [CLSA].[sp_getBodegasUsuario](?,?,?,?)}";
          $params = array($sistema, $usuario,$bodega,$grupo);  

          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
  
    
}
