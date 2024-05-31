<?php namespace App\Models;

use CodeIgniter\Model;

class NorwingGetReportes_Model extends Model
{
   //------------------------------------------------------------
   //  MARGENES
   //------------------------------------------------------------
    public function sp_getDashboardNorwing_Gerencial($pSistema = null,$pUsuario = NULL, $pOpcion = null, $pFechaDesdeActual = null , $pFechaHastaActual = null, $pBodega = null, $pCategoria = null, $pVendedor = null)
    {
      try {
          $db = db_connect();
          $params = array($pSistema,$pUsuario,$pOpcion,$pFechaDesdeActual,$pFechaHastaActual,$pBodega,$pCategoria,$pVendedor);
          $sql = "ECOMMERCE.sp_getDashboardNorwing_Gerencial ?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //------------------------------------------------------------
   //  VENDEDORES
   //------------------------------------------------------------
    public function sp_DashboardNorwing($pTIPORPT = null,$pVendedor = NULL)
    {
      try {
          $db = db_connect();
          $params = array($pTIPORPT,$pVendedor);
          $sql = "ECOMMERCE.sp_getDashboardNorwing_Gerencial ?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
     //------------------------------------------------------------
   //  VENDEDORES
   //------------------------------------------------------------
    public function sp_getCategoriaVendedor($pCategoria = null,$pVendedor = NULL,$pBodega = NULL,$pOpcion = NULL)
    {
      try {
          $db = db_connect();
          $params = array($pCategoria,$pVendedor,$pBodega,$pOpcion);
          $sql = "CLSA.sp_getCategoriaVendedor ?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }

}