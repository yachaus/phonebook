<?php

namespace App\Classes\Models;

use App\Classes\Models\Db;

class Email extends Model
{
    const TABLE = 'emails';
    public $id;
    public $email;
    public $publish;

    public function parse($data = [])
    {
        $parsed_arrays = [];
        foreach ($data as $k => $v) {
            $explode = explode('_', $k);
            if ($explode[0] == 'email') {
                if (isset($explode[2])) {
                    $id = $explode[2];
                    $publish = $v;
                } else {
                    $email = $v;
                    $array = [
                        'id' => $id,
                        'publish' => $publish,
                        'email' => $email,
                        'contact_id' => $_SESSION['user_id']
                    ];
                    $parsed_arrays[] = $array;
                }
            }
        }
        return $parsed_arrays;
    }
}
