<?php namespace App\Models;

use CodeIgniter\Model;

class verificarOrdenTaller_Model extends Model
{
    //------------------------------------------------------------
    //  VERIFICACION DE SERVICIOS EN PROCESO EN ORDEN DE TALLER
    //------------------------------------------------------------
   public function verificarOrdenTaller($pPedido)
    {
      try 
		{
          $db = db_connect();
          // Utilizar el parámetro $pPedido en la consulta SQL usando el binding de CodeIgniter
          $sql = "SELECT ORDEN_TALLER FROM CLSA.ORDEN_TALLER WHERE PEDIDO=?";
          $query = $db->query($sql, [$pPedido])->getResult();
		  $query[0]->ORDEN_TALLER;
          $db->close();
          
			// Verificar si se obtuvieron resultados
			if (!empty($query)) 
			{
              return $query;
			} else 
				{
					return "No se encontraron resultados";
				}
		} catch (Exception $e) 
			{
			  die($e->getMessage());
			  return "";
			}
	}
	
	 public function sp_validaarticuloanuladotaller($pPedido,$pLinea,$pArticulo)
    {
		   try {
			$db = db_connect();
			$params = array($pPedido, $pLinea, $pArticulo);
			$sql = "ECOMMERCE.sp_ValidaArticuloAnuladoTaller ?,?,?";
			$query = $db->query($sql, $params)->getResult();
			$db->close(); // Cierra la conexión antes de retornar los resultados
			return $query[0]->LINEA_TALLER_ANULADO;
		} catch (Exception $e) {
			die('Error GlobalModel() ' . $e->getMessage());
			return "";
		}
    }
}