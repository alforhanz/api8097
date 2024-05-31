<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Distritos_Model extends Model
{
    public function getDistritos($idProvincia=null)
    {
      try {
          $db = db_connect();
          $params = array($idProvincia);
          $sql = "CLSA.cr_GetDistrito ?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(getDistritos) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
