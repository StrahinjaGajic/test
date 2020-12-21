<?php

namespace Core;


use App\Config;
use PDO;
use PDOException;

class DB
{
    /**
     * @var \PDO $pdo
     */
    private $pdo;

    /**
     * @var \PDO $stmt statement
     */
    private $stmt;

    /**
     * Class instance
     *
     * @var DB $instance
     */
    private static $instance;

    /**
     * Model name
     *
     * @var null|string $currentModel
     */
    private $currentModel = null;

    /**
     * Create database instance
     *
     * Database connection details are taken from Config
     */
    private function __construct()
    {
        $params = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';

        $this->pdo = new PDO($params, Config::DB_USER, Config::DB_PASSWORD, Config::DB_OPTIONS);
    }

    /**
     * Singleton
     *
     * Create object only if instance does't already exists
     *
     * @return DB
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
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
     * Get all rows as objects
     *
     * @return null | array [objects]
     */
    public function get()
    {
        $this->setClassFetchMode();

        $this->execute();

        return $this->stmt->fetchAll();
    }

    /**
     * Get single row as object
     *
     * @return null | object
     */
    public function single()
    {
        $this->setClassFetchMode();

        $this->execute();

        return $this->stmt->fetch();
    }

    /**
     * Count rows
     *
     * @return integer
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    /**
     *
     * Set PDO fetch mode into specific class
     *
     */
    private function setClassFetchMode()
    {
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $this->currentModel);
    }

    /**
     * Set current model name.
     * We use this name for fetch mode.
     *
     * @param $model
     */
    public function setCurrentModelName(string $model): void
    {
        $this->currentModel = $model;
    }
}