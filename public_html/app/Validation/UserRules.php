<?php

namespace App\Validation;
use App\Models\UserModel;
use Exception;

class UserRules
{
    public function validateUser(string $str, string $fields, array $data): bool
    {
        try {
            $model = new UserModel();
            $user = $model->validarLogin($data['username'],$data['password']);
            if($user) return true; else return false;
        } catch (Exception $e) {
            return false;
        }
    }
}