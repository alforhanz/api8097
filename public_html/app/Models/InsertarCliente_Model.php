<?php namespace App\Models;

use CodeIgniter\Model;
use Exception;

class InsertarCliente_Model extends Model
{
    public function insertarcliente($tipoContribuyente, $nit, $razon_social, $alias, $creado_por, $dv, $tipoClienteFE, $telefono, $sucursal, $fax, $mail, $direccion, $notas, $nivel_precio, $ruta)
    {
      try {
          $db = db_connect();
          $params = array($tipoContribuyente,  $nit,  $razon_social,  $alias,  $creado_por,  $dv, $tipoClienteFE, $telefono,  $sucursal,  $fax,  $mail,  $direccion,  $notas,  $nivel_precio,  $ruta);
          $sql = "ECOMMERCE.cr_InsertarCliente ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
          $query = $db->query($sql,$params)->getResult();
		  //$query = $db->query($sql,$params)->getRow();
		  //var_dump($query->INFORMACION); 
		  //return $resultsArray;
		  //$result->INFORMACION;		  
		  return $query[0]->INFORMACION;
		  //return $query->INFORMACION;
		  //return $query;
		  // $query->free_result();
          $db->close();

      } catch (Exception $e) { 
        // die('error globalmodel(insertarcliente)'.$e->getmessage());
		// // return "ERROR";
		// return $query[0]->INFORMACION;
		$query = null;  
        echo "Error: " . $e->getMessage();
      }
	  
    }
}
