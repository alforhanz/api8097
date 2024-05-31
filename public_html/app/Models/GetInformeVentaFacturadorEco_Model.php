<?php namespace App\Models;

use CodeIgniter\Model;

class GetInformeVentaFacturadorEco_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
   //------------------------------------------------------------
    public function GetInformeVentaFacturadorEco($pFacturador = NULL, $pTipo = NULL, $pResultado = NULL)
    {
      try {
          $db = db_connect();
          $params = array($pFacturador, $pTipo, $pResultado);
          $sql = "ECOMMERCE.sp_getInformeVentaFacturadorEco ?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          //return $params;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel(GetInformeVentaFacturadorEco) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
