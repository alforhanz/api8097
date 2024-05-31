<?php namespace App\Controllers;

use App\Models\BusquedaRines_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class BusquedaRines extends BaseController
{
    protected $format = 'json';
    /**
    * Get all MarcasVehiculo
    * @return Response
    **/
    public function index()
    {
        $model = new BusquedaRines_Model();
        return $this->getResponse(
            [
                'message' => 'Marcas recuperados con exito',
                'marcas' => $model->findMarcasAll()
            ]
        );
    }
    // get single product
    public function show($id = null)
    {
      //try {
        $model = new BusquedaRines_Model();
        if(!empty($_GET['vmarca'])) {$iDMarcaCar = $_GET["vmarca"];}else {$iDMarcaCar = 0;}
        if(!empty($_GET['vanio'])) {$AnioCar = $_GET["vanio"];}else {$AnioCar = 0;}
        if(!empty($_GET['vmodelo'])) {$iDModeloCar = $_GET["vmodelo"];}else {$iDModeloCar = 0;}
        if(!empty($_GET['vversion'])) {$versionCar = implode(",", $_GET["vversion"]);}else {$versionCar = null;}
        //if(!empty($_GET['version'])) { $ArrVersion = explode(",",$version_vehiculo);}else {$ArrVersion = null;}
        if(!empty($_GET['vrin'])) {$rinCar = $_GET["vrin"];}else {$rinCar = null;}
        //   if(!empty($_GET['tamano-rin'])) { $ArrTamanorin = explode(",",$tamanorin);}else {$ArrTamanorin = null;}
        //VARIABLES POR TAMAÑO
        if(!empty($_GET['vperno'])) {$cantPernos = $_GET["vperno"];}else {$cantPernos = 0; }
        if(!empty($_GET['vdistancia'])) {$distPernos = $_GET["vdistancia"];}else {$distPernos = 0; }
        if(!empty($_GET['vtamano'])) {$rinPorTamano =  $_GET["vtamano"];}else {$rinPorTamano = null;}
        //VARIABLES POR FILTRO
        if(!empty($_GET['remate'])){$remate = $_GET['remate'];}else {$remate = 'N';}
        if(!empty($_GET['idmarcas'])) {$idMarcasRines = implode(",", $_GET['idmarcas']);}else {$idMarcasRines = null;}
        if(!empty($_GET['idanchos'])) {$idanchos = implode(",", $_GET['idanchos']);}else {$idanchos = null;}
        if(!empty($_GET['idcb'])) {$idcb = implode(",", $_GET['idcb']);}else {$idcb = null;}
        if(!empty($_GET['idet'])) {$idet = implode(",", $_GET['idet']);}else {$idet = null;}
		if(!empty($_GET['incompletos'])) {$incompletos = $_GET["incompletos"];}else {$incompletos = null;}
		
        //PAGINADOR
        if(isset($_GET['page'])){$paginador = $_GET['page'];}else {$paginador = 0;}
        if(isset($_GET['tipo'])){$tipo = $_GET['tipo'];}else {$tipo = 0;}
        if(isset($_GET['subtipo'])){$subtipo = $_GET['subtipo'];}else {$subtipo = 0;}
        // if(isset($_get['incompletos'])){$incompletos = $_get['incompletos'];}else {$incompletos = 'C';}
        //seleccion
        //if (!empty($_GET['texto-s'])) {$texto_s = $_GET["texto-s"];}else {$texto_s = null;}
        //ORDENAR POR PRECIO
        if(isset($_GET['ord'])) {$ordenamiento = $_GET['ord'];}else {$ordenamiento = null;}
        if(isset($_GET["bodega"])){$bodega = $_GET["bodega"];}else {$bodega = null;}
        $rines = $model->BusquedaRines($iDMarcaCar,$AnioCar,$iDModeloCar,$versionCar,$rinCar,$id,$cantPernos,$distPernos,$rinPorTamano,$idMarcasRines,$idanchos,$idcb,$idet,$ordenamiento,$remate,$incompletos,$tipo,$subtipo,$paginador,$bodega);
        return $this->getResponse(
                [
                    'msg'     => 'SUCCESS',
                    'message' => 'Rines recuperado con exito',
                    'rines'   => $rines
                ]
            );
       /* } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar los rines con los filtros especificadas'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }*/

    }
//-------------------------------------------------------------------------------     
// create a product
 /*   public function create()
    {
        $model = new ProductModel();
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price')
        ];
        $data = json_decode(file_get_contents("php://input"));
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
    */
//-------------------------------------------------------------------------------    
// update product
  /*  public function update($id = null)
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
                'error'   => null,
                'messages' => [
                    'success' => 'Data Updated'
                    ]
                ];
                return $this->respond($response);
    }
    */
//-------------------------------------------------------------------------------------    
// delete product
  /*  public function delete($id = null)
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
  */
}