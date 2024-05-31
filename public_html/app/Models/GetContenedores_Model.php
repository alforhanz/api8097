<?php namespace App\Models;

use CodeIgniter\Model;

class GetContenedores_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA Y DETALLE DE CONTENEDORES
    //------------------------------------------------------------
   public function spContenedores($pSistema=null, $pUsuario=null, $pOpcion=null, $pBodegaEnvia=null, $pBodegaSolicita=null, $pConsecutivo=null, $pEstado=null, $pFechaDesde=null, $pFechaHasta=null)
    {
      try {
          $db = db_connect();
          $params = array($pSistema, $pUsuario, $pOpcion,$pBodegaEnvia,$pBodegaSolicita,$pConsecutivo ,$pEstado, $pFechaDesde, $pFechaHasta);
          $sql = "CLSA.WMS_sp_getTrasladoContenedorWeb ?,?,?,?,?,?,?,?,?";
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
    //  GUARDA LA LECTURA DE LOS CONTENEDORES
    //------------------------------------------------------------
   //public function spGuardaCont($pSistema=null, $pUsuario=null, $pOpcion=null, $pModulo=null, $pConsecutivo=null, $pArticulo=null, $pLineaConsec=null, $pLineaConteo=null, $pEstado=null, $pBodega=null)
     public function spGuardaCont($pSistema=null, $pUsuario=null, $pOpcion=null, $pModulo=null, $pConsecutivo=null, $pArticulo=null, $pLineaConsec=null, $pLineaConteo=null)
    {
      try {
          $db = db_connect();
          //$params = array($pSistema, $pUsuario, $pOpcion, $pModulo,$pConsecutivo,$pArticulo ,$pLineaConsec, $pLineaConteo, $pEstado, $pBodega);
          $params = array($pSistema, $pUsuario, $pOpcion, $pModulo,$pConsecutivo,$pArticulo ,$pLineaConsec, $pLineaConteo);
          //$sql = "CLSA.WMS_sp_InsertUpdate_ControlEntrega_Contenedor ?,?,?,?,?,?,?,?,?,?";
          $sql = "CLSA.WMS_sp_InsertUpdate_ControlEntrega_Contenedor ?,?,?,?,?,?,?,?";
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