<?php namespace App\Models;

use CodeIgniter\Model;

class VentasArticuloPorCliente_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
   //------------------------------------------------------------
    public function ObtenerArticuloPorCliente($pFechaini = NULL, $pFechafin = NULL, $pClase = NULL, $pMarca = NULL, $pArticulo = NULL, $pCodeClient = NULL)
    {
      try {
          $db = db_connect();
          $params = array($pFechaini, $pFechafin, $pClase, $pMarca, $pArticulo,$pCodeClient);
          $sql = "ECOMMERCE.sp_VentasArticuloPorCliente ?,?,NULL,?,?,?,?,NULL";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          //return $params;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}
