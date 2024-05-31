<?php namespace App\Controllers;

use App\Models\LlantasModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Llantas extends BaseController
{
    protected $format = 'json';
       /**
    * Get all MarcasVehiculo
    * @return Response
    **/ 
    public function index()
    {
        $model = new LlantasModel();
        return $this->getResponse(
            [
                'message' => 'Marcas recuperados con exito',
                'marcas' => $model->findMarcasAll()
            ]
        );
    }
    // get single product
    public function show($key=null)
    {
        //  try {
            $model = new LlantasModel();
            switch ($key) {
              case '1':
                      $marcas    = $model->sp_getMarcasVehiculoLlantas();
                          return $this->getResponse(
                          [
                              'msg'       => 'SUCCESS',
                              'message'   => 'Marcas recuperado con exito',
                              'marcas' => $marcas
                          ]
                      );
                break;
              case '2':
                      if(!empty($_GET['idmarca'])) {$IDMarca = $_GET["idmarca"];}else {$IDMarca = null;}
                      $anios    = $model->findAnioById($IDMarca);
                          return $this->getResponse(
                          [
                              'msg'       => 'SUCCESS',
                              'message'   => 'Años recuperado con exito',
                              'anios' => $anios
                          ]
                      );
                break;
              case '3':
                      if(!empty($_GET['idmarca'])) {$IDMarca = $_GET["idmarca"];}else {$IDMarca = null;}
                      if(!empty($_GET['idanio'])) {$IDAnio = $_GET["idanio"];}else {$IDAnio = null;}
                      $modelos    = $model->findModelosById($IDMarca,$IDAnio);
                          return $this->getResponse(
                          [
                              'msg'       => 'SUCCESS',
                              'message'   => 'Modelos recuperado con exito',
                              'modelos' => $modelos
                          ]
                      );
                break;
              case '4':
                      if(!empty($_GET['idmarca'])) {$IDMarca = $_GET["idmarca"];}else {$IDMarca = null;}
                      if(!empty($_GET['idanio'])) {$IDAnio = $_GET["idanio"];}else {$IDAnio = null;}
                      if(!empty($_GET['idmodelo'])) {$IDModelo = $_GET["idmodelo"];}else {$IDModelo = null;}
                      if(!empty($_GET['idconsulta'])) {$IDConsulta = $_GET["idconsulta"];}else {$IDConsulta = null;}
                      $versiones    = $model->findVersionesRinesById($IDMarca,$IDAnio,$IDModelo,1);
                      $rines    = $model->findVersionesRinesById($IDMarca,$IDAnio,$IDModelo,2);
                      $result    = $model->findVersionesRinesById($IDMarca,$IDAnio,$IDModelo,3);
                      
                          return $this->getResponse(
                          [
                              'msg'       => 'SUCCESS',
                              'message'   => 'Consulta recuperado con exito',
                              'versiones' => $versiones,
                              'rines' => $rines,
                              'result' => $result
                          ]
                      );
                break;
              case '5':
                      $model = new LlantasModel();
                      if(!empty($_GET['tipobusqueda'])) {$tipoBusqueda = $_GET["tipobusqueda"];}else {$tipoBusqueda = 0;}

                      if(!empty($_GET['vmarca'])) {$iDMarcaCar = $_GET["vmarca"];}else {$iDMarcaCar = 0;}
                      if(!empty($_GET['vanio'])) {$AnioCar = $_GET["vanio"];}else {$AnioCar = 0;}
                      if(!empty($_GET['vmodelo'])) {$iDModeloCar = $_GET["vmodelo"];}else {$iDModeloCar = 0;}
                      if(!empty($_GET['vversion'])) {$versionCar = implode(",", $_GET["vversion"]);}else {$versionCar = null;}
                      //if(!empty($_GET['version'])) { $ArrVersion = explode(",",$version_vehiculo);}else {$ArrVersion = null;}
                      if(!empty($_GET['vrin'])) {$rinCar = $_GET["vrin"];}else {$rinCar = null;}
                      //   if(!empty($_GET['tamano-rin'])) { $ArrTamanorin = explode(",",$tamanorin);}else {$ArrTamanorin = null;}
                  
                      //VARIABLES POR TAMAÑO
                      if(!empty($_GET['ancho'])) {$anchoLlantas = $_GET["ancho"];}else {$anchoLlantas = 0; }
                      if(!empty($_GET['perfil'])) {$perfilLlantas = $_GET["perfil"];}else {$perfilLlantas = 0; }
                      if(!empty($_GET['rinllantas'])) {$rinLlantas =  $_GET["rinllantas"];}else {$rinLlantas = null;}

                      //VARIABLES POR FILTRO
                      if(isset($_GET['remate'])){$remate = $_GET['remate'];}else {$remate = 'N';}
                      if(!empty($_GET['idmarcas'])) {$idMarcasLlantas = implode(",", $_GET['idmarcas']);}else {$idMarcasLlantas = null;}
                      if(!empty($_GET['idanchos'])) {$idanchos = implode(",", $_GET['idanchos']);}else {$idanchos = null;}
                      if(!empty($_GET['idcb'])) {$idcb = implode(",", $_GET['idcb']);}else {$idcb = null;}
                      if(!empty($_GET['idet'])) {$idet = implode(",", $_GET['idet']);}else {$idet = null;}
                      //PAGINADOR
                      if(isset($_GET['page'])){$paginador = $_GET['page'];}else {$paginador = 0;}
                      if(isset($_GET['tipo'])){$tipo = $_GET['tipo'];}else {$tipo = 0;}
                      if(isset($_GET['subtipo'])){$subtipo = $_GET['subtipo'];}else {$subtipo = 0;}
                      
                      //seleccion
                      //if (!empty($_GET['texto-s'])) {$texto_s = $_GET["texto-s"];}else {$texto_s = null;}

                      //ORDENAR POR PRECIO
                      if(isset($_GET['ord'])) {$ordenamiento = $_GET['ord'];}else {$ordenamiento = null;}
                      if(isset($_GET["bodega"])){$bodega = $_GET["bodega"];}else {$bodega = null;}
                      $llantas = $model->getBusquedaLlantas($iDMarcaCar,$AnioCar,$iDModeloCar,$versionCar,
    $rinCar,$tipoBusqueda,$anchoLlantas,$perfilLlantas,$rinLlantas, $idMarcasLlantas,
    $ordenamiento,$remate,$tipo,$subtipo, $paginador,$bodega);

                      foreach($llantas as $key) {
                            $llanta[] = array(
                                        'ARTICULO'           => $key->COD_ARTICULO,
                                        'DESCRIPCION'        => $key->DESCRIPCION_ART,
                                        'PRECIOLISTA'        => $key->PRECIOLISTA,
                                        'PRECIOORDENAMIENTO' => $key->PRECIOORDENAMIENTO,
                                        'PRECIOREMATE'       => $key->PRECIOREMATE,
                                        'REMATE'             => $key->REMATE,
                                        'CANTIDAD'           => $key->CANT_DISPONIBLE,
                                        'ID_CLASE'           => $key->ID_CLASE,
                                        'IDMARCA'            => $key->ID_MARCA,
                                        'MARCA'              => $key->MARCA_DESCRIP,
                                        'BODEGA'             => $key->BODEGA
                              );
                            }
                      
                      return $this->getResponse(
                              [
                                  'msg'     => 'SUCCESS',
                                  'message' => 'llantas recuperado con exito',
                                  'llantas'   => $llanta
                              ]
                          );
                  break;
              case '6':
                $anchos = $model->sp_getAnchoLlantas();
                return $this->getResponse(
                              [
                                  'msg'     => 'SUCCESS',
                                  'message' => 'Anchos recuperado con exito',
                                  'anchos'   => $anchos
                              ]
                          );

                break;
              case '7':
                      if(!empty($_GET['ancho'])) {$IDAncho = $_GET["ancho"];}else {$IDAncho = null;}
                      $perfil = $model->sp_getPerfilLLantas($IDAncho);
                      return $this->getResponse(
                                    [
                                        'msg'     => 'SUCCESS',
                                        'message' => 'Anchos recuperado con exito',
                                        'perfil'   => $perfil
                                    ]
                                );
                break;
              case '8':
                      if(!empty($_GET['ancho'])) {$IDAncho = $_GET["ancho"];}else {$IDAncho = null;}
                      if(!empty($_GET['perfil'])) {$IDPerfil = $_GET["perfil"];}else {$IDPerfil = null;}
                      $rin = $model->sp_getDiametroLLanta($IDAncho,$IDPerfil);
                      return $this->getResponse(
                                    [
                                        'msg'     => 'SUCCESS',
                                        'message' => 'Anchos recuperado con exito',
                                        'rin'   => $rin
                                    ]
                                );
                break;
              default:
                # code...
                break;
            }
          /*    } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar la modelos con los filtros especificadas'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }*/
    }
    // create a product
    public function create()
    {
        $model = new ProductModel();
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price')
        ];
		$data = json_decode(file_get_contents("php://input"));
		//$data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
        return $this->respondCreated($data, 201);
    }

    // update product
    public function update($id = null)
    {
        $model = new ProductModel();
        $json = $this->request->getJSON();
		if($json){
			$data = [
				'product_name' => $json->product_name,
				'product_price' => $json->product_price
			];
		}else{
			$input = $this->request->getRawInput();
			$data = [
                'product_name' => $input['product_name'],
                'product_price' => $input['product_price']
			];
		}
		// Insert to Database
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    // delete product
    public function delete($id = null)
    {
        $model = new ProductModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
			
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
        
    }

}