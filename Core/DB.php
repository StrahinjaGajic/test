<?php

namespace Core;


use App\Config;
use PDO;
use PDOException;

class DB
{
    /**
     * @var \PDO
     */
    private $pdo;
    /**
     * @var \PDO statement
     */
    private $stmt;
    /**
     * @var string
     */
    private $error;
    /**
     * Class instance
     *
     * @var DB
     */
    private static $instance;

    /**
     * Create database instance
     */
    private function __construct(){
        $params = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $this->pdo = new PDO($params, Config::DB_USER, Config::DB_PASSWORD, $options);
    }

    /**
     * Singleton
     * Create object only if instance does't already exists
     *
     * @param string $type
     * @param string $host
     * @param string $dbname
     * @param string $username
     * @param string $password
     * @return Database
     */
    public static function getInstance(string $type, string $host, string $dbname, string $username, string $password)
    {
        if (self::$instance === null) {
            self::$instance = new self($type, $host, $dbname, $username, $password);
        }
        return self::$instance;
    }

    /**
     * Make prepared statement
     *
     * @param $sql
     * @return $this
     */
    public function query($sql){
        $this->stmt = $this->pdo->prepare($sql);

        return $this;
    }

    /**
     * Bind params to prepared statement if needed
     *
     * @param $param
     * @param $value
     * @param null $type
     * @return $this
     */
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOLL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);

        return $this;
    }

    /**
     * Execute prepared statement
     *
     * @return mixed
     */
    public function execute(){
        return $this->stmt->execute();
    }

    /**
     * @param string $className
     * @return null | array [objects]
     */
    public function resultSet(string $className){
        $this->setFetchMode($className);
        $this->execute();
        return $this->stmt->fetchAll();
    }

    /**
     * @param string $className
     * @return null | object
     */
    public function single(string $className){
        $this->setFetchMode($className);
        $this->execute();
        return $this->stmt->fetch();
    }

    /**
     * @return integer
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    /**
     * Set PDO fetch mode into specific class
     *
     * @param string $className
     */
    private function setFetchMode(string $className)
    {
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $className);
    }
}