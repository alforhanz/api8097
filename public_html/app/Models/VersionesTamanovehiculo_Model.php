<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class VersionesTamanovehiculo_Model extends Model
{
    //-------------------------------------------------------------
    public function findVersionesTamanoByIds($tipo,$idmarca,$anio,$idmodelo)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getVersionTamanoVehiculo] (?,?,?,?)}";
          $params = array($tipo,$idmarca,$anio,$idmodelo); 
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
