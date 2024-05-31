<?php namespace App\Models;

use CodeIgniter\Model;

class FitrarMarcas_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
   //------------------------------------------------------------
    public function FiltrarMarcasClases($pClase = NULL)
    {
      try {
          $db = db_connect();
          $params = array($pClase);
          $sql = "ECOMMERCE.sp_getMarca ?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(FiltrarMarcasClases) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
