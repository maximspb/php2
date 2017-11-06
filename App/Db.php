<?php
namespace App;

use \PDO ;

use App\Config;

class Db
{
    /**
     * объект PDO
     * @var PDO
     */
    protected $dbh;

    /**
     * в конструкторе переданы данные конфига
     * Db constructor.
     */
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

    /**
     * метод запроса к базе без возврата данных
     * @param string $query
     * @param array $params
     * @return bool
     */
    public function execute(string $query, array $params = [])
    {
        $sth = $this->dbh->prepare($query);
        return $sth->execute($params);
    }

    /**
     * метод запроса к БД, возвращающий массив объектов
     * @param string $sql
     * @param array $params
     * @param string $class
     * @return array
     */
    public function query(string $sql, array $params = [], $class = \stdClass::class)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $class);
    }
     public function lastId()
    {
        return $this->dbh->lastInsertId();
    }
}