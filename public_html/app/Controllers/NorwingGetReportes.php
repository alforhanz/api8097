<?php
namespace App\Controllers;

use App\Models\NorwingGetReportes_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class NorwingGetReportes extends BaseController
{
    protected $format = 'json';

    public function index($opt)
    {
        $model = new NorwingGetReportes_Model();
        $msg ="";
    		switch ($opt) {
                //Comparativo Clases
            	  case 1:
                  if(!empty($_GET['pUsuario'])) {$pUsuario  = $_GET["pUsuario"];}else {$pUsuario = null;}
                  if(!empty($_GET['pOpcion'])) {$pOpcion  = $_GET["pOpcion"];}else {$pOpcion = null;}
                  if(!empty($_GET['pFechaDesdeActual'])) {$pFechaDesdeActual = $_GET["pFechaDesdeActual"];}else {$pFechaDesdeActual = null;}
                  if(!empty($_GET['pFechaHastaActual'])) {$pFechaHastaActual = $_GET["pFechaHastaActual"];}else {$pFechaHastaActual = null;}
                  if(!empty($_GET['pBodega'])) {$pBodega  = $_GET["pBodega"];}else {$pBodega  = null;}
                  if(!empty($_GET['pCategoria'])) {$pCategoria  = $_GET["pCategoria"];}else {$pCategoria  = null;}
                  if(!empty($_GET['pVendedor'])) {$pVendedor  = $_GET["pVendedor"];}else {$pVendedor  = null;}
                  $reporte = $model->sp_getDashboardNorwing_Gerencial('ECO',$pUsuario,$pOpcion,$pFechaDesdeActual,$pFechaHastaActual,$pBodega,$pCategoria,$pVendedor);
              	break;
              	case 2:
                  if(!empty($_GET['pCategoria'])) {$pCategoria = $_GET["pCategoria"];}else {$pCategoria = null;}
                  if(!empty($_GET['pVendedor'])) {$pVendedor = $_GET["pVendedor"];}else {$pVendedor = null;}
                  if(!empty($_GET['pBodega'])) {$pBodega = $_GET["pBodega"];}else {$pBodega = null;}
                  if(!empty($_GET['pOpcion'])) {$pOpcion = $_GET["pOpcion"];}else {$pOpcion = null;}
                  $reporte = $model->sp_getCategoriaVendedor($pCategoria,$pVendedor,$pBodega,$pOpcion);
              	break;
                //Comparativo Vendedor
                case 3:
                break;
                default:
                  # code...
                break;
              }

              return $this->getResponse(
                  [
                      'msg'       => 'SUCCESS',
                      'message'   => 'Reporte recuperado con exito',
                      'reporte'   => $reporte,
                  ]
              );     
    }
}