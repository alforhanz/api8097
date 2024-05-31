<?php namespace App\Models;

use CodeIgniter\Model;

class GetProcesarPedido_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA LISTA DE PEDIDOS
    //------------------------------------------------------------


   public function procesarPedido($pSistema=null,$pUsuario=null,$pOpcion=null,$pModulo=null,$pConsecutivoPed=null,$pArticulo=null,$pLineaConsec=null,$pLineaConteo=null,$pEstado=null,$pBodega=null)
    {
      try {
          $db = db_connect();
          $params = array($pSistema, $pUsuario, $pOpcion, $pModulo, $pConsecutivoPed, $pArticulo, $pLineaConsec, $pLineaConteo, $pEstado, $pBodega);
          $sql = "[CLSA].[WMS_sp_InsertUpdate_ControlEntrega] ?,?,?,?,?,?,?,?,?,?";
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