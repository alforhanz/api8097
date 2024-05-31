<?php namespace App\Models;

use CodeIgniter\Model;

class GetInformeVentaFacturador_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
   //------------------------------------------------------------
    public function GetInformeVentaFacturador($pFacturador = NULL, $pTipo = NULL, $pResultado = NULL)
    {
      try {
          $db = db_connect();
          $params = array($pFacturador, $pTipo, $pResultado);
          $sql = "ECOMMERCE.sp_getInformeVentaFacturador ?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          //return $params;
      } catch (Exception $e) {
          die('Error GlobalModel(GetInformeVentaFacturador) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
