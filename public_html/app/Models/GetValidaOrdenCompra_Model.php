<?php namespace App\Models;

use CodeIgniter\Model;

class GetValidaOrdenCompra_Model extends Model
{
   //------------------------------------------------------------
   //  COMPROBACION ORDEN DE COMPRA YA EXISTE
   //------------------------------------------------------------
    public function GetValidaOrdenCompra($pCliente = NULL, $pOrdenCompra = NULL)
    {
      try {
          $db = db_connect();
          $params = array($pCliente, $pOrdenCompra);
          $sql = "CLSA.sp_ValidaOrdenCompra ?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query[0]->EXISTE_ORDEN_COMPRA;
          //return $params;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel(GetValidaOrdenCompra) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
