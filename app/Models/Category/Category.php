<?php
namespace App\Models\Category;

use App\Models\ActiveRecordEnt;
use App\Services\DB;
use App\Exceptions\ErArgumentException;

class Category extends ActiveRecordEnt
{
    protected $alias;
    protected $title;
    protected $description;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias)
    {
        $this->alias = $alias;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public static function create (object $formCategory)
    {
        if (!$formCategory->name) {
            throw new ErArgumentException('Не указано название раздела');
        }
        if (!$formCategory->alias) {
            throw new ErArgumentException('Не указан алиас');
        }
        if (!preg_match('/^[a-z\-]+$/', $formCategory->alias)) {
            throw new ErArgumentException('Алиас может состоять из символов a-z и -');
        }

        $formCategory->name = filter_var($formCategory->name, FILTER_SANITIZE_SPECIAL_CHARS);

        $category = new Category();

        $category->setName($formCategory->name);
        $category->setAlias($formCategory->alias);

        $category->save();
        return $category;
    }
    
    public static function update (object $formCategory)
    {
        if (!filter_var($formCategory->id, FILTER_VALIDATE_INT)) {
            throw new ErArgumentException('id категории указывается числом');
        }
        if (!$formCategory->name) {
            throw new ErArgumentException('Не указано название раздела');
        }
        if (!$formCategory->alias) {
            throw new ErArgumentException('Не указан алиас');
        }
        if (!preg_match('/^[a-z\-]+$/', $formCategory->alias)) {
            throw new ErArgumentException('Алиас может состоять из символов a-z и -');
        }

        $formCategory->name = filter_var($formCategory->name, FILTER_SANITIZE_SPECIAL_CHARS);
        $formCategory->title = filter_var(
            $formCategory->title,
            FILTER_SANITIZE_SPECIAL_CHARS
        );
        $formCategory->description = filter_var(
            $formCategory->description,
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $category = Category::getById($formCategory->id);
        
        $category->setName($formCategory->name);
        $category->setAlias($formCategory->alias);
        $category->setTitle($formCategory->title);
        $category->setDescription($formCategory->description);

        return $category->save();
    }

    protected static function getTable (): string
    {
        return 'categories';
    }
}
