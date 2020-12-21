<?php

namespace App\Models;

use PDO;
use \Core\Model;

/**
 *
 * Example user model
 *
 */
class User extends Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        return self::$db->query('SELECT id, name FROM user')->fetchAll(PDO::FETCH_ASSOC);
    }
}
