<?php

namespace App\Models;

use Core\Model;

class Comment extends Model
{
    protected $table = 'comment';

    protected $fillable = [
        'id',
        'product_id',
        'name',
        'email',
        'text',
        'active',
        'created_at'
    ];

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public function getAll()
    {
        $test = self::$DB->query('SELECT * FROM '.$this->table)->get();

        dd($test);
    }
}