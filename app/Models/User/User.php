<?php
namespace App\Models\User;

use App\Models\ActiveRecordEnt;
use App\Exceptions\ErArgumentException;

class User extends ActiveRecordEnt
    {
    protected $mail;
    protected $password_hash;
    protected $is_admin;
    protected $auth_token;

    public function getMail(): string
        {
        return $this->mail;
        }
    
    public function getPasswordHash(): string
        {
        return $this->password_hash;
        }
    
    public function getAuthToken(): string
        {
        return $this->auth_token;
        }
    public function getAdmin(): int
        {
        return $this->is_admin;
        }
    
    public static function signUp (object $formReg): User
        {
        if (!$formReg->name) {
            throw new ErArgumentException('Не указано имя');
        }
        if (!$formReg->password) {
            throw new ErArgumentException('Не указан пароль');
        }
        if (!$formReg->mail) {
            throw new ErArgumentException('Не указан Email');
        }
        if (!filter_var($formReg->mail, FILTER_VALIDATE_EMAIL)) {
            throw new ErArgumentException('Имэйл указан неправильно');
        }
        if (static::getByColumn('mail', $formReg->mail)) {
            throw new ErArgumentException('Такой Email уже зарегистрирован');
        }

        $user = new User();

        $user->name = filter_var($formReg->name, FILTER_SANITIZE_SPECIAL_CHARS);
        $user->auth_token = sha1(random_bytes(100)).sha1(random_bytes(100));
        $user->mail = $formReg->mail;
        $user->password_hash = password_hash($formReg->password, PASSWORD_DEFAULT);

        $user->save();
        return $user;
        }
    
    public static function login (object $formLogin): User
        {
        if (!$formLogin->mail) {
            throw new ErArgumentException('Не указан имэйл');
        }
        if (!$formLogin->password) {
        throw new ErArgumentException('Не указан пароль');
        }

        $user = User::getByColumn('mail', $formLogin->mail);

        if (!$user || !password_verify($formLogin->password, $user->getPasswordHash())) {
            throw new ErArgumentException('Email или пароль указаны неверно');
        }

        $user->refreshAuthToken();
        $user->save();
        return $user;
        }
    
    private function refreshAuthToken ()
        {
        $this->auth_token = sha1(random_bytes(100)).sha1(random_bytes(100));
        }
    
    protected static function getTable (): string
        {
        return 'users';
        }
    }
?>