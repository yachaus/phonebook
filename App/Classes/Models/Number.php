<?php


namespace App\Classes\Models;


use App\Classes\Models\Db;

class Number
    extends Model
{
    const TABLE = 'phone_numbers';
    public $id;
    public $number;
    public $publish;

    public static function findByContactId($id)
    {
        $db = Db::instance();
        $data = [':id' => $id];
        $recordById = $db->query('SELECT ALL * FROM ' . static::TABLE . ' WHERE contact_id=:id', static::class, $data);
        return $recordById;
    }

    public function parse($data = [])
    {
        $parsed_arrays = [];
        foreach ($data as $k => $v) {
            $explode = explode('_', $k);
            if ($explode[0] == 'number') {
                if (isset($explode[2])) {
                    $id = $explode[2];
                    $publish = $v;
                } else {
                    $number = $v;
                    $array = [
                        'id' => $id,
                        'publish' => $publish,
                        'number' => $number,
                        'contact_id' => $data['id']
                    ];
                    $parsed_arrays[] = $array;
                }
            }
        }
        return $parsed_arrays;
    }
}
