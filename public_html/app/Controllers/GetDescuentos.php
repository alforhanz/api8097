<?php
namespace App\Controllers;

use App\Models\GetDescuentos_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetDescuentos extends BaseController
{
    protected $format = 'json';


    /**
     * Get a single client by ID
     */
    public function index()
    {
            $model = new GetDescuentos_Model();
            $msg ="";
            if(!empty($_GET['pUsuario'])) {$pUsuario = $_GET["pUsuario"];}else {$pUsuario = null;}
            if(!empty($_GET['pPromocion'])) {$pPromocion = $_GET["pPromocion"];}else {$pPromocion = null;}
            if(!empty($_GET['pTipoVenta'])) {$pTipoVenta = $_GET["pTipoVenta"];}else {$pTipoVenta = null;}
			if(!empty($_GET['pArticulo'])) {$pArticulo = $_GET["pArticulo"];}else {$pArticulo = null;}
			if(!empty($_GET['pClase'])) {$pClase = $_GET["pClase"];}else {$pClase = null;}
			if(!empty($_GET['pMarca'])) {$pMarca = $_GET["pMarca"];}else {$pMarca = null;}

			if(!empty($_GET['pNivelPrecio'])) {$pNivelPrecio = $_GET["pNivelPrecio"];}else {$pNivelPrecio = null;}
			if(!empty($_GET['pTipo '])) {$pTipo  = $_GET["pTipo "];}else {$pTipo  = null;}
			if(!empty($_GET['pUnidad'])) {$pUnidad = $_GET["pUnidad"];}else {$pUnidad = null;}
			if(!empty($_GET['pPrecio'])) {$pPrecio = $_GET["pPrecio"];}else {$pPrecio = null;}
			if(!empty($_GET['pCantidad'])) {$pCantidad = $_GET["pCantidad"];}else {$pCantidad = null;}
			if(!empty($_GET['pPedido'])) {$pPedido = $_GET["pPedido"];}else {$pPedido = null;}
			if(!empty($_GET['pXmlData'])) {$pXmlData = $_GET["pXmlData"];}else {$pXmlData = null;}
            
			$descuento = $model->getDescuentoLubricantes($pUsuario, $pPromocion, $pTipoVenta, $pArticulo, $pClase, $pMarca,$pNivelPrecio,$pTipo,$pUnidad,$pPrecio,$pCantidad,$pPedido,$pXmlData);
							  
							  return $this->getResponse(
							  [
								  'msg'       => 'SUCCESS',
								  'message'   => 'Descuento para lubricantes recuperado con exito',
								  'descuento'   => $descuento
							  ]
						  );      
    }
}