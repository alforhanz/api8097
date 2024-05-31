<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class GetRutas_Model extends Model
{
    public function GetRutas()
    {
      try {
          $db = db_connect();
          $sql = "{CALL CLSA.sp_getRutas()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(GetRutas) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
