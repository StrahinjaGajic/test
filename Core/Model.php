<?php

namespace Core;

use PDO;
use App\Config;

/**
 *
 * Base model
 *
 */
class Model
{
    protected static $DB = null;

    public function __construct()
    {
        self::getDB();
    }

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDB()
    {
        if (self::$DB === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            self::$DB = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            // Throw an Exception when an error occurs
            self::$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
}
