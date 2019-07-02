<?php

namespace App\Classes\Models;

use App\Classes\Models\Db;
use App\Classes\Models\Model;
use App\Classes\Models\Email;
use App\Classes\Models\Number;

class Contact
    extends Model
{
    const TABLE = 'contacts';

    public $id;
    public $firstname;
    public $lastname;
    public $address;
    public $city;
    public $country;
    public $password;
    public $login;
    public $publish;

    public function __get($name)
    {
        switch ($name) {
            case 'emails' :
                {
                    return Email::findByContactId($this->id);
                }
            case 'numbers' :
                {
                    return Number::findByContactId($this->id);
                }
        }
    }

    public static function signIn($password, $login)
    {
        $db = Db::instance();
        $data =
            [
                ':password' => $password,
                ':login' => $login
            ];
        $contact = $db->query('SELECT ALL * FROM ' . static::TABLE . ' WHERE password =:password AND login =:login', static::class, $data);
        return $contact[0];
    }
}