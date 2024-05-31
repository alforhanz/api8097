<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Vehiculo_Model extends Model
{

  
  public function findPernosAll()
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getCantidadPernos]()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //-----------------------------------------------------------------------------
    public function findPernosById()
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getCantidadPernos]()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //----------------------------------------------------------------------------
    public function findDistanciasAll()
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getDistanciaPernos]()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //-----------------------------------------------------------------------------
    public function findDistanciasById($pernos = null)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getDistanciaPernos](?)}";
          $params = array($pernos); 
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //-----------------------------------------------------------------------------
    public function findTamanoRinesAll()
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getTamanoRinPernos]()}";
          $query = $db->query($sql)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
     //-----------------------------------------------------------------------------
    public function findTamanoRinesById($pernos = null, $distancia = null)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getTamanoRinPernos](?,?)}";
          $params = array($pernos,$distancia); 
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }



  
}
