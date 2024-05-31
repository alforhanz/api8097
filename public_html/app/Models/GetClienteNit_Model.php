<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class GetClienteNit_Model extends Model
{
    public function GetClienteNit($nit=null)
    {
      try {
          $db = db_connect();
          $params = array($nit);
          $sql = "CLSA.sp_getClienteNit ?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(GetClienteNit) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
