<?php
namespace App\Controllers;

use App\Models\ActualizarCliente_Model;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class ActualizarCliente extends BaseController
{
    protected $format = 'json';
    /**
    * Get all Corregimientos
    * @return Response
    **/
    public function index()
    {
        $model = new ActualizarCliente_Model();
          return $this->getResponse(
              [
                  'message' => 'Tipo recuperados con exito',
                  'Tipo' => 'index'
              ]
          );
    }

    public function update($id)
    {
        try {
            $model = new ActualizarCliente_Model();
            //$model->findClientById($id);

            $input = $this->getRequestInput($this->request);

            if(!empty($input['user'])) {$pUser = $input["user"];}else {$pUser = null;}
            if(!empty($input['updatetxt_cliente'])) {$pCliente = $input["updatetxt_cliente"];}else {$pCliente = null;}
            if(!empty($input['updatetxt_razonsocial'])) {$pRazonSocial = $input["updatetxt_razonsocial"];}else {$pRazonSocial = null;}
            if(!empty($input['updatetxt_alias'])) {$pAlias = $input["updatetxt_alias"];}else {$pAlias = null;}
            if(!empty($input['updatetxt_tipocliente'])) {$pTipoClienteFE = $input["updatetxt_tipocliente"];}else {$pTipoClienteFE = null;}
            if(!empty($input['updatetxt_contribuyente'])) {$pContribuyente = $input["updatetxt_contribuyente"];}else {$pContribuyente = null;}
            if(!empty($input['updatetxt_ruc'])) {$pRuc = $input["updatetxt_ruc"];}else {$pRuc = null;}
            if(!empty($input['updatetxt_rucnew'])) {$pRucNew = $input["updatetxt_rucnew"];}else {$pRucNew = null;}
            if(!empty($input['updatetxt_dv'])) {$pDv = $input["updatetxt_dv"];}else {$pDv = null;}
            if(!empty($input['updatetxt_telefono'])) {$pTelefono = $input["updatetxt_telefono"];}else {$pTelefono = null;}
            if(!empty($input['updatetxt_email'])) {$pEmail = $input["updatetxt_email"];}else {$pEmail = null;}
            //$model->update($id, $input);
			$pEmail = str_replace("", "", $pEmail);
			
            $client = $model->cr_InsertUpdateNit($pCliente, $pRucNew, $pRuc, $pRazonSocial, $pAlias, $pTipoClienteFE, $pTelefono, $pEmail, $pContribuyente, $pDv, $pUser);

            return $this->getResponse(
                [
                    'msg' => 'SUCCESS',
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
          
}
