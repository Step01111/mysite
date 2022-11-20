<?php
namespace App\Controllers;

use App\Models\User\User;
use App\Models\User\UserAuthService;

abstract class AbstractController
{
    protected $user;

    public function __construct()
    {
        $this->user = UserAuthService::getUserByToken();
    }
}
