<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UserModel extends Model
{
    //protected $schema = $db->setPrefix('[sys]');
    protected $table = '[syslogins]';

    protected $allowedFields = [
        'name',
        'password',
    ];
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }
//----------------------------------------------------------------------------------------------------------
    public function findUserByName(string $name)
    {
        $db = db_connect();
        $sql = "SELECT name FROM sys.syslogins WHERE name = '".$name."'";
        $user = $db->query($sql)->getResult();
        if (!$user) 
            throw new Exception('El usuario no existe ');

        return $user;
    }
//----------------------------------------------------------------------------------------------------------
    public function validarLogin($name,$pass) {
        try {
            $db = db_connect();
            $sql = "{CALL [CLSA].[sp_Login] (?,?)}";
            $params = array($name,$pass); 
            $query = $db->query($sql, $params)->getResult();
            return $query;
		} catch (Exception $e) {
			die('Error GlobalModel(validarusuario) '.$e->getMessage());
		}finally{
			$query = null;
		}
    }
//----------------------------------------------------------------------------------------------------------
    public function BodegasUsuarios($sistema=null, $usuario=null,$bodega=null,$grupo=null)
    {
      try {
          $db = db_connect();
          $sql = "{CALL [CLSA].[sp_getBodegasUsuario](?,?,?,?)}";
          $params = array($sistema, $usuario,$bodega,$grupo);  
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
//----------------------------------------------------------------------------------------------------------
    public function sp_getModulosUsuario($pUsuario, $pTipoSistema,$pTipoMenu)
    {
      try {
        
          $db = db_connect();
          $sql = "CLSA.sp_getModulosUsuario ?,?,?";
          $params = array($pUsuario,$pTipoSistema,$pTipoMenu);  
          $query = $db->query($sql,$params)->getResult();
          return $query;
      } catch (Exception $e) {
        die('Error GlobalModel(validarusuario) '.$e->getMessage());
      }finally{
        $query = null;
      }
    }
}