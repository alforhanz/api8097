<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class AnioVehiculo_Model extends Model
{
    //-------------------------------------------------------------
    public function findAnioAll()
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getAnioVehiculo]()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
          $query = null;
      }
    }
    //-------------------------------------------------------------
    public function findAnioById($idmarca)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getAnioVehiculo] (?)}";
          $params = array($idmarca); 
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
          $query = null;
      }
    }
    //-------------------------------------------------------------
}
