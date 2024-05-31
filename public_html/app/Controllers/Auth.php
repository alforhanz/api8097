<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;
class Auth extends BaseController
{
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException

     * Authenticate Existing User
     * @return Response
     */
    public function login()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[6]|max_length[255]|validateUser[username, password]'
        ];
        $errors = [
            'password' => [
                'validateUser' => 'Credenciales de inicio de sesión no válidas'
            ]
        ];
        $input = $this->getRequestInput($this->request); // recibo por POST los parametros [name],[password]
        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }
        return $this->getJWTForUser($input['username']);
    }

    private function getJWTForUser(
        string $name,
        int $responseCode = ResponseInterface::HTTP_OK
    )
    {
        try {
			$pass=null;
            $model  = new UserModel();
            $user   = $model->findUserByName($name);
			$resultvalidarLogin = $model->validarLogin($user[0]->name,$pass);
			// Obtener el valor de la columna "COMPANIA" del resultado
			// $compania = $resultvalidarLogin[0]->COMPANIA;
            $bodega = $model->BodegasUsuarios('E', $user[0]->name,null,null);
            $privilegios = $model->sp_getModulosUsuario($user[0]->name, 'W',null);

            foreach($privilegios as $key) {
              $vPriv[] = array(
                          'idAccesModule'     => $key->MODULO,
                          'moduleDescription'  => $key->DESCRIPCION
                        );
            }


            
            unset($user['password']);

            helper('jwt');
         //   $key = getenv('JWT_SECRET');

            return $this
                ->getResponse(
                    [
                        'msg'          => 'SUCCESS',
                        'message'      => 'Usuario autenticada exitosamente',
                        'username'     => $user[0]->name,
						// 'compania'     => $compania,
                        'access_token' => getSignedJWTForUser($name),
                        'bodega'       => $bodega,
                        'priv'         => $vPriv
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'msg'   => 'FAILED',
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
}