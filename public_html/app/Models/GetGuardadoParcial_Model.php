<?php namespace App\Models;

use CodeIgniter\Model;

class GetGuardadoParcial_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA LISTA DE PEDIDOS
    //------------------------------------------------------------
//Guardado parcial del pedido
   public function guardadoParcial($pSistema=null,$pUsuario=null,$pOpcion=null,$pModulo=null,$pConsecutivoPed=null,$pArticulo=null,$pLineaConsec=null,$pLineaConteo=null,$pEstado=null,$pBodega=null)
    {
      try {
          $db = db_connect();
          $params = array($pSistema, $pUsuario, $pOpcion, $pModulo, $pConsecutivoPed, $pArticulo, $pLineaConsec, $pLineaConteo, $pEstado, $pBodega);
          $sql = "CLSA.WMS_sp_InsertUpdate_ControlEntrega ?,?,?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }

    //Devolver
 public function devolverArticulo($pPedido=null,$pArticulo=null)
    {
      try {
          $db = db_connect();
          $params = array( $pPedido,$pArticulo);
          $sql = "CLSA.WMS_EliminaArticulo ?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }

      public function ActualizarFilasEliminadas($pSistema=null,$pUsuario=null,$pOpcion=null,$pModulo=null,$pConsecutivoPed=null,$pArticulo=null,$pLineaConsec=null,$pLineaConteo=null,$pEstado=null,$pBodega=null)
    {
      try {
          $db = db_connect();
          $params = array($pSistema, $pUsuario, $pOpcion, $pModulo, $pConsecutivoPed, $pArticulo, $pLineaConsec, $pLineaConteo, $pEstado, $pBodega);
          $sql = "CLSA.WMS_sp_InsertUpdate_ControlEntrega ?,?,?,?,?,?,?,?,?,?";
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