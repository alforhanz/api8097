<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ModelosVehiculo_Model extends Model
{
    public function findModelosAll()
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getModeloVehiculo]()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
  
    public function findModelosById($idmarca,$anio)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getModeloVehiculo] (?,?)}";
          $params = array($idmarca,$anio); 
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
