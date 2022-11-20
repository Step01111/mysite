<?php
namespace App\Controllers;

use App\Models\Category\Category;
use App\Models\Art\Art;
use App\Exceptions\ErArgumentException;
use App\Exceptions\NotFoundException;

class CategoryController extends PageController
{
    public function view(string $alias)
    {
        $category = Category::getByColumn('alias', $alias);
        if(!$category) {
            throw (new NotFoundException());
        }
        
        $art = Art::getByCategory($category->getId());
        
        $this->view->renderHTML('category/view.php',
            ['category' => $category, 'art' => $art]
        );
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

            $category = Category::getById($id);

            if(!$category) {
                throw (new NotFoundException());
            }

            $this->view->renderHTML('category/edit.php', ['category' => $category]);
        } catch (UnauthorizedException $e) {
            $this->view->renderHTML('errors/401.php', ['error' => $e->getMessage()]);
        }
    }
}
