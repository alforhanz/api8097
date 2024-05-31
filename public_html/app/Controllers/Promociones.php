<?php
namespace App\Controllers;

use App\Models\Promociones_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Promociones extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/ 
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
    public function show($Id)
    {
       //   try {
            $model = new Promociones_Model();
            $msg ="";
            if(!empty($_GET['user'])) {$pUser = $_GET["user"];}else {$pUser = null;}
            if(!empty($_GET['clase'])) {$pClase = $_GET["clase"];}else {$pClase = null;}
            if(!empty($_GET['promo'])) {$IdPromo = $_GET["promo"];}else {$IdPromo = null;}
            if(!empty($_GET['vprecio'])) {$ValidaPrecio = $_GET["vprecio"];}else {$pValidaPrecio = null;}
            if(!empty($_GET['sistema'])) {$pSistema = $_GET["sistema"];}else {$pSistema = 'E';}
            if(!empty($_GET['opcion'])) {$pOpcion = $_GET["opcion"];}else {$pOpcion = null;}
            if(!empty($_GET['articulo'])) {$pArticulo = $_GET["articulo"];}else {$pArticulo = null;}
            
            switch ($Id) {
              case 1:
                    $promo = $model->sp_get_promociones_web($pUser,$pClase,$IdPromo,$pValidaPrecio,$pSistema);
                    if($promo){
                      foreach($promo as $key) {
                        $marcaPromo = $model->sp_getPromocionesArticulos($key->IDPROMOCION,$pOpcion,$pArticulo);
                        $marcasArray = null;
                        $articuloArray = null;
                          if($marcaPromo){
                              foreach($marcaPromo as $value) {
                                if($value->MARCA != null && $value->ACTIVO === 'S'){
                                            $marcasArray[] = $value->MARCA;
                                }
                                if($value->ARTICULO != null && $value->ACTIVO === 'S'){
                                            $articuloArray[] = $value->ARTICULO;
                                }
                              }
                            }
                            preg_match_all('!\d+!', $key->NIVEL_PRECIO,$nprecio);
                              $promos[] = array(
                                        'pIdPromotion'         => $key->IDPROMOCION,
                                        'pDescription'         => $key->DESCRIPCION,
                                        'pClase'               => $key->CLASIFICACION,
                                        'initialDate'          => $key->FECHA_INICIO ? date("Ymd",strtotime($key->FECHA_INICIO)): null,
                                        'finalDate'            => $key->FECHA_FINAL ? date("Ymd",strtotime($key->FECHA_FINAL)): null,
                                        'quantity'             => $key->CANTIDAD,
                                        'itemBonification'     => $key->ARTICULO_BONIFICACION,
                                        'quantityBonification' => $key->CANTIDAD_BONIFICACION,
                                        'pbonificationPrice'   => $key->PRECIO_BONIFICACION,
                                        'plevelPrice'          => implode($nprecio[0]),
                                        'ptypeDiscount'        => $key->TIPO_DESCUENTO,
                                        'ptypePromotion'       => $key->TIPO_PROMOCION,
                                        'pIdBrands'            => $marcasArray,
                                        'pIdItem'              => $articuloArray,
                                        'ptypeSale'            => $key->TIPO_VENTA == 'BREMEN' ? 1 : 2,
                                        'applyPromotionMulti'  => $key->APLICA_PROMO_VARIOS,
                                        'applyAuction'         => $key->APLICA_REMATE
                                    );
                        }
                    }
                break;
              case 2:
                    if($pOpcion=='N') { $opc=null;} else {$opc = $pOpcion;}
                    $linea = $model->sp_getPromocionesArticulos($IdPromo,$opc,$pArticulo);
                    if($pOpcion=='X'){
                    if($linea){
                      foreach($linea as $key) {
                                  $promos[] = array(
                                              'pIdPromotion' => $key->IDPROMOCION,
                                              'pArticulo'    => $key->ARTICULO,
                                              'pCantidad'    => $key->CANTIDAD,
                                              'pPrecio'      => $key->PRECIO,
                                              'pDescripcion' => $key->descripcion,
                                              'pActivo'      => $key->ACTIVO
                                    );
                                  }
                    }
                  }
                  if($pOpcion=="N"){
                    if($linea){
                      foreach($linea as $key) {
                                  $promos[] = array(
                                              'pIdPromotion'   => $key->IDPROMOCION,
                                              'pArticulo'      => $key->ARTICULO,
                                              'pDescripcion'   => $key->descripcion,
                                              'pPrecioMin'     => $key->PRECIO_MINIMO,
                                              'pPrecioMax'     => $key->PRECIO_MAXIMO,
                                              'pCantidad'      => $key->CANTIDAD_MINIMA,
                                              'pNivelPrecio'   => $key->NIVEL_PRECIO,
                                              'pAplicDescuent' => $key->APLICA_DESCUENTO,
                                              'pMarca'         => $key->MARCA,
                                              'pTipoUnidad'    => $key->TIPO_UNIDAD,
                                              'pActivo'        => $key->ACTIVO,
                                    );
                                  }
                    }
                  }
                    break;
              case 3:
                    $linea = $model->sp_getPromocionesCombos($IdPromo,$pClase);
                    if($linea){
                      foreach($linea as $key) {
                                  $promos[] = array(
                                              'pIdPromotion'    => $key->IDPROMOCION,
                                              'pClase'          => $key->CLASE,
                                              'pCantidad'       => $key->CANTIDAD,
                                              'pMontoDescuento' => $key->MONTO_DESCUENTO,
                                              'pAplicaUnidad'   => $key->APLICA_UNIDAD,
                                              'pCantidadMinima' => $key->CANTIDAD_MINIMA
                                    );
                                  }
                    }
                    break;
              default:
                # code...
                break;
            }
                /*    echo "<pre>";
                    print_r($promos);
                    echo "</pre>";
                    die();*/
            return $this->getResponse(
                [
                    'msg'        => 'SUCCESS',
                    'message'    => 'Promo recuperado con exito',
                    'promo'      => $promos,
                ]
            );

     /*   } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Error al realizar la consulta'
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