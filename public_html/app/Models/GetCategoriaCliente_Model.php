<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class GetCategoriaCliente_Model extends Model
{
    public function getCategoriaCliente()
    {
      try {
          $db = db_connect();
          $sql = "{CALL CLSA.sp_getCategoriaCliente()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(getCategoriaCliente) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
