<?php namespace App\Models;

use CodeIgniter\Model;

class LlantasModel extends Model
{
    public function getBusquedaLlantas($iDMarcaCar,$AnioCar,$iDModeloCar,$versionCar,
    $rinCar,$tipoBusqueda,$anchoLlantas,$perfilLlantas,$rinLlantas, $idMarcasLlantas,
    $ordenamiento,$remate,$tipo,$subtipo, $paginador,$bodega) {
        try {
            $db = db_connect();
            $sql = "ECOMMERCE.sp_getBusquedaLlantas ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
            $params = array($iDMarcaCar,$AnioCar,$iDModeloCar,$versionCar,$rinCar,$tipoBusqueda,$anchoLlantas,$perfilLlantas,$rinLlantas, $idMarcasLlantas,$ordenamiento,$remate,$tipo,$subtipo, $paginador,$bodega); 
            $query = $db->query($sql, $params)->getResult();
            return $query;

		} catch (Exception $e) {
			die('Error GlobalModel(validarusuario) '.$e->getMessage());
		}finally{
			$query = null;
		}
    }
    //-----------------------------------------------------------------------------------------
    public function sp_getMarcasVehiculoLlantas() {
        try {
            $db = db_connect();
            $params = array(); 
            $sql = "{CALL ECOMMERCE.sp_getMarcasVehiculoLlantas ()}";
            $query = $db->query($sql,$params)->getResult();
            return $query;
		} catch (Exception $e) {
			die('Error GlobalModel(validarusuario) '.$e->getMessage());
		}finally{
			$query = null;
		}
    }
    //-----------------------------------------------------------------------------------------
    public function findAnioById($IDMarca) {
        try {
            $db = db_connect();
            $params = array($IDMarca); 
            $sql = "ECOMMERCE.sp_getAnioVehiculoLlantas ?";
            $query = $db->query($sql,$params)->getResult();
            return $query;
		} catch (Exception $e) {
			die('Error GlobalModel(validarusuario) '.$e->getMessage());
		}finally{
			$query = null;
		}
    }
    //-----------------------------------------------------------------------------------------
    public function findModelosById($IDMarca, $Anio) {
        try {
              $db = db_connect();
              $params = array($IDMarca, $Anio); 
              $sql = "ECOMMERCE.sp_getModeloVehiculoLlantas ?,?";
              $query = $db->query($sql,$params)->getResult();
              return $query;
            } catch (Exception $e) {
              die('Error GlobalModel(validarusuario) '.$e->getMessage());
            }finally{
              $query = null;
            }
    }
    //-----------------------------------------------------------------------------------------
    public function findVersionesRinesById($IDMarca, $Anio, $IDModelo, $IDConsulta) {
        try {
              $db = db_connect();
              $params = array($IDMarca, $Anio, $IDModelo, $IDConsulta);
              $sql = "ECOMMERCE.sp_getVersionTamanoVehiculoLlantas ?,?,?,?";
              $query = $db->query($sql,$params)->getResult();
              return $query;
            } catch (Exception $e) {
              die('Error GlobalModel(validarusuario) '.$e->getMessage());
            }finally{
              $query = null;
            }
    }
    //-----------------------------------------------------------------------------------------
    public function sp_getAnchoLlantas() {
        try {
              $db = db_connect();
              $params = array();
              $sql = "ECOMMERCE.sp_getAnchoLlantas";
              $query = $db->query($sql,$params)->getResult();
              return $query;
            } catch (Exception $e) {
              die('Error GlobalModel(validarusuario) '.$e->getMessage());
            }finally{
              $query = null;
            }
    }
    //----------------------------------------------------------------------------------------
     public function sp_getPerfilLLantas($IDAncho) {
        try {
              $db = db_connect();
              $params = array($IDAncho);
              $sql = "ECOMMERCE.sp_getPerfilLLantas ?";
              $query = $db->query($sql,$params)->getResult();
              return $query;
            } catch (Exception $e) {
              die('Error GlobalModel(validarusuario) '.$e->getMessage());
            }finally{
              $query = null;
            }
    }
    //----------------------------------------------------------------------------------------
    public function sp_getDiametroLLanta($ancho,$perfil) {
        try {
              $db = db_connect();
              $params = array($ancho,$perfil);
              $sql = "ECOMMERCE.sp_getDiametroLLanta ?,?";
              $query = $db->query($sql,$params)->getResult();
              return $query;
            } catch (Exception $e) {
              die('Error GlobalModel(validarusuario) '.$e->getMessage());
            }finally{
              $query = null;
            }
    }
}