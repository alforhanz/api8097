<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Provincias_Model extends Model
{
    public function getProvincias()
    {
      try {
          $db = db_connect();
          $sql = "{CALL [CLSA].[cr_GetProvincia]()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(getProvincias) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
