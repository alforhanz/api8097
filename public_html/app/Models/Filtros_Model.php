<?php namespace App\Models;

use CodeIgniter\Model;

class Filtros_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA DE FILTROS MODULO DE FILTROS
    //------------------------------------------------------------
    public function BusquedaFiltros($articulo=null, $existencia=null)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_ObtenerFiltros] (?,?)}";
          $params = array($articulo, $existencia);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------
    //  BUSQUEDA FILTROS DE INTERCAMBIO MODULO DE FILTRO
    //------------------------------------------------------------ 
    public function BusquedaFiltrosIntercambios($articulo=null)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_ObtenerFiltrosIntercambio] (?)}";
          $params = array($articulo);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
     //------------------------------------------------------------
    //  BUSQUEDA FILTROS DE CRUZADO MODULO DE FILTRO
    //------------------------------------------------------------
    public function BusquedaFiltrosCruzado($articulo=null, $bodega=null)
    {
      try {
          $db = db_connect();
          $sql = "ECOMMERCE.sp_ObtenerFiltrosCruzados ?,?";
          $params = array($articulo,$bodega );
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }

}