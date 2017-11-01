<?php
namespace App;

use \PDO ;

use App\Config;

class Db
{
    protected $dbh;
    public function __construct()
    {
        $config = Config::getInstance();
        $params = $config->getData();
        $this->dbh = new PDO(
            'mysql:host='.$params['host'].'; 
            dbname='.$params['dbname'].'; 
            charset='.$params['charset'],
            $params['username'],
            $params['passwd']
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