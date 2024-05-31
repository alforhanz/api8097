<?php namespace App\Models;

use CodeIgniter\Model;

class Servicios_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
   //------------------------------------------------------------
    public function BusquedaServicios($pTIPORPT = null,$pTIPOCLASE = NULL, $particulo = null)
    {
      try {
          $db = db_connect();
          $params = array($pTIPORPT,$pTIPOCLASE,$particulo);
          $sql = "ECOMMERCE.sp_getArticulos ?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}