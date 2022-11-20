<?php
namespace App\Models\Art;

use App\Models\ActiveRecordEnt;
use App\Services\DB;
use App\Exceptions\ErArgumentException;

class Art extends ActiveRecordEnt
{
    protected $text;
    protected $alias;
    protected $category_id;
    protected $title;
    protected $description;

    public function getText(): string
    {
        return $this->text;
    }

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

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setAlias(string $alias)
    {
        $this->alias = $alias;
    }
    
    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function setCategoryId (int $category)
    {
        $this->category_id = $category;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public static function getByURL(string $categoryAlias, string $artAlias)
    {
        $db = DB::getInstance();
        $sql = 'SELECT `art`.`id`, `art`.`name`, `art`.`text`, `art`.`title`,
            `art`.`description`, `categories`.`alias` as `category_alias`
            FROM `art`
            LEFT JOIN `categories`
            ON (`art`.`category_id` = `categories`.`id`)
            WHERE  `art`.`alias` = :alias
            LIMIT 1';
        
        $values = [':alias' => $artAlias];

        $result = $db->query($sql, $values, static::class);
        if ($result) {
            $art = $result[0];
        }
        if (isset($art) && $art->category_alias == $categoryAlias){
            return $art;
        } else {
            return null;
        }
    }

    public static function getByCategory(int $category)
    {
        $db = DB::getInstance();
        $sql = "SELECT `name`, `alias`
            FROM `art`
            WHERE `category_id` = " . $category;

        $result = $db->query($sql, '', static::class);
        return $result;
    }
    
    protected static function getTable(): string
    {
        return 'art';
    }
    
    public static function create (object $formArt)
    {
        if (!$formArt->name) {
            throw new ErArgumentException('Не указано название статьи');
        }
        if (!$formArt->category) {
            throw new ErArgumentException('Не указан раздел');
        }
        if (!filter_var($formArt->category, FILTER_VALIDATE_INT)) {
            throw new ErArgumentException('id раздела указывется числом');
        }
        if (!$formArt->alias) {
            throw new ErArgumentException('Не указан алиас');
        }
        if (!preg_match('/^[a-z\-]+$/', $formArt->alias)) {
            throw new ErArgumentException('Алиас может состоять из символов a-z и -');
        }
        
        $formArt->name = filter_var($formArt->name, FILTER_SANITIZE_SPECIAL_CHARS);

        $art = new Art();

        $art->setName($formArt->name);
        $art->setCategoryId($formArt->category);
        $art->setAlias($formArt->alias);
        
        $art->save();
        return $art;
    }
    
    public static function update (object $formArt)
    {
        if (!filter_var($formArt->id, FILTER_VALIDATE_INT)) {
            throw new ErArgumentException('id статьи указывается числом');
        }
        if (!$formArt->name) {
            throw new ErArgumentException('Не указано название статьи');
        }
        if (!$formArt->alias) {
            throw new ErArgumentException('Не указан алиас');
        }
        if (!preg_match('/^[a-z\-]+$/', $formArt->alias)) {
            throw new ErArgumentException('Алиас может состоять из символов a-z и -');
        }
        if (!$formArt->text) {
            throw new ErArgumentException('Отсутствует текст статьи');
        }
        
        $formArt->name = filter_var($formArt->name, FILTER_SANITIZE_SPECIAL_CHARS);
        $formArt->text = filter_var($formArt->text, FILTER_SANITIZE_SPECIAL_CHARS);
        $formArt->title = filter_var($formArt->title, FILTER_SANITIZE_SPECIAL_CHARS);
        $formArt->description = filter_var(
            $formArt->description,
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $art = Art::getById($formArt->id);

        $art->setName($formArt->name);
        $art->setAlias($formArt->alias);
        $art->setText($formArt->text);
        $art->setTitle($formArt->title);
        $art->setDescription($formArt->description);

        return $art->save();
    }
}
