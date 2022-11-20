<?php
namespace App\Controllers;

class MainController extends PageController
{
    public function main()
    {
        $this->view->renderHTML('main/main.php');
    }
}
