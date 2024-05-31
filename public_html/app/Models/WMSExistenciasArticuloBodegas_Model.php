<?php namespace App\Models;

use CodeIgniter\Model;

class WMSExistenciasArticuloBodegas_Model extends Model
{   
    //------------------------------------------------------------
    //  CANTIDAD POR BODEGA
    //------------------------------------------------------------
    public function sp_getExistenciaBodega($p_Articulo,$p_Opcion)
    {
          $db = db_connect();
      try {
          $sql = "{CALL [ECOMMERCE].[sp_getExistenciaBodega] (?,?)}";
          $params = array($p_Articulo,$p_Opcion);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }

}
