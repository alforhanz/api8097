<?php namespace App\Models;

use CodeIgniter\Model;

class GetVerificacion_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA LISTA DE PEDIDOS
    //------------------------------------------------------------
   public function listaPedidos($pSistema=null, $pUsuario=null, $pOpcion=null, $pFechaDesde=null, $pFechaHasta=null, $pPedido=null, $pBodega=null, $pCliente=null, $pEstado=null)
    {
      try {
          $db = db_connect();
          $params = array($pSistema, $pUsuario, $pOpcion, $pFechaDesde, $pFechaHasta, $pPedido, $pBodega,$pCliente,$pEstado);
          $sql = "CLSA.WMS_sp_getPedidosEntrega ?,?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }
	 //------------------------------------------------------------
    //  DETALLE DE PEDIDO
    //------------------------------------------------------------
	 public function detallePedido($pDocumento=null, $pFechaDesde=null, $pFechaHasta=null, $pBodega=null)
    {
      try {
          $db = db_connect();
          $params = array($pDocumento, $pFechaDesde, $pFechaHasta, $pBodega);
          $sql = "CLSA.WMS_sp_getDetalle_ContEntrega ?,?,?,?";
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