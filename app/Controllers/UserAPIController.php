<?php
namespace App\Controllers;

use App\Models\User\User;
use App\Models\User\UserAuthService;
use App\Exceptions\ErArgumentException;

class UserAPIController extends APIController
{
    public function registration()
    {
        try {
            $request = $this->useRequest(file_get_contents('php://input'));

            $user = User::signUp($request);
            
            if ($user->getId()) {
                echo json_encode($this->response);
            }
        } catch (ErArgumentException $e) {
            $this->errorResponse($e);
        }
    }

    public function login()
    {
        try {
            $request = $this->useRequest(file_get_contents('php://input'));

            $user = User::login($request);

            UserAuthService::createToken($user);
            echo json_encode($this->response);
        } catch (ErArgumentException $e) {
            $this->errorResponse($e);
        }
    }

    public function logout()
    {
        UserAuthService::deleteToken();
        echo json_encode($this->response);
    }
}
