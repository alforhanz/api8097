<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Clasificaciones_Model extends Model
{
    public function findClasificacionesAll()
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[get_Clasificaciones]()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
  
}
