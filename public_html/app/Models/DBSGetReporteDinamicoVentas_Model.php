<?php namespace App\Models;

use CodeIgniter\Model;

class DBSGetReporteDinamicoVentas_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA DESCUENTO LUBRICANTES
    //------------------------------------------------------------
   //public function sp_RptVentasDinamicoComparativo_Web($pSistema=null, $pUsuario=null, $pOpcion=null, $pTipoRpt=null, $pGrupo1=null, $pGrupo1Campos=null, $pGrupo2=null, $pGrupo2Campos=null, $pFechaIniActual=null, $pFechaFinActual=null, $pFechaIniAnterior=null, $pFechaFinAnterior=null, $pCategoria=null, $pCategoriaVendedor=null, $pVendedor=null, $pTipoBodega=null, $pBodega=null, $pClase=null, $pMarca=null, $pTipo=null, $pSubtipo=null, $pSubtipo2=null, $pEnvase=null, $pXmlAgrupaMultiple=null,$pColumnasOrdenado=null)
      public function sp_RptVentasDinamicoComparativo_Web($pSistema=null, $pUsuario=null, $pOpcion=null, $pXmlAgrupaMultiple=null)
    {
      try {
          $db = db_connect();
          //$params = array($pSistema, $pUsuario, $pOpcion, $pTipoRpt, $pGrupo1, $pGrupo1Campos,$pGrupo2,$pGrupo2Campos,$pFechaIniActual,$pFechaFinActual,$pFechaIniAnterior,$pFechaFinAnterior,$pCategoria,$pCategoriaVendedor,$pVendedor,$pTipoBodega,$pBodega,$pClase,$pMarca,$pTipo,$pSubtipo,$pSubtipo2,$pEnvase,$pXmlAgrupaMultiple,$pColumnasOrdenado);
          $params = array($pSistema, $pUsuario, $pOpcion, $pXmlAgrupaMultiple);
          //$sql = "CLSA.sp_RptVentasDinamicoComparativo_Web ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
          $sql = "CLSA.sp_RptVentasDinamicoComparativo_Web ?,?,?,?";
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