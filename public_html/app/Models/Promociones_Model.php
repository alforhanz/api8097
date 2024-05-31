<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Promociones_Model extends Model
{
    //-------------------------------------------------------------
    public function sp_get_promociones_web($pUser,$pClase,$IdPromo,$pValidaPrecio,$pSistema)
    {
      try {
          $db = db_connect();
          $sql = "ECOMMERCE.sp_get_promociones_web ?,?,?,?,?";
          $params = array($pUser,$pClase,$IdPromo,$pValidaPrecio,$pSistema); 
          $query = $db->query($sql, $params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
          $query = null;
      }
    }
    //-------------------------------------------------------------
    public function sp_getPromocionesArticulos($pIdPromocion,$pOpcion,$pArticulo)
    {
      try {
          $db = db_connect();
          $sql = "ECOMMERCE.sp_getPromocionesArticulos ?,?,?";
          $params = array($pIdPromocion,$pOpcion,$pArticulo); 
          $query = $db->query($sql, $params)->getResult();

          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
          $query = null;
      }
    }
    //-------------------------------------------------------------
    public function sp_getPromocionesCombos($pIdPromocion,$pClase)
    {
      try {
          $db = db_connect();
          $sql = "CLSA.sp_getPromocionesCombos ?,?,?";
          $params = array($pIdPromocion,$pClase); 
          $query = $db->query($sql, $params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
          $query = null;
      }
    }
     //-------------------------------------------------------------

}
