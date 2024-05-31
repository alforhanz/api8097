<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class MarcasVehiculo_Model extends Model
{
    public function findMarcasAll()
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getMarcasVehiculo]()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
  
    public function findMarcasById($id)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getMarcasVehiculo] ()}";
          $params = array($name,$pass); 
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
