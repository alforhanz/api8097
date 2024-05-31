<?php namespace App\Models;

use CodeIgniter\Model;

class GetDevolverArticulo_Model extends Model
{
    //------------------------------------------------------------
    //  DEVUELVE UN ARTICULO DEL PEDIDO
    //------------------------------------------------------------

    //Devolver
 public function devolverArticulo($pPedido=null,$pArticulo=null)
    {
      try {
          $db = db_connect();
          $params = array( $pPedido,$pArticulo);
          $sql = "[CLSA].[WMS_EliminaArticulo] ?,?";
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