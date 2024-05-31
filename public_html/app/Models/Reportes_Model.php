<?php namespace App\Models;

use CodeIgniter\Model;

class Reportes_Model extends Model
{
    //------------------------------------------------------------
    //  PRECIO POR ARTICULO DEL VENDEDOR
    //------------------------------------------------------------
    public function sp_getPreciosVendedor($usuario, $articulo){
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
    //------------------------------------------------------------
    //  PRECIO POR ARTICULO DEL VENDEDOR
    //------------------------------------------------------------
    public function sp_getUltimasComprasCliente($pUsuario, $pTipoConsulta, $pCliente, $pArticulo=null, $pFactura=null){
      try {
          $db = db_connect();
          $sql = "CLSA.sp_getUltimasComprasCliente ?,?,?,?,?";
          $params = array($pUsuario, $pTipoConsulta, $pCliente, $pArticulo, $pFactura);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------
    //  CANTIDAD POR BODEGA
    //------------------------------------------------------------
    public function sp_getExistenciaBodega($articulo,$p_Opcion)
    {
          $db = db_connect();
      try {
          $sql = "{CALL [ECOMMERCE].[sp_getExistenciaBodega] (?,?)}";
          $params = array($articulo,$p_Opcion);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }


}
