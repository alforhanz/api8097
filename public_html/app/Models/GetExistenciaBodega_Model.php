<?php namespace App\Models;

use CodeIgniter\Model;

class GetExistenciaBodega_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
   //------------------------------------------------------------
    public function getExistenciaBodega($pArticulo = NULL)
    {
      try {
          $db = db_connect();
          $params = array($pArticulo);
          $sql = "ECOMMERCE.sp_getExistenciaBodega ?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(getExistenciaBodega) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
