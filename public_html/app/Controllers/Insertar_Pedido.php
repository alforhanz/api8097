<?php
namespace App\Controllers;

use App\Models\Pedidos_Model;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use \Firebase\JWT\JWT;
use Exception;

class Insertar_Pedido extends BaseController
{
    protected $format = 'json';
    /*
    * Get all MarcasVehiculo
    * @return Response
    */ 
    public function index()
    {
        $model = new Pedidos_Model();
        return $this->getResponse(
            [
                'message' => 'Tipo recuperados con exito',
                'Tipo' => 'index'
            ]
        );
    }
    /**
    * Create a new Client
    **/
    public function create()
    {
		//CREACION OBJETO MODEL
        $model = new Pedidos_Model();
        // $rules = [
        //     'username' => 'required',
        //     'password' => 'required|min_length[6]|max_length[255]|validateUser[username, password]'
        // ];
        $input = $this->getRequestInput($this->request);
        // if (!$this->validateRequest($input, $rules)) {
        //     return $this
        //         ->getResponse(
        //             $this->validator->getErrors(),
        //             ResponseInterface::HTTP_BAD_REQUEST
        //         );
        // }

        //$user  = $input['name'];
		
		//se establece null para todos los parametros que llegan vacios
        if(!empty($input['user'])) {$pUser = $input["user"];}else {$pUser = null;}
        if(!empty($input['cliente'])) {$pCliente = $input["cliente"];}else {$pCliente = null;}
        if(!empty($input['bodega'])) {$pBodega = $input["bodega"];}else {$pBodega = null;}
        if(!empty($input['ordencompra'])) {$pOrdenCompra = $input["ordencompra"];}else {$pOrdenCompra = null;}
        if(!empty($input['observacion'])) {$pObserv = $input["observacion"];}else {$pObserv = null;}
        if(!empty($input['tarjetaCredi'])) {$pTarjetaCredito = $input["tarjetaCredi"];}else {$pTarjetaCredito = null;}
        if(!empty($input['nombrecuenta'])) {$pNombreCuenta = $input["nombrecuenta"];}else {$pNombreCuenta = null;}
        if(!empty($input['pedido'])) {$pPedido = $input["pedido"];}else {$pPedido = null;}
        if(!empty($input['subtotal'])) {$pSubtotal = $input["subtotal"];}else {$pSubtotal = 0;}
        if(!empty($input['impuesto'])) {$pImpuesto = $input["impuesto"];}else {$pImpuesto = 0;}
        if(!empty($input['total'])) {$pTotal = $input["total"];}else {$pTotal = 0;}
        if(!empty($input['totalunidades'])) {$pTotalUnidades = $input["totalunidades"];}else {$pTotalUnidades = 0;}
        if(!empty($input['condicion'])) {$pCondicionPago = $input["condicion"];}else {$pCondicionPago = 0;}
        if(!empty($input['promocion'])) {$pPromocion = $input["promocion"];}else {$pPromocion = null;}
        if(!empty($input['tiposistema'])) {$pTipoSistema = $input["tiposistema"];}else {$pTipoSistema = 'E';}
        if(!empty($input['tipodocumento'])) {$pTipoDocumento = $input["tipodocumento"];}else {$pTipoDocumento = null;}
        if(!empty($input['estadodocumento'])) {$estadodocumento = $input["estadodocumento"];}else {$estadodocumento = null;}
		
		$pRespuesta;
		$pSistema='E';
		if($estadodocumento=='I')
		{
			$pOpcion=0;
		} 
		else 
		{
			$pOpcion=1;
		}
        
        $pFechaEntrega = date('Ymd');  

        $pedido = $model->sp_InsertPedidoEcommerce($pUser,$pCliente,$pBodega,$pOrdenCompra,$pObserv,$pTarjetaCredito,$pNombreCuenta,$pPedido,$pSubtotal,$pImpuesto,$pTotal,$pTotalUnidades,$pCondicionPago,$pFechaEntrega,$pPromocion,$pTipoSistema,$pTipoDocumento);

		if($pedido){
            if($pedido == 2){
                $items=$pedido;
            }
            else
            {
                foreach ($input['items'] as $key) {
                $comentario = $key['promo'] ? $key['promo'].'_'.$key['nivel_precio']:$key['nivel_precio'];
                $items = $model->sp_InsertPedido_LineaEcommerce($pPedido,$key['lineapedido'],$key['articulo'],$key['precio'],$key['cantidad'],'0.00',$comentario,$pUser,$pBodega,$pFechaEntrega,$pSubtotal,$pImpuesto,$pTotal,$pTotalUnidades,$pTipoDocumento,$estadodocumento,$pOrdenCompra,$pObserv);
                }
            }
        }
		
		if($pTipoDocumento=='P')
		{
            if($pedido == 2){
                $taller = 'CP';
            }
            else
            {
                try 
                {   
                    if ($pedido)
                    {
                        //Aqui se debe agregar una segunda validacion para consecutivo de taller por usuario
                        $taller = $model->sp_Insert_OrdenTallerDesdeCLSAWEB($pSistema, $pUser, $pOpcion, $pPedido, $pRespuesta); 
                    }
                } 
                catch (Exception $e) 
                { 
                    $taller='ERROR';  
                }
            }
		}
		else
		{
			$taller='COTIZACION';
		}
		
		

		//respuesta a retornar
        return $this->getResponse
		(
            [
              'msg'     => 'SUCCESS', 
              'message' => $items, 
              'taCon' => $taller,
            ]
        );
    }

    /**
     * Get a single client by ID
     */
    public function show($pTipoConsulta)
    {
        try {
            $msg ="";
            return $this->getResponse(
                [
                    'msg'        => $msg,
                    'message'    => 'Pedidos recuperado con exito',
                    'pedidos'    => $ArrPedido,
                ]
            );
       } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar el Cliente para la ID especificada'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

//Funcion para E-Coomerce Norwing Actualizar/InsertarPedidos
    public function update($id)
    {
        //CREACION OBJETO MODEL
        $model = new Pedidos_Model();
 
        $input = $this->getRequestInput($this->request);
        
        //se establece null para todos los parametros que llegan vacios
        if(!empty($input['user'])) {$pUser = $input["user"];}else {$pUser = null;}
        if(!empty($input['cliente'])) {$pCliente = $input["cliente"];}else {$pCliente = null;}
        if(!empty($input['bodega'])) {$pBodega = $input["bodega"];}else {$pBodega = null;}
        if(!empty($input['ordencompra'])) {$pOrdenCompra = $input["ordencompra"];}else {$pOrdenCompra = null;}
        if(!empty($input['observacion'])) {$pObserv = $input["observacion"];}else {$pObserv = null;}
        if(!empty($input['tarjetaCredi'])) {$pTarjetaCredito = $input["tarjetaCredi"];}else {$pTarjetaCredito = null;}
        if(!empty($input['nombrecuenta'])) {$pNombreCuenta = $input["nombrecuenta"];}else {$pNombreCuenta = null;}
        if(!empty($input['pedido'])) {$pPedido = $input["pedido"];}else {$pPedido = null;}
        if(!empty($input['subtotal'])) {$pSubtotal = $input["subtotal"];}else {$pSubtotal = 0;}
        if(!empty($input['impuesto'])) {$pImpuesto = $input["impuesto"];}else {$pImpuesto = 0;}
        if(!empty($input['total'])) {$pTotal = $input["total"];}else {$pTotal = 0;}
        if(!empty($input['totalunidades'])) {$pTotalUnidades = $input["totalunidades"];}else {$pTotalUnidades = 0;}
        if(!empty($input['condicion'])) {$pCondicionPago = $input["condicion"];}else {$pCondicionPago = 0;}
        if(!empty($input['promocion'])) {$pPromocion = $input["promocion"];}else {$pPromocion = null;}
        if(!empty($input['tiposistema'])) {$pTipoSistema = $input["tiposistema"];}else {$pTipoSistema = 'E';}
        if(!empty($input['tipodocumento'])) {$pTipoDocumento = $input["tipodocumento"];}else {$pTipoDocumento = null;}
        if(!empty($input['estadodocumento'])) {$estadodocumento = $input["estadodocumento"];}else {$estadodocumento = null;}
        
        $pRespuesta;
        $pSistema='E';
        if($estadodocumento=='I')
        {
            $pOpcion=0;
        } 
        else 
        {
            $pOpcion=1;
        }
        
        $pFechaEntrega = date('Ymd');  

        $pedido = $model->sp_InsertPedidoEcommerce($pUser,$pCliente,$pBodega,$pOrdenCompra,$pObserv,$pTarjetaCredito,$pNombreCuenta,$pPedido,$pSubtotal,$pImpuesto,$pTotal,$pTotalUnidades,$pCondicionPago,$pFechaEntrega,$pPromocion,$pTipoSistema,$pTipoDocumento);

        if($pedido){
            if($pedido == 2){
                $items=$pedido;
            }
            else
            {
                foreach ($input['items'] as $key) {
                $comentario = $key['promo'] ? $key['promo'].'_'.$key['nivel_precio']:$key['nivel_precio'];
                $items = $model->sp_InsertPedido_LineaEcommerce($pPedido,$key['lineapedido'],$key['articulo'],$key['precio'],$key['cantidad'],'0.00',$comentario,$pUser,$pBodega,$pFechaEntrega,$pSubtotal,$pImpuesto,$pTotal,$pTotalUnidades,$pTipoDocumento,$estadodocumento,$pOrdenCompra,$pObserv);
                }
            }
        }
        
        /**
        if($pTipoDocumento=='P')
        {
            $taller=2;
        }
        else
        {
            $taller='COTIZACION';
        }
        */
        
        //respuesta a retornar
        return $this->getResponse
        (
            [
              'msg'     => 'SUCCESS', 
              'message' => $items,
            ]
        );

        /**
        try {
            $model = new ClientModel();
            $model->findClientById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $client = $model->findClientById($id);

            return $this->getResponse(
                [
                    'message' => 'Client updated successfully',
                    'client' => $client
                ]
            );

        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
        */
    }

    public function destroy($id)
    {
        try {

            $model = new ClientModel();
            $client = $model->findClientById($id);
            $model->delete($client);

            return $this
                ->getResponse(
                    [
                        'message' => 'Client deleted successfully',
                    ]
                );

        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}