<?php namespace App\Controllers;

use App\Models\SeccionesModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Secciones extends BaseController
{
    protected $format = 'json';
       /**
    * Get all MarcasVehiculo
    * @return Response
    **/ 
    public function index()
    {
        $model = new SeccionesModel();
        return $this->getResponse(
            [
                'message' => 'Marcas recuperados con exito',
                'marcas' => $model->findMarcasAll()
            ]
        );
    }
    // get single product
    public function show($key=null, $id = null)
    {
        //  try {
            $model        = new SeccionesModel();
            if(!empty($_GET['tipo'])) {$tipo = $_GET["tipo"];}else {$tipo = null;}
            if(!empty($_GET['subtipo'])) {$subtipo = $_GET["subtipo"];}else {$subtipo = null;}
            if(!empty($_GET['subtipo2'])) {$subtipo2 = $_GET["subtipo2"];}else {$subtipo2 = null;}
            if(!empty($_GET['paginador'])) {$paginador = $_GET["paginador"];}else {$paginador = 0;}
            if(!empty($_GET['ordenamiento'])) {$ordenamiento = $_GET["ordenamiento"];}else {$ordenamiento = null;}
            if(!empty($_GET['bodega'])) {$bodega = $_GET["bodega"];}else {$bodega = null;}
            if(!empty($_GET['art'])) {$art = $_GET["art"];}else {$art = null;}
            if(!empty($_GET['user'])) {$pUser = $_GET["user"];}else {$pUser = null;}
            
            switch ($key) {
              case '1':
                      $secciones    = $model->findTipoById($id);
                break;
              case '2':
                      $secciones = $model->findSubTipoById($id,$tipo);
                break;
              case '3':
                      $secciones    = $model->BusquedaSecciones($id, $tipo, $subtipo, $subtipo2, $paginador, $ordenamiento, $bodega);
                break;
              case '4':
                      $secciones    = $model->precioArticulo($pUser, $art);
                break;
              default:
                # code...
                break;
            }
          

            return $this->getResponse(
                [
                    'msg'       => 'SUCCESS',
                    'message'   => 'Secciones recuperado con exito',
                    'secciones' => $secciones,
                ]
            );
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