<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Menu_Model extends Model
{
    //-------------------------------------------------------------
    public function sp_getModulosUsuario($pUsuario,$pTipoSistema,$pTipoMenu=null)
    {
      try {
          $db = db_connect();
          $sql = "CLSA.sp_getModulosUsuario ?,?,?";
          $params = array($pUsuario,$pTipoSistema,$pTipoMenu); 
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
      public function sp_getPrivilegiosModulosUsuario($pUsuario,$pTipoSistema,$pModulo=null)
    {
      try {
          $db = db_connect();
          $sql = "CLSA.sp_getPrivilegiosModulosUsuario ?,?,?";
          $params = array($pUsuario,$pTipoSistema,$pModulo); 
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

}
