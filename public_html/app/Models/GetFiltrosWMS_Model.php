<?php namespace App\Models;

use CodeIgniter\Model;

class GetFiltrosWMS_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA DE FILTROS PARA WMS
    //------------------------------------------------------------
    public function GetFiltros($existencia = null,$clase = null,$marca = null,$tipo = null,$subtipo = null,$subtipo2 = null,$envase = null)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [CLSA].[WMS_sp_getFiltroClasificaciones] (?,?,?,?,?,?,?)}";
          $params = array($existencia,$clase,$marca,$tipo,$subtipo,$subtipo2,$envase);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}