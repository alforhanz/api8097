<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Corregimientos_Model extends Model
{
    public function getCorregimientos($idDistrito=null)
    {
      try {
          $db = db_connect();
          $params = array($idDistrito);
          $sql = "CLSA.cr_GetCorregimiento ?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(getCorregimientos) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
