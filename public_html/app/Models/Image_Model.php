<?php namespace App\Models;

use CodeIgniter\Model;

class Image_Model extends Model
{
    //------------------------------------------------------------
    //  BUSQUEDA DETALLE DEL PRODUCTO MODULO DE DETALLEPRODUCTO
    //------------------------------------------------------------
   public function getImage($id=null)
    {
      try {
          $db = db_connect();
          $sql = "SELECT REPLACE(REPLACE(t2.articulo ,' ','-'), '/', '-') AS FOTO FROM [BREMEN].articulo_foto t1 INNER JOIN [BREMEN].articulo t2 ON t1.ARTICULO = t2.ARTICULO WHERE REPLACE(t1.ARTICULO,'/','-') = REPLACE('".$id."','/','-')";
          $query = $db->query($sql)->getResult();
        if($query){
            return $query[0]->FOTO;
        }else{
          return null;
        }
          
      } catch (Exception $e) {
          die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }

    


}