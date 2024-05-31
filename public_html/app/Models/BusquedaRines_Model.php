<?php namespace App\Models;

use CodeIgniter\Model;

class BusquedaRines_Model extends Model
{
    //-------------------------------------------------------------
    public function BusquedaRines($p_idmarca,$p_year,$p_idmodelo,$p_version,$p_tamano_rin,$p_tipobusqueda,$p_cantidad_pernos_vehiculo,$p_distancia_pernos_vehiculo,$p_tamano_rin_por_tamano,$p_idmarcas,$p_idanchos,$p_idcb,$p_idet,$ordenamiento,$premate,$pincompleto,$ptipo,$psubtipo,$paginador,$pbodega)
    {
      try {
        $db = db_connect();
        $params = array($p_idmarca,$p_year,$p_idmodelo,$p_version,$p_tamano_rin,$p_tipobusqueda,$p_cantidad_pernos_vehiculo,$p_distancia_pernos_vehiculo,$p_tamano_rin_por_tamano,$p_idmarcas,$p_idanchos,$p_idcb,$p_idet,$ordenamiento,$premate,$pincompleto,$ptipo,$psubtipo,$paginador,$pbodega);
        //$sql = "ECOMMERCE.sp_getBusquedaRines ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
        $sql = "ECOMMERCE.sp_getBusquedaRines1 ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
        $query = $db->query($sql,$params)->getResult();
        return $query;
       } catch (Exception $e) {
        die('Error GlobalModel(GetClienteNit) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
    //-------------------------------------------------------------
}