<?php namespace App\Models;

use CodeIgniter\Model;

class WMSbusquedaArticulos_Model extends Model
{
    //------------------------------------------------------------
   //  BUSQUEDA DE ARTICULOS
  //------------------------------------------------------------

    //public function BusquedaConFiltros($pActivos = null, $pExistencia = null, $pArticulo = null, $pClase = null, $pMarca = null, $pUso = null, $pEnvase = null, $pBodega = null, $pTipoBodega = null)
   public function Busqueda($pActivos = null, $pExistencia = null, $pArticulo = null, $pClase = null, $pMarca = null, $pUso = null, $pEnvase = null, $pBodega = null, $pTipoBodega = null)
    {
      try {
          $db = db_connect();
          $params = array($pActivos,$pExistencia,$pArticulo,$pClase,$pMarca,$pUso,$pEnvase,$pBodega,$pTipoBodega);
          $sql = "CLSA.WMS_sp_getArticulosBodega ?,?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }

}
