<?php

namespace App\Controllers;

use App\Models\DetalleProducto_Model;
use App\Models\Cliente_Model;
use App\Models\SeccionesModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class DetalleProducto extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/
    public function index()
    {
        $model = new DetalleProducto_Model();
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
//          'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[client.email]',
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
    public function show($clase)
    {
        //try {
            $model = new DetalleProducto_Model();
            $modelCliente = new Cliente_Model();
            $modelSecciones = new SeccionesModel();
            if(!empty($_GET['tipoConsulta'])) {$tipoConsulta = $_GET["tipoConsulta"];}else {$tipoConsulta = null;}
            if(!empty($_GET['articulo'])) {$art = $_GET["articulo"];}else {$art = null;}
            if(!empty($_GET['user'])) {$pUser = $_GET["user"];}else {$pUser = null;}
            if(!empty($_GET['cliente'])) {$pCliente = $_GET["cliente"];}else {$pCliente = null;}
            if(!empty($_GET['ruc'])) {$pContribuyente = $_GET["ruc"];}else {$pContribuyente = null;}
            if(!empty($_GET['nombre'])) {$pNombrecliente = $_GET["nombre"];}else {$pNombrecliente = null;}
            if(!empty($_GET['nprecio'])) {$pNivelPrecio = $_GET["nprecio"];}else {$pNivelPrecio = null;}
			if(!empty($_GET['pbodega'])) {$pbodega = $_GET["pbodega"];}else {$pbodega = null;}
			if(!empty($_GET['pTipoProd'])) {$pTipoProd = $_GET["pTipoProd"];}else {$pTipoProd = null;}
			
			if($pTipoProd == 'K')
			{
				$p_Opcion=3;
			}else
			{
				$p_Opcion=1;
			}
			
            if($pUser != null)
			{
              $precioUsuario = $modelSecciones->precioArticulo($pUser,$art);
				if($precioUsuario)
				{
				  foreach ($precioUsuario as $value) {
                    $precioU[] = array(
                      'PRECIO'       => $value->PRECIO,
                      'NIVEL_PRECIO' => $value->NIVEL_PRECIO,
                      'OPCION'       => 0
                    );
                  }
				}
				else 
				{ 
				  $precioU = "";
				}     
            }else {
              $precioU = "";
            }
            if($pNivelPrecio != "" ){
              $precioCliente = $modelCliente->sp_NivelPrecio_Cliente($art,$pNivelPrecio);
              if($precioCliente){
              foreach ($precioCliente as $value) {
                    $precioC[] = array(
                      'PRECIO'       => $value->PRECIO,
                      'NIVEL_PRECIO' => $value->NIVEL_PRECIO,
                      'OPCION'       => 0
                    );
                  }
                }else {
                   $precioC[] = array(
                      'PRECIO'       => "SN",
                      'NIVEL_PRECIO' => $pNivelPrecio,
                      'OPCION'       => 0
                    );
                }
            }
            else {
              $precioC = [];
            }
            $result = $model->BusquedaDetalle($tipoConsulta,$clase,$art,$pbodega,$pTipoProd);
			$resultitbms = $model->busquedaitbms($art);
            $existencia = $model->existenciaBodega($art,$p_Opcion);
            switch($clase)
            {
              case 1055: //
                  if ($result) {
                    foreach ($result as $value) {
                      $articulo = $art;
                      $descripcion = $value->DESCRIPCION;
					  $id_envase = null;
                      $cantidad = $value->CANT_DISPONIBLE;
                      $remate = $value->REMATE;
                      $impuesto = $value->IMPUESTO;
                      $precioremate = number_format($value->PRECIOREMATE, 2, '.', ',');
                      $preciolista = number_format($value->PRECIOLISTA, 2, '.', ',');
					  $preciodescuento = number_format($value->PRECIO_DESCUENTO, 2, '.', ',');
					  
                      $detalles = array(
                            'IDMARCA' => $value->ID_MARCA,
                            'MARCA' => $value->MARCADESC,
                            'RIN' => $value->RIN,
                            'HUECOS' => $value->PERNOS,
                            'MEDIDAS' => $value->DISTANCIA1,
                            'MEDIDAS2' => $value->DISTANCIA2 ? $value->DISTANCIA2 : '-',
                            'ET' => $value->OFFSET,
                            'CB' => $value->CENTERBORE,
                            'ANCHO' => $value->ANCHOV,
                            'NOTAS' => nl2br($value->NOTAS)
                            );
                    }
                  }
                  break;
              case 1010:
                        if ($result) {
                          foreach ($result as $value) {
                            $articulo = $art;
                            $descripcion = $value->DESCRIPCION;
							$id_envase = null;
                            $cantidad = $value->CANT_DISPONIBLE;
                            $remate = $value->REMATE;
                            $impuesto = $value->IMPUESTO;
                            $precioremate = number_format($value->PRECIOREMATE, 2, '.', ',');
                            $preciolista = number_format($value->PRECIOLISTA, 2, '.', ',');
							$preciodescuento = number_format($value->PRECIO_DESCUENTO, 2, '.', ',');
                            $detalles = array(
                                  'IDMARCA' => $value->ID_MARCA,
                                  'MARCA' => $value->MARCADESC,
                                  'ANCHO' => $value->ANCHO,
                                  'PERFIL' => $value->PERFIL,
                                  'TAMANO' => $value->TAMANO,
                                  'INDICE_CARGA' => $value->INDICE_CARGA,
                                  'INDICE_VELOCIDAD' => $value->INDICE_VELOCIDAD,
                                  'TIPO' => $value->TIPO,
                                  'NOTAS' => nl2br($value->NOTA)
                                  );
                          }
                        }
                        break;
              case 1030:
                      if ($result) {
                        foreach ($result as $value) {
                          $articulo = $art;
                          $descripcion = $value->DESCRIPCION;
						  $id_envase = null;
                          $cantidad = $value->CANT_DISPONIBLE;
                          $remate = $value->REMATE;
                          $impuesto = $value->IMPUESTO;
                          $precioremate = number_format($value->PRECIOREMATE, 2, '.', ',');
                          $preciolista = number_format($value->PRECIOLISTA, 2, '.', ',');
						  $preciodescuento = number_format($value->PRECIO_DESCUENTO, 2, '.', ',');
                          $detalles = array(
                                'IDMARCA' => $value->ID_MARCA,
                                'MARCA' => $value->MARCADESC,
                                'NOTAS' => nl2br($value->NOTAS)
                                );
                        }
                    }
                    $filtros =  $model->DetalleFiltros($articulo);
                    $sellos  =  $model->DetalleSelloFiltros($articulo);

                    if ($filtros != 0) {
                      foreach ($filtros as $value)
                      {
                        // $filtro = array(
                              // 'APLICACION_PRINCIPAL' => $value->APLICACION_PRINCIPAL,
                              // 'COD_ESTILO'           => $value->COD_ESTILO,
                              // 'DESCRIPCION_ESTILO'   => $value->DESCRIPCION_ESTILO,
                              // 'ED_ALTURA'            => $value->ED_ALTURA,
                              // 'ED_OD'                => $value->ED_OD,
                              // 'ED_OD_TOP'            => $value->ED_OD_TOP,
                              // 'ED_OD_BOTTON'         => $value->ED_OD_BOTTON,
                              // 'ED_OD_HILO'           => $value->ED_OD_HILO,
                              // 'ED_ID'                => $value->ED_ID,
                              // 'ED_ID_TOP'            => $value->ED_ID_TOP,
                              // 'ED_ID_BOTTON'         => $value->ED_ID_BOTTON,
                              // );
							  
						  $filtro = array(
								'APLICACION_PRINCIPAL' 	=> $value->APLICACION_PRINCIPAL, 
								'COD_ESTILO'           	=> $value->COD_ESTILO, 
								'DESCRIPCION_ESTILO'   	=> $value->COD_ESTILO,
								'ED_ALTURA'            	=> $value->ED_ALTURA,			//Altura
								'ED_OD'                	=> $value->ED_OD, 		//Diametro Exterior
								'ED_OD_TOP'            	=> $value->ED_OD_TOP, 		//Parte superior del diametro exterior
								'ED_OD_BOTTON'         	=> $value->ED_OD_BOTTON,	//Parte inferior del diametro exterior
								'ED_OD_HILO'           	=> $value->ED_OD_HILO,		//Tamaño del hilo
								'ED_ID'                	=> $value->ED_ID,			//Diametro interior
								'ED_ID_TOP'            	=> $value->ED_ID_TOP,		//Parte superior del diametro interior
								'ED_ID_BOTTON'         	=> $value->ED_ID_BOTTON,	//Parte inferior del diametro interior
								'LONGITUD' 				=> $value->LONGITUD, 
								'ANCHO'					=> $value->ANCHO,  
								'BETA_RADIO'			=> $value->BETA_RADIO, 
								'SERVICIO'				=> $value->SERVICIO, 
								'TIPO'					=> $value->TIPO, 
								'MEDIA'					=> $value->MEDIA, 
								'PRP'					=> $value->PRP, 
								'TFG'					=> $value->TFG, 
								'CNM'					=> $value->CNM, 
								'CVP'					=> $value->CVP, 
								'VTA'					=> $value->VTA, 
								'CAPACIDAD'				=> $value->CAPACIDAD,   
								'ENTRADA' 				=> $value->ENTRADA, 
								'SALIDA'				=> $value->SALIDA, 
								'DF'					=> $value->DF, 
								'AF'      				=> $value->AF,  
								'ENDS'					=> $value->ENDS, 
								'CFM'					=> $value->CFM, 
								'ALETAS'    			=> $value->ALETAS, 
							  
                              );
                      }
                    }else {
                      $filtro = "";
                    }
                    if ($sellos != 0) {
                      foreach ($sellos as $value)
                      {
                        $sello[] = array(
                              'NUMERO_SELLO'         => $value->NUMERO_SELLO,
                              'OD'                   => $value->OD,
                              'ID'                   => $value->ID,
                              'THK'                  => $value->THK,
                              'INDICE_NUM'           => $value->INDICE_NUM,
                              'DESCRIPCION_INDICE'   => $value->DESCRIPCION_INDICE
                            );
                      }//fin del for
                    }else {
                      $sello = "";
                    }
                  break;
              default :
                if ($result) {
                    foreach ($result as $value) {
                      $articulo = $art;
                      $descripcion = $value->DESCRIPCION;
					  $id_envase = $value->ID_ENVASE;
                      $cantidad = $value->CANT_DISPONIBLE;
                      $remate = $value->REMATE;
                      $impuesto = $value->IMPUESTO;
                      $precioremate = number_format($value->PRECIO_REMATE, 2, '.', ',');
                      $preciolista = number_format($value->PRECIOLISTA, 2, '.', ',');
					  $preciodescuento = number_format($value->PRECIO_DESCUENTO, 2, '.', ',');
                      $detalles = array(
                              'IDMARCA' => $value->IDMARCA,
                              'MARCA' => $value->MARCA,
                              'NOTAS' => nl2br($value->NOTAS)
                            );
                    }
                  }
				  
            } //fin del case

			if ($resultitbms) 
			{
				foreach ($resultitbms as $value) 
				{;
				   $valor_itbms = $value->VALOR_ITBMS; 
				}
            }
				  
            if (!isset($filtro)) $filtro = "";
            if (!isset($sello)) $sello = "";
			$saludo="";
            $producto = array(
                  'ARTICULO'        => $art,
                  'DESCRIPCION'     => $descripcion,
				  'ID_ENVASE'     	=> $id_envase,
                  'CANT_DISPONIBLE' => $cantidad,
                  'REMATE'          => $remate,
                  'PRECIOREMATE'    => $precioremate,
                  'PRECIOLISTA'     => $preciolista,
                  'DETALLES'        => $detalles,
                  'FILTRO'          => $filtro,
                  'SELLOS'          => $sello,
                  'CANTIDAD'        => $existencia,
                  'PRECIOVENDEDOR'  => $precioU,
                  'PRECIOCLIENTE'   => $precioC,
				  'PRECIO_DESCUENTO'  => $preciodescuento,
                  'IMPUESTO'          => $impuesto,
				  'VALOR_ITBMS'		=> $valor_itbms
				  
                );
            return $this->getResponse(
                [
                    'msg'        => 'SUCCESS',
                    'message'    => 'Detalle recuperado con exito',
                    'detalle'    => $producto,
                ]
            );
      /*  } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar el detalle para la ID especificada'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }*/
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
