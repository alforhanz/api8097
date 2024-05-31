<?php
namespace App\Controllers;

use App\Models\DBSGetReporteDinamicoVentas_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class DBSGetReporteDinamicoVentas extends BaseController
{
    protected $format = 'json';

    public function index()
    {
            $model = new DBSGetReporteDinamicoVentas_Model();
            $msg ="";
            if(!empty($_GET['pSistema'])) {$pSistema = $_GET["pSistema"];}else {$pSistema = null;}
            if(!empty($_GET['pUsuario'])) {$pUsuario = $_GET["pUsuario"];}else {$pUsuario = null;}
            if(!empty($_GET['pOpcion'])) {$pOpcion = $_GET["pOpcion"];}else {$pOpcion = null;}
			//if(!empty($_GET['pTipoRpt'])) {$pTipoRpt = $_GET["pTipoRpt"];}else {$pTipoRpt = null;}
			//if(!empty($_GET['pGrupo1'])) {$pGrupo1 = $_GET["pGrupo1"];}else {$pGrupo1 = null;}
			//if(!empty($_GET['pGrupo1Campos'])) {$pGrupo1Campos = $_GET["pGrupo1Campos"];}else {$pGrupo1Campos = null;}
			//if(!empty($_GET['pGrupo2'])) {$pGrupo2 = $_GET["pGrupo2"];}else {$pGrupo2 = null;}
			//if(!empty($_GET['pGrupo2Campos'])) {$pGrupo2Campos = $_GET["pGrupo2Campos"];}else {$pGrupo2Campos = null;}
			//if(!empty($_GET['pFechaIniActual'])) {$pFechaIniActual = $_GET["pFechaIniActual"];}else {$pFechaIniActual = null;}
			//if(!empty($_GET['pFechaFinActual '])) {$pFechaFinActual  = $_GET["pFechaFinActual "];}else {$pFechaFinActual  = null;}
			//if(!empty($_GET['pFechaIniAnterior'])) {$pFechaIniAnterior = $_GET["pFechaIniAnterior"];}else {$pFechaIniAnterior = null;}
			//if(!empty($_GET['pFechaFinAnterior'])) {$pFechaFinAnterior = $_GET["pFechaFinAnterior"];}else {$pFechaFinAnterior = null;}
			//if(!empty($_GET['pCategoria'])) {$pCategoria = $_GET["pCategoria"];}else {$pCategoria = null;}
			//if(!empty($_GET['pCategoriaVendedor'])) {$pCategoriaVendedor = $_GET["pCategoriaVendedor"];}else {$pCategoriaVendedor = null;}
			//if(!empty($_GET['pVendedor'])) {$pVendedor = $_GET["pVendedor"];}else {$pVendedor = null;}
			//if(!empty($_GET['pTipoBodega'])) {$pTipoBodega = $_GET["pTipoBodega"];}else {$pTipoBodega = null;}
			//if(!empty($_GET['pBodega'])) {$pBodega = $_GET["pBodega"];}else {$pBodega = null;}
			//if(!empty($_GET['pClase'])) {$pClase = $_GET["pClase"];}else {$pClase = null;}
			//if(!empty($_GET['pMarca'])) {$pMarca = $_GET["pMarca"];}else {$pMarca = null;}
			//if(!empty($_GET['pTipo'])) {$pTipo = $_GET["pTipo"];}else {$pTipo = null;}
			//if(!empty($_GET['pSubtipo'])) {$pSubtipo = $_GET["pSubtipo"];}else {$pSubtipo = null;}
			//if(!empty($_GET['pSubtipo2'])) {$pSubtipo2 = $_GET["pSubtipo2"];}else {$pSubtipo2 = null;}
			//if(!empty($_GET['pEnvase'])) {$pEnvase = $_GET["pEnvase"];}else {$pEnvase = null;}
			if(!empty($_GET['pXmlAgrupaMultiple'])) {$pXmlAgrupaMultiple = $_GET["pXmlAgrupaMultiple"];}else {$pXmlAgrupaMultiple = null;}
			//if(!empty($_GET['pColumnasOrdenado'])) {$pColumnasOrdenado = $_GET["pColumnasOrdenado"];}else {$pColumnasOrdenado = null;}

			//if(!empty($_GET['pJsonAgrupaMultiple'])) {$pJsonAgrupaMultiple = $_GET["pJsonAgrupaMultiple"];}else {$pJsonAgrupaMultiple = null;}
            
			//$reporte = $model->sp_RptVentasDinamicoComparativo_Web($pSistema, $pUsuario, $pOpcion, $pTipoRpt, $pGrupo1, $pGrupo1Campos,$pGrupo2,$pGrupo2Campos,$pFechaIniActual,$pFechaFinActual,$pFechaIniAnterior,$pFechaFinAnterior,$pCategoria,$pCategoriaVendedor,$pVendedor,$pTipoBodega,$pBodega,$pClase,$pMarca,$pTipo,$pSubtipo,$pSubtipo2,$pEnvase,$pXmlAgrupaMultiple,$pColumnasOrdenado);

			$reporte = $model->sp_RptVentasDinamicoComparativo_Web($pSistema, $pUsuario, $pOpcion,$pXmlAgrupaMultiple);

			//$reporte = $model->sp_RptVentasDinamicoComparativo_Web($pSistema, $pUsuario, $pOpcion, $pTipoRpt, $pGrupo1, $pGrupo1Campos,$pGrupo2,$pGrupo2Campos,$pFechaIniActual,$pFechaFinActual,$pFechaIniAnterior,$pFechaFinAnterior,$pCategoria,$pCategoriaVendedor,$pVendedor,$pTipoBodega,$pBodega,$pClase,$pMarca,$pTipo,$pSubtipo,$pSubtipo2,$pEnvase,$pJsonAgrupaMultiple,$pColumnasOrdenado);
							  
							  return $this->getResponse(
							  [
								  'msg'       => 'SUCCESS',
								  'message'   => 'Reporte recuperado con exito',
								  'reporte'   => $reporte
							  ]
						  );      
    }
}