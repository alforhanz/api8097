<?php namespace App\Models;

use CodeIgniter\Model;

class GetEncuestas_Model extends Model
{
    //Verifica que haya encuestas activas
   public function sp_get_encuestas_web($pUsuario=null,$pEncuesta=null,$pTipoCliente=null)
    {
      try {
          $db = db_connect();
          $params = array($pUsuario,$pEncuesta,$pTipoCliente);
          $sql = "CLSA.sp_get_encuestas_web ?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }

    //Consulta las preguntas activas
   public function sp_getPreguntasEncuestas($pUsuario=null,$pEncuesta=null,$pOpcion=null)
    {
      try {
          $db = db_connect();
          $params = array($pUsuario,$pEncuesta,$pOpcion);
          $sql = "CLSA.sp_getPreguntasEncuestas ?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }

    //Consulta las opciones activas
   public function sp_getOpcionesPreguntaEncuesta($pUsuario=null,$pEncuesta=null,$pPregunta=null,$pEstado=null)
    {
      try {
          $db = db_connect();
          $params = array($pUsuario,$pEncuesta,$pPregunta,$pEstado);
          $sql = "CLSA.sp_getOpcionesPreguntaEncuesta ?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }

    //Consulta las opciones activas
   public function sp_insert_Encuestas($pUsuario=null,$pTipoEncuesta=null,$pEncuesta=null,$pPregunta=null,$pRespuesta=null,$pIdTemporal=null,$pedido=null)
    {
      try {
          $db = db_connect();
          $params = array($pUsuario,$pTipoEncuesta,$pEncuesta,$pPregunta,$pRespuesta,$pIdTemporal,$pedido);
          $sql = "CLSA.sp_insert_Encuestas ?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die($e->getMessage());
          return "";
      }
    }

     //Consulta si el Pedido ya existe
   public function sp_getEncuestas($pUsuario=null,$pTipoEncuesta=null,$pEncuesta=null,$pPregunta=null,$pRespuesta=null,$pIdTemporal=null)
    {
      try {
          $db = db_connect();
          $params = array($pUsuario,$pTipoEncuesta,$pEncuesta,$pPregunta,$pRespuesta,$pIdTemporal);
          $sql = "CLSA.sp_getEncuestas ?,?,?,?,?,?";
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