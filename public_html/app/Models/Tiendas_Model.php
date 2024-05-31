<?php namespace App\Models;

use CodeIgniter\Model;

class Tiendas_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
   //------------------------------------------------------------
    public function ObtenerTiendas($pUser = null)
    {
      try {
          $db = db_connect();
          $params = array($pUser);
          $sql = "CLSA.cr_ObtenerBodegaUsuario ?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
