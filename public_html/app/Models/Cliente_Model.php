<?php namespace App\Models;

use CodeIgniter\Model;

class Cliente_Model extends Model
{
    //-------------------------------------------------------------------
    public function getBusquedaglobalClientes($pContribuyente,$pOpcion, $pCategoria, $tipoBusqueda,$pUser)
    {
    try {
          $db = db_connect();
          if($pOpcion == '2'){
          $params = array($pContribuyente,$pOpcion,$pCategoria, $tipoBusqueda,$pUser);
          }
          else {
            $params = array($pContribuyente." ",$pOpcion, $pCategoria, $tipoBusqueda,$pUser);
          }
          $sql = "CLSA.sp_BusquedaglobalClientes ?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //--------------------------------------------------------------------
    public function getEstadoDeCuenta_ClientesWeb($pTipoConsulta=null, $pCliente=null, $pFechaInicial=null, $pFechaFinal=null,$verHistoric=null,$AgruparCtaCorp=null)
    {
      try {
          $db = db_connect();
          $params = array($pTipoConsulta,$pCliente,$pFechaInicial,$pFechaFinal,$verHistoric,$AgruparCtaCorp);
          $sql = "CLSA.sp_getEstadoDeCuenta_ClientesWeb ?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query[0];
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------
    //  BUSQUEDA NIVEL DE PRECIO DEL CLIENTE
    //-------------------------------------------------------------
    public function sp_NivelPrecio_Cliente($pArticulo,$pNivelPrecio)
    {
      try {
        $db = db_connect();
        $params = array($pArticulo,$pNivelPrecio);
        $sql = "ECOMMERCE.sp_NivelPrecio_Cliente ?,?";
        $query = $db->query($sql, $params)->getResult();
        return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------
    //  BUSQUEDA NIT DEL CLIENTE
    //-------------------------------------------------------------
    public function sp_getClienteNit($pNit)
    {
    try {
          $db = db_connect();
          $params = array($pNit);
          $sql = "CLSA.sp_getClienteNit ?";
          $query = $db->query($sql,$params)->getResult();
          if($query)
          return true;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }  
    //-------------------------------------------------------------
    public function sp_updateCondi_PagoPedido($pPedido,$pCondicionPagoPedido)
    {
    try {
          $db = db_connect();
          $params = array($pPedido,$pCondicionPagoPedido);
          $sql = "ECOMMERCE.sp_updateCondi_PagoPedido ?,?";
          $query = $db->query($sql,$params)->getResult();
          if($query)
          return true;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }      

}