<?php namespace App\Models;

use CodeIgniter\Model;

class GetMetasVendedor_Model extends Model
{
   //------------------------------------------------------------
   //  BUSQUEDA METAS POR VENDEDOR NORWING
   //------------------------------------------------------------
    public function GetMetasVendedor($pTIPORPT= NULL, $pVendedor= NULL)
    {
      try {
          $db = db_connect();
          $params = array($pTIPORPT, $pVendedor);
          $sql = "Ecommerce.sp_DashboardNorwing ?,?";
          $query = $db->query($sql,$params)->getResult();
          return $query;
          //return $params;
          $query->free_result();
          $db->close();
      } catch (Exception $e) {
          die('Error GlobalModel(GetInformeVentaFacturadorEco) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
	
}
