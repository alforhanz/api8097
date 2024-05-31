<?php
namespace App\Controllers;

use App\Models\GetEncuestas_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetEncuestas extends BaseController
{
    protected $format = 'json';

    public function show($opt)
    {
        $model = new GetEncuestas_Model();
        $msg ="";
        if(!empty($_GET['pUsuario'])) {$pUsuario = $_GET["pUsuario"];}else {$pUsuario = null;}
        if(!empty($_GET['pEncuesta'])) {$pEncuesta = $_GET["pEncuesta"];}else {$pEncuesta = null;}
        if(!empty($_GET['pTipoCliente'])) {$pTipoCliente = $_GET["pTipoCliente"];}else {$pTipoCliente = null;}
        if(!empty($_GET['pOpcion'])) {$pOpcion = $_GET["pOpcion"];}else {$pOpcion = null;}

        if(!empty($_GET['pPregunta'])) {$pPregunta = $_GET["pPregunta"];}else {$pPregunta = null;}
        if(!empty($_GET['pEstado'])) {$pEstado = $_GET["pEstado"];}else {$pEstado = null;}
        if(!empty($_GET['pRespuesta'])) {$pRespuesta = $_GET["pRespuesta"];}else {$pRespuesta = null;}
        if(!empty($_GET['pIdTemporal'])) {$pIdTemporal  = $_GET["pIdTemporal"];}else {$pIdTemporal  = null;}
        if(!empty($_GET['pedido'])) {$pedido  = $_GET["pedido"];}else {$pedido  = null;}

    		switch ($opt) {
            	  case 1:
                  $encuesta = $model->sp_get_encuestas_web($pUsuario,$pEncuesta,$pTipoCliente);
              	break;
              	case 2:
                  $encuesta = $model->sp_getPreguntasEncuestas($pUsuario,$pEncuesta,$pOpcion);
              	break;
                case 3:
                  $encuesta = $model->sp_getOpcionesPreguntaEncuesta($pUsuario,$pEncuesta,$pPregunta,$pEstado);
                break;
                case 4:
                  $encuesta = $model->sp_insert_Encuestas($pUsuario,'P','1',3,$pRespuesta,$pIdTemporal,$pedido);
                break;
                case 5:
                  $encuesta = $model->sp_getEncuestas($pUsuario,'E','1',null,null,$pIdTemporal);
                break;
                default:
                  # code...
                break;
              }

              return $this->getResponse(
                  [
                      'msg'        => 'SUCCESS',
                      'message'    => 'Opciones recuperadas con exito',
                      'encuesta'   => $encuesta,
                  ]
              );     
    }
}