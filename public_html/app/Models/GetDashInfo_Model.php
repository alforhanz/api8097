<?php namespace App\Models;

use CodeIgniter\Model;

class GetDashInfo_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA DE VALORES PARA DASHBOARD WMS
    //------------------------------------------------------------
    public function GetDashInfo($pUsuario=null)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [CLSA].[SP_valores_Dashboard] (?)}";
          $params = array($pUsuario);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
   
}