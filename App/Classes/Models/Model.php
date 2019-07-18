<?php

namespace App\Classes\Models;

use App\Classes\Models\Db;

abstract class Model
{
    const TABLE = '';
    public $id;
    public $contact_id;

    /**
     * Метод, возвращающий запись по id из базы данных, в виде обьекта
     * @param $id int
     * @return mixed
     */
    public static function findById($id)
    {
        $db = Db::instance();
        $data = [':id' => $id];
        $recordById = $db->query('SELECT ALL * FROM ' . static::TABLE . ' WHERE id=:id', static::class, $data);
        if (isset($recordById[0])) {
            return $recordById[0];
        } else
            return NULL;
    }

    public static function findByContactId($id)
    {
        $db = Db::instance();
        $data = [':id' => $id];
        $recordById = $db->query('SELECT ALL * FROM ' . static::TABLE . ' WHERE contact_id=:id', static::class, $data);
        return $recordById;
    }

    /**
     * Метод, возвращающий все записи из базы данных, в виде обьекта
     * @return mixed
     */
    public static function findAll()
    {
        $db = Db::instance();
        $res = $db->queryEach(
            'SELECT * FROM ' . static::TABLE,
            static::class
        );
        return $res;
    }

    /**
     * Метод, Active Record, обновляет данные в базе данных
     */
    public function update()
    {
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if (isset($v)) {
                if ('id' == $k) {
                    continue;
                }
                $columns[] = $k;
                $values[$k] = $v;
            }
        }
        foreach ($values as $k => $v) {
            if (strpos($k, 'id') === false) {
                $string[] = $k . '=' . "'$v'";
            }
        }
        $string = implode(', ', $string);
        $sql = 'UPDATE ' . static::TABLE . ' SET ' . $string . ' WHERE ' . static::TABLE . '.id = ' . $this->id;
        $db = Db::instance();
        $db->execute($sql);
    }

    /**
     * Метод, Active Record, записывает данные в базу данных
     */
    public function insert()
    {
        $db = Db::instance();
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k;
            $values[':' . $k] = $v;
        }
        $sql = '
        INSERT INTO ' . static::TABLE . '
        (' . implode(',', $columns) . ')
        VALUES
        (' . implode(',', array_keys($values)) . ')
         ';
        $db->execute($sql, $values);
    }

    /**
     * Метод, Active Record, выбирает записать запись как новую или обновить ее
     */
    public function save()
    {
        if (!$this->isNew($this->id, $this->contact_id) or (static::class == 'App\Classes\Models\Contact')) {
            $this->update();
        } else $this->insert();
    }

    /**
     * Метод, проверяющий новый это обьект или старый
     * @return bool
     */
    public function isNew($id, $contact_id)
    {
        $class = static::class;
        return empty($class::findByContactIdAndId($contact_id, $id));
    }


    public function fill($data = [])
    {
        foreach ($this as $k => $v) {
            if (!empty($data[$k])) {
                $this->$k = $data[$k];
            }
        }
    }

    /**
     * Метод, Active Record, удаляет данные из базы данных
     */
    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE ' . static::TABLE . '.id = ' . $this->id;
        $db = Db::instance();
        $db->execute($sql);
    }

    public static function findByContactIdAndId($contact_id, $id){
        $db = Db::instance();
        $data = [
            ':id' => $id,
            ':contact_id' => $contact_id
        ];
        $recordById = $db->query('SELECT * FROM ' . static::TABLE . ' WHERE contact_id = :contact_id AND id = :id',
            static::class, $data);
        return $recordById;
    }
}
