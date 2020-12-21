<?php

namespace Core;

/**
 *
 * Base model
 *
 */
class Model
{
    protected static $DB = null;

    protected $className = null;

    public function __construct()
    {
        self::$DB = DB::getInstance();

        self::$DB->setCurrentModelName(get_class($this));
    }

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function fetchAll()
    {
    }
}
