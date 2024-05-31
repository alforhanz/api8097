<?php namespace App\Models;

use CodeIgniter\Model;

class SeccionesModel extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA TIPO MODULO SECCIONES
    //------------------------------------------------------------
   public function findTipoById($id)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getTipo] (?)}";
          $params = array($id); 
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------
    //  BUSQUEDA SUBTIPO MODULO SECCIONES
    //------------------------------------------------------------
    public function findSubTipoById($id, $tipo)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getSubtipoD] (?,?)}";
          $params = array($id,$tipo); 
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------
    //  BUSQUEDA MODULO DE SECCIONES
    //------------------------------------------------------------
    public function BusquedaSecciones($categoria, $tipo, $subtipo, $subtipo2, $paginador, $ordenamiento, $bodega){
      try {
          $db = db_connect();
          $sql = "ECOMMERCE.sp_getSecciones ?,?,?,?,?,?,?";
          $params = array($categoria, $tipo, $subtipo, $subtipo2, $paginador, $ordenamiento, $bodega);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------
    //  PRECIO POR ARTICULO DEL VENDEDOR MODULO DE SECCIONES
    //------------------------------------------------------------
    public function precioArticulo($usuario, $articulo){
      try {
          $db = db_connect();
          $sql = "{CALL [CLSA].[sp_getPreciosVendedor](?,?,?)}";
          $params = array('V',$usuario,$articulo);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    


}