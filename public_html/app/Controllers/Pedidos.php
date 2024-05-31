<?php
namespace App\Controllers;

use App\Models\Pedidos_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Pedidos extends BaseController
{
    protected $format = 'json';
    /*
    * Get all MarcasVehiculo
    * @return Response
    */ 
    public function index()
    {
        $model = new Cliente_Model();
        return $this->getResponse(
            [
                'message' => 'Tipo recuperados con exito',
                'Tipo' => $model->findTipoAll()
            ]
        );
    }
    /**
    * Create a new Client
    **/
    public function store()
    {
        $rules = [
            'name' => 'required',
          /*'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[client.email]',*/
            'password' => 'required|max_length[255]'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $user  = $input['name'];
        $model = new MarcasVehiculo_Model();
        $model->save($input);
        $marcas = $model->where('name', $user)->first();
        return $this->getResponse(
            [
                'message' => 'Client added successfully',
                'client' => $marcas
            ]
        );
    }

    /**
     * Get a single client by ID
     */
    public function show($pTipoConsulta)
    {
      //  try {
            $model = new Pedidos_Model();
            $msg ="";
            if(!empty($_GET['pedido'])) {$pPedido = $_GET["pedido"];}else {$pPedido = null;}
            if(!empty($_GET['estado'])) {$pEstado = $_GET["estado"];}else {$pEstado = null;}
            if(!empty($_GET['fechaini'])) {$pFechaInicial = $_GET["fechaini"];}else {$pFechaInicial = null;}
            if(!empty($_GET['fechafin'])) {$pFechaFinal = $_GET["fechafin"];}else {$pFechaFinal = null;}
            if(!empty($_GET['user'])) {$pUser = $_GET["user"];}else {$pUser = null;}
            if(!empty($_GET['bodega'])) {$pBodega = $_GET["bodega"];}else {$pBodega = null;}
            if(!empty($_GET['cliente'])) {$pCliente = $_GET["cliente"];}else {$pCliente = null;}
            $pedidos = $model->reportePedidos($pTipoConsulta,$pPedido,$pEstado,$pFechaInicial,$pFechaFinal,$pUser,$pBodega,$pCliente." ");
            if($pedidos){
                if($pTipoConsulta == 'D'){
                      foreach($pedidos as $key) {
                            $vfacturardor = $key->NombreFacturador;
							$vRuc         = $key->Contribuyente;
							$vNombre      = $key->Nombre;
							$vCliente     = $key->CLIENTE;
							$vCobrador    = $key->NOMBRE_COBRADOR;
							$vVendedor    = $key->NombreVendedor;
							$vEmbarcar_a  = $key->Embarcar_a;
							$vContacto	  = $key->Contacto;
							$vTelefono	  = $key->Telefono1; 
                            $vPedido      = $key->Pedido;
							$vOrdenCom    = $key->ORDEN_COMPRA;
                            $vFecha       = $key->Fecha_Pedido;
                            $vsubtotal    = $key->Total_Mercaderia;
                            $vtotalPagar  = $key->Total_A_Facturar;
							$vdesc_promo  = $key->DESC_PROMO;
                            $vimpuesto    = $key->Total_Impuesto1;
                            $vtipoDoc     = $key->TIPO_DOCUMENTO;
                            $vEstado      = $key->ESTADO;
                            $vdescuento   = $key->Monto_descuento1;
                            $vCondicionP  = $key->CONDICION_PAGO;
                            $vPromo       = $key->CONTRATO;
                            $vObservacion = $key->observaciones;
                            $vExento      = $key->EXENTO_IMPUESTOS;
                            $cantBodega   = $model->sp_getExistenciaArticuloBodega($key->Articulo,2,$pBodega);
                            $prom         = explode('_',$key->COMENTARIO);
                            if(count($prom) == 2){ 
                              $promo = $prom[0];
                              $pn = $prom[1];
                            }else{
                              $promo = 0; 
                              $pn = $prom[0];
                            }
                            $vitems[] = array(
                                        'lineapedido'  => $key->PEDIDO_LINEA,
                                        'articulo'     => $key->Articulo,
                                        'descripcion'  => $key->DescripcionArticulo,
										'id_envase'    => $key->ID_ENVASE,
                                        'idmarca'      => $key->ID_MARCA,
                                        'precio'       => $key->Precio_Unitario,
                                        'precio_origen'=> $key->PRECIO_ORIGEN,
                                        'nivel_precio' => $pn,
                                        'cantidad'     => $key->Cantidad_Pedida,
                                        'clase'        => $key->CLASE,
                                        'promo'        => $promo,
                                        'excento'      => $key->IMPUESTO,
										'valor_itbms'      => $key->VALOR_ITBMS,
                                        'tipo_art'     => $key->tipo, //T articulo tipo terminado y V articulo tipo servicio
                                        'stockbod'     => intval($cantBodega),
                                        'stock'        => ""
                              );
                            }
                      $ArrPedido[] = array(
                            'pedido'           => $vPedido,
                            'facturador'       => $vfacturardor, 
                            'CLIENTE'          => $vCliente,
                            'RUC'              => $vRuc,
                            'NOMBRE'           => $vNombre,
							'Embarcar_a'       => $vEmbarcar_a,
							'cobrador'		   => $vCobrador,
							'vendedor'		   => $vVendedor, 
							'contacto'		   => $vContacto,	  
							'telefono'		   => $vTelefono,	  
                            'fecha'            => $vFecha,
                            'subtotal'         => $vsubtotal,
                            'total_a_facturar' => $vtotalPagar,
							'desc_promo' 	   => $vdesc_promo,
                            'impuesto'         => $vimpuesto,
                            'descuento'        => $vdescuento,
                            'tipo_doc'         => $vtipoDoc,
                            'estado'           => $vEstado,
                            'condicion_pago'   => $vCondicionP,
                            'Observacion'      => $vObservacion,
                            'items'            => $vitems,
                            'promo'            => $vPromo,
                            'exento_impuesto'  => $vExento,
							'ORDEN_COMPRA'     => $vOrdenCom
                      );
                      $msg ="SUCCESS";
                    }

                if($pTipoConsulta == 'R'){
                        foreach($pedidos as $key) {
                            $ArrPedido[] = array(
                                        'PEDIDO'           => $key->PEDIDO,
                                        'RUC_CEDULA'       => $key->RUC_CEDULA,
                                        'NOMBRE'           => $key->NOMBRE,
                                        'CLIENTE'          => $key->CLIENTE,
                                        'FECHA_PEDIDO'     => $key->FECHA_PEDIDO,
                                        'TIPO_DOCUMENTO'   => $key->TIPO_DOCUMENTO,
                                        'BODEGA'           => $key->BODEGA,
                                        'ESTADO'           => $key->ESTADO,
                                        'TOTAL_A_FACTURAR' => $key->TOTAL_A_FACTURAR,
										'VENDEDOR' 		   => $key->USUARIO	
                              );
                            }
                            $msg ="SUCCESS";
              }
            }else{
              $ArrPedido = "";
              $msg ="FAIL";
            }
            return $this->getResponse(
                [
                    'msg'        => $msg,
                    'message'    => 'Pedidos recuperado con exito',
                    'pedidos'    => $ArrPedido,
                ]
            );
      //  } catch (Exception $e) {
      //       return $this->getResponse(
      //           [
      //               'message' => 'No se pudo encontrar el Cliente para la ID especificada'
      //           ],
      //           ResponseInterface::HTTP_NOT_FOUND
      //       );
      //   }
    }

    public function update($id)
    {
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