<?php namespace App\Models;

use CodeIgniter\Model;

class GetImpuesto_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA TIPO MODULO SECCIONES
    //------------------------------------------------------------
   public function GetImpuestoById($id)
    {
      try {
          $db = db_connect();
          $sql = "ECOMMERCE.sp_getimpuestoArticulo ?";
          $params = array($id); 
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }

}