<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class GetArticulosBodega_Model extends Model
{
    public function getArticulosBodega()
    {
      try {
          $db = db_connect();
          $sql = "{CALL CLSA.sp_getArticulosBodega()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(getArticulosBodega) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
