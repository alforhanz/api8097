<?php
namespace App\Controllers;

use App\Models\InsertarCliente_Model;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class InsertarCliente extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Corregimientos
    * @return Response
    **/
    public function index()
    {
        $model = new InsertarCliente_Model();
          return $this->getResponse(
              [
                  'message' => 'Tipo recuperados con exito',
                  'Tipo' => 'index'
              ]
          );
    }
    /*
     * create a new cliente
     */
          public function create()
          {
            $model = new InsertarCliente_Model();

               //  $rules = [
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
               //}
              if(!empty($input['tipoClienteFE'])) {$tipoClienteFE = $input["tipoClienteFE"];}else {$tipoClienteFE = null;}
              if(!empty($input['tipo_contribuyente'])) {$tipoContribuyente = $input["tipo_contribuyente"];}else {$tipoContribuyente = null;}
              if(!empty($input['nit'])) {$nit = $input["nit"];}else {$nit = null;}
              if(!empty($input['razon_social'])) {$razonSocial = $input["razon_social"];}else {$razonSocial = null;}
              if(!empty($input['creado'])) {$creado = $input["creado"];}else {$creado = null;}
              if(!empty($input['dv'])) {$dv = $input["dv"];}else {$dv = null;}
              if(!empty($input['telefono'])) {$telefono = $input["telefono"];}else {$telefono = null;}
              if(!empty($input['sucursal'])) {$sucursal = $input["sucursal"];}else {$sucursal = null;}
              if(!empty($input['fax'])) {$fax = $input["fax"];}else {$fax = null;}
              if(!empty($input['mail'])) {$email = $input["mail"];}else {$email = null;}
              if(!empty($input['direccion'])) {$direccion = $input["direccion"];}else {$direccion = null;}
              if(!empty($input['notas'])) {$notas = $input["notas"];}else {$notas = null;}
              if(!empty($input['nivelPrecio'])) {$nivelPrecio = $input["nivelPrecio"];}else {$nivelPrecio = null;}
              if(!empty($input['ruta'])) {$ruta = $input["ruta"];}else {$ruta = null;}
              $alias = $razonSocial;
              $model = new InsertarCliente_Model();
			  $email = str_replace("", "", $email);
              $newcliente = $model->insertarcliente($tipoContribuyente, $nit, $razonSocial, $alias, $creado, $dv, $tipoClienteFE, $telefono, $sucursal, $fax, $email, $direccion, $notas, $nivelPrecio, $ruta);
				if($newcliente !== 'CLIENTE EXISTENTE') 
				{ 
				  return $this->getResponse
					(
					  [
						'msg'     => 'SUCCESS', 
						'message' => $newcliente, 
						//'cliente'  => $newcliente
					  ]
					  
					);
				}
				else
				{
				  return $this->getResponse
					(
					  [
						'msg'     => 'FAILED',
						'message' => $newcliente, 
					  ]
					);
				}
			    
          }
}
