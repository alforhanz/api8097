<?php namespace App\Models;

use CodeIgniter\Model;

class DetalleProducto_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
    //------------------------------------------------------------
   public function BusquedaDetalle($tipoConsulta=null, $clase=null, $articulo=null,$pbodega=null, $pTipoProd=null )
    {
      try {
          $db = db_connect();
          $sql = "ECOMMERCE.sp_getArticulos ?,?,?,?,?";
          $params = array($tipoConsulta, $clase, $articulo,$pbodega,$pTipoProd);
          //$params = array('W', null, 'RIN 18 T1032 10H BF');
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
	//------------------------------------------------------------
    //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
    //------------------------------------------------------------
   public function BusquedaITBMS($articulo=null)
    {
      try {
          $db = db_connect();
          $sql = "ECOMMERCE.sp_getimpuestoArticulo ?";
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
    //  BUSQUEDA EXISTENCIA DE BODEGA MODULO DE DETALLEPRODUCTO
    //------------------------------------------------------------
    public function existenciaBodega($articulo, $p_Opcion)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [ECOMMERCE].[sp_getExistenciaBodega] (?,?)}";
          $params = array($articulo, $p_Opcion);
          $query = $db->query($sql, $params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------
    //  BUSQUEDA EXISTENCIA DE BODEGA MODULO DE DETALLEPRODUCTO
    //------------------------------------------------------------
    public function DetalleFiltros($articulo)
    {
      try {
        $db = db_connect();
        $sql = "ECOMMERCE.sp_ObtnerDetalleFiltro ?";
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
    //  BUSQUEDA EXISTENCIA DE BODEGA MODULO DE DETALLEPRODUCTO
    //-------------------------------------------------------------
    public function DetalleSelloFiltros($articulo)
    {
      try {
        $db = db_connect();
        $sql = "{CALL [ECOMMERCE].[sp_ObtnerSelloFiltro] (?)}";
        $params = array($articulo);
        $query = $db->query($sql, $params)->getResult();
        return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
 

}