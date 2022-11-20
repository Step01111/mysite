<?php
namespace App\Controllers;

use App\Models\User\User;
use App\Exceptions\UnauthorizedException;

class UserController extends PageController
{
    public function admin()
    {
        try {
            if (!$this->user) {
                throw new UnauthorizedException('Нужно авторизоваться на сайте');
            }
            if (!$this->user->getAdmin()) {
                throw new UnauthorizedException('Не достаточно прав для входа на страницу');
            }
            
            $this->view->renderHTML('user/admin.php');
        } catch (UnauthorizedException $e) {
            $this->view->renderHTML('errors/401.php', ['error' => $e->GetMessage()]);
        }
    }
    
    public function registration()
    {
        $this->view->renderHtml('user/signUp.php');
    }
}
