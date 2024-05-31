<?php namespace App\Controllers;

use App\Models\Filtros_Model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Filtros extends BaseController
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
    public function show($key=null)
    {
          try {
            $model        = new Filtros_Model();
            if(!empty($_GET['codigofiltro'])) {$codigofiltro = $_GET["codigofiltro"];}else {$codigofiltro = null;}
            if(!empty($_GET['existencia'])) {$existencia = $_GET["existencia"];}else {$existencia = 0;}
            if(!empty($_GET['bodega'])) {$bodega = $_GET["bodega"];}else {$bodega = null;}
            if(!empty($_GET['art'])) {$art = $_GET["art"];}else {$art = null;}
            if(!empty($_GET['user'])) {$pUser = $_GET["user"];}else {$pUser = null;}
            switch ($key) {
              case '1':
                      $filtros    = $model->BusquedaFiltros($codigofiltro,$existencia);
                break;
              case '2':
                      $filtros = $model->BusquedaFiltrosIntercambios($codigofiltro);
                break;
              case '3':
                      $filtros = $model->BusquedaFiltrosCruzado($art,$bodega);
                break;
              default:
                # code...
                break;
            }
          

            return $this->getResponse(
                [
                    'msg'       => 'SUCCESS',
                    'message'   => 'Filtros recuperado con exito',
                    'filtros' => $filtros,
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar la modelos con los filtros especificadas'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
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