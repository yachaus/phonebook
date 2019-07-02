<?php

namespace App\Classes\Models;

use App\Singleton;

class Db
{
    use Singleton;

    protected $dbh;

    protected function __construct()
    {
            $this->dbh = new \PDO('mysql:host=localhost; dbname=phonebook', 'root', 'root');
    }

    public function execute($sql, $params = [])
    {
            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($params);
            return $res;
    }

    public function query($sql, $class, $params = [])
    {
            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($params);
            if (false !== $res) {
                return $sth->fetchAll(8, $class);
            } else
                return false;
    }

    public function queryEach($sql, $class, $params = [])
    {
        $sth = $this->dbh->prepare($sql,[\PDO::ATTR_CURSOR => \PDO::CURSOR_SCROLL]);
        $res = $sth->execute($params);
        $sth->setFetchMode(8, $class);
        if ($res == false) {
            throw new \App\Exceptions\Db('Ошибка в запросе');
        } else {
            while ($fetch = $sth->fetch()) {
                yield $fetch;
            }
        }
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId('id');
    }
}