<?php namespace App\Models;

use CodeIgniter\Model;

class Pedidos_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
    //------------------------------------------------------------
   public function reportePedidos($pTipoConsulta=null, $pPedido=null, $pEstado=null, $pFechaInicial=null, $pFechaFinal=null, $pUser=null, $pBodega=null, $pCliente=null)
    {
      try {
          $db = db_connect();
          $params = array($pTipoConsulta, $pPedido, $pEstado, $pFechaInicial, $pFechaFinal, $pUser, $pBodega,$pCliente);
          $sql = "ECOMMERCE.sp_getBusquedaPedidosWeb ?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }
    //-------------------------------------------------------------
    public function sp_getExistenciaArticuloBodega($pArticulo,$pOpcion,$pBodega)
    {
      try {
          $db = db_connect();
          $retorno = "";
          $params = array($pArticulo,$pOpcion,$pBodega);
          $sql = "{call ECOMMERCE.sp_getExistenciaBodega (?,?,?)}";
          $query = $db->query($sql,$params);
          foreach ($query->getResult() as $row) {
              $retorno = $row->CANTIDAD;
          }
          return $retorno;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel() '.$e->getMessage());
          return "";
      }finally{
        $query = null;
      }
    }
    //-------------------------------------------------------------
    public function sp_PEDIDOS_WEB_ONLINE_PEDIDO($pUser=null)
    {
      try {
          $db = db_connect();
          $params = array($pUser);
          $sql = "CLSA.SP_PEDIDOS_WEB_ONLINE_PEDIDO ?,?,?,?,?,?,?,?,?,?,?,?,?,?";
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
    public function sp_getCONSECUFA_USUARIO($pUser=null)
    {
      try {
          $db = db_connect();
          $params = array($pUser);
          $sql = "ECOMMERCE.sp_getCONSECUFA_USUARIO ?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }
    //-------------------------------------------------------------
    public function sp_PEDIDOS_WEB_ONLINE_CONSECUTIVO_PEDIDO($num_cons=null)
    {
      try {
          $db = db_connect();
          $params = array($num_cons);
          $sql = "ECOMMERCE.SP_PEDIDOS_WEB_ONLINE_CONSECUTIVO_PEDIDO ?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel() '.$e->getMessage());
          return "";
      }finally{
        $query = null;
      }
    }
    //-------------------------------------------------------------
    public function sp_InsertPedidoEcommerce($pUser,$pCliente,$pBodega,$pOrdenCompra,$pObserv,$pTarjetaCredito,$pNombreCuenta,$pPedido,$pSubtotal,$pImpuesto,$pTotal,$pTotalUnidades,$pCondicionPago,$pFechaEntrega,$pPromocion,$pTipoSistema,$pTipoDocumento)
    {
      try {
          $db = db_connect();
          $params = array($pUser,$pCliente,$pBodega,$pOrdenCompra,$pObserv,$pTarjetaCredito,$pNombreCuenta,$pPedido,$pSubtotal,$pImpuesto,$pTotal,$pTotalUnidades,$pCondicionPago,$pFechaEntrega,$pPromocion,$pTipoSistema,$pTipoDocumento);
          $sql = "CLSA.sp_InsertPedidoEcommerce ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query[0]->RESPUESTA;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel() '.$e->getMessage());
          return "";
      }finally{
        $query = null;
      }
    }
     //-------------------------------------------------------------
    public function sp_InsertPedido_LineaEcommerce($pPedido, $pPedidoLinea,$pArticulo,$pPrecio,$pCantidad,$pDescuento,$pNivelPrecio,$pUser,$pBodega,$pFechaEntrega,$pSubtotal,$pImpuesto,$pTotal,$pTotalUnidades,$pTipoDocumento,$estadodocumento,$pObserv)
    {
      try {
          $db = db_connect();
          $params = array($pPedido, $pPedidoLinea,$pArticulo,$pPrecio,$pCantidad,$pDescuento,$pNivelPrecio,$pUser,$pBodega,$pFechaEntrega,$pSubtotal,$pImpuesto,$pTotal,$pTotalUnidades,$pTipoDocumento,$estadodocumento,$pObserv);
          $sql = "ECOMMERCE.sp_InsertPedido_LineaEcommerce ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query[0]->RESPUESTA;
          $query->free_result();  
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel() '.$e->getMessage());
          return "";
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------------------------------------------------
     public function sp_borrar_pedido_linea($pPedido,$pArticulo, $pPedidoLinea)
    {
      try {
          $db = db_connect();
          $params = array($pPedido,$pArticulo, $pPedidoLinea);
          $sql = "ECOMMERCE.SP_BORRAR_PEDIDO_LINEA ?,?,?";
          $query = $db->query($sql,$params)->getResult();
          // return $query[0]->ACCION; 
		  return $query[0]->ACCION; 
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel() '.$e->getMessage());
          return "";
      }finally{
        $query = null;
      }
    }
	 //------------------------------------------------------------------------------------------------------
     public function sp_delete_articulo_orden_taller($pPedido,$pArticulo,$pPedidoLinea,&$pRespuesta)
    {
      try {
          $db = db_connect();
          $params = array($pPedido,$pPedidoLinea,$pArticulo,$pRespuesta);
          $sql = "ECOMMERCE.sp_Delete_ArticuloOrdenTallerLinea ?,?,?,?"; 
          $query = $db->query($sql,$params)->getResult();
          // return $query[0]->ACCION; 
		  return $query[0]->APLICADO; 
          $query->free_result();  
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel() '.$e->getMessage());
          return "";
      }finally{
        $query = null;
      }
    }
//------------------------------------------------------------------------------------------------------
    public function sp_getimpuestoArticulo($pArticulo)
    {
      try {
          $db = db_connect();
          $params = array($pArticulo);
          $sql = "ECOMMERCE.sp_getimpuestoArticulo ?";
          $query = $db->query($sql,$params)->getResult();
          return $query[0]->impuesto;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel() '.$e->getMessage());
          return "";
      }finally{
        $query = null;
      }
    }
	
	 //-------------------------CREAR ORDEN DE TALLER ------------------------------------
    public function sp_Insert_OrdenTallerDesdeCLSAWEB($pSistema,$pUser,$pOpcion,$pPedido,&$pRespuesta)
    {
          $db = db_connect();
          $params = array($pSistema,$pUser,$pOpcion,$pPedido, $pRespuesta);
          // $sql = "CLSA.sp_Insert_OrdenTallerDesdeCLSAWEB ?,?,?,?,@pRespuesta";
		  $sql = "CLSA.sp_Insert_OrdenTallerDesdeCLSAWEB ?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          $db->close();
		  return  $query[0]->RESPUESTA;  
    }
    //------------------------------------------------------------------------------------------------------

}