<?php namespace App\Models;

use CodeIgniter\Model;

class GetDescuentos_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA DESCUENTO LUBRICANTES
    //------------------------------------------------------------
   public function getDescuentoLubricantes($pUsuario=null, $pPromocion=null, $pTipoVenta=null, $pArticulo=null, $pClase=null, $pMarca=null, $pNivelPrecio=null, $pTipo=null, $pUnidad=null, $pPrecio=null, $pCantidad=null,$pPedido=null, $pXmlData=null)
    {
      try {
          $db = db_connect();
          $params = array($pUsuario, $pPromocion, $pTipoVenta, $pArticulo, $pClase, $pMarca, $pNivelPrecio,$pTipo,$pUnidad,$pPrecio,$pCantidad,$pPedido,$pXmlData);
          $sql = "CLSA.sp_get_Descuentos_promociones_lubricantes_porArticulo ?,?,?,?,?,?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }
}