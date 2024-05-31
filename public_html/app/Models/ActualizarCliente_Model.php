<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ActualizarCliente_Model extends Model
{
    public function cr_InsertUpdateNit($pCliente, $pRucNew, $pRuc, $pRazonSocial, $pAlias, $pTipoClienteFE, $pTelefono, $pEmail, $pContribuyente, $pDv, $pUser)
    {
      // try {
          $db = db_connect();
          $params = array($pCliente, $pRucNew, $pRuc, $pRazonSocial, $pAlias, $pTipoClienteFE, $pTelefono, $pEmail, $pContribuyente, $pDv, $pUser);
          $sql = "ECOMMERCE.cr_InsertUpdateNit ?,?,?,?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
          // echo "<pre>";
          // print_r($params);
          // echo "</pre>";
          // die();
          return $query[0]->INFORMACION;
          $query->free_result();
          $db->close();
      // } catch (Exception $e) {
      //   die('Error GlobalModel(insertarcliente) '.$e->getMessage());
      // }finally{
      //   return false;
      // }
    }
}
