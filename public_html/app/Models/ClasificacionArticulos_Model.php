<?php namespace App\Models;

use CodeIgniter\Model;

class ClasificacionArticulos_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
   //------------------------------------------------------------
    public function ObtenerClasificacionArticulos($pGrupo = NULL, $pDescripcion = NULL)
    {
      try {
          $db = db_connect();
          $params = array($pGrupo, $pDescripcion);
          $sql = "CLSA.sp_getClasificacionArticulos 'VIAGARA', 'WEB', ?, ?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(ObtenerClasificacionArticulos) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
