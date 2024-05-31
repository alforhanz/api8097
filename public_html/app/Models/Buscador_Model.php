<?php namespace App\Models;

use CodeIgniter\Model;

class Buscador_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
   //------------------------------------------------------------
    public function Busqueda($pTIPORPT = null,$pTIPOCLASE = NULL, $particulo = null, $bodega = null , $pTipoProd = null)
    {
      try {
          $db = db_connect();
          $params = array($pTIPORPT,$pTIPOCLASE,$particulo,$bodega,$pTipoProd);
          $sql = "ECOMMERCE.sp_getArticulos ?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
	//------------------------------------------------------------
   //  BUSQUEDA IMPUESTO PRODUCTO
   //------------------------------------------------------------
	 public function BusquedaImpuesto($pTIPORPT = null,$pTIPOCLASE = NULL, $particulo = null, $bodega = null)
    {
      try {
          $db = db_connect();
          $params = array($pTIPORPT,$pTIPOCLASE,$particulo,$bodega);
          $sql = "ECOMMERCE.sp_getimpuestoArticulo ?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }

    public function BusquedaConFiltros($pActivos = null, $pExistencia = null, $pArticulo = null, $pClase = null, $pMarca = null, $pUso = null, $pEnvase = null, $pBodega = null, $pTipoBodega = null)
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