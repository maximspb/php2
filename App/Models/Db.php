<?php
namespace Models;

use PDO ;

class Db
{
    protected $dbh;
    public function __construct()
    {
        $this->dbh = new PDO(
            'mysql:host=localhost; dbname=php1; 
            charset=UTF8',
            'root',
            '123'
        )
        or die('Ошибка соединения');
    }

    public function execute(string $query, array $params = [])
    {
        $sth = $this->dbh->prepare($query);
        return $sth->execute($params);
    }

    public function query(string $sql, array $params = [], $class = \stdClass::class)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $class);
    }
}