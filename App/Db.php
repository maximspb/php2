<?php
namespace App;


use App\Exceptions\DbRequestException;
use App\Exceptions\InsertRecordException;
use \PDO ;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
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
        $mailConfig = $config->getMailConfig();
        try {
            $this->dbh = new PDO(
                'mysql:host='.$params['host'].'; 
                dbname='.$params['dbname'].'; 
                charset='.$params['charset'],
                $params['username'],
                $params['passwd']
            );
        } catch (\Throwable $error) {
            $transport = (new Swift_SmtpTransport(
                $mailConfig['host'],
                $mailConfig['port'],
                $mailConfig['encryption']))
                ->setUsername($mailConfig['username'])
                ->setPassword($mailConfig['password'])
            ;

            $mailer = new Swift_Mailer($transport);
            $message = (new Swift_Message('Критическая ошибка подключения к БД'))
                ->setFrom([$mailConfig['username'] => 'Admin'])
                ->setTo([$mailConfig['username'] => 'Admin'])
                ->setBody($error->getMessage())
            ;

            $mailer->send($message);
            throw new $error('На сайте ведутся технические работы. Зайдите позже');
        }
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
        try {
            $sth->execute($params);
        } catch (\Throwable $e) {
            throw new DbRequestException('Ошибка добавления записи');
        }
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

    public function queryEach(string $sql, array $params = [], $class = \stdClass::class)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        $sth->setFetchMode(PDO::FETCH_CLASS, $class);
        while ($data = $sth->fetch()) :
            yield $data;
        endwhile;
    }

    public function lastId()
    {
        return $this->dbh->lastInsertId();
    }
}
