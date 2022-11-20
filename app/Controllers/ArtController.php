<?php
namespace App\Controllers;

use App\Models\Art\Art;
use App\Exceptions\ErArgumentException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\NotFoundException;

class ArtController extends PageController
{
    public function view(string $categoryAlias, string $artAlias)
    {
        $art = Art::getByURL($categoryAlias, $artAlias);
        
        if(!$art) {
            throw (new NotFoundException());
        }

        $this->view->renderHTML('art/view.php', ['art' => $art]);
    }
    
    public function edit(int $id)
    {
        try {
            if (!$this->user) {
                throw new UnauthorizedException('Нужно авторизоваться на сайте');
            }
            if (!$this->user->getAdmin()) {
                throw new UnauthorizedException('Не достаточно прав для входа на страницу');
            }

            $art = Art::getById($id);

            if(!$art) {
                throw (new NotFoundException());
            }

            $this->view->renderHTML('art/edit.php', ['art' => $art]);
        } catch (UnauthorizedException $e) {
            $this->view->renderHTML('errors/401.php', ['error' => $e->getMessage()]);
        }
    }
}
