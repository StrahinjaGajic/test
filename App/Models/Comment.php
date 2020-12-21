<?php

namespace App\Models;

use Core\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'name',
        'email',
        'comment',
        'allowed',
        'created_at',
        'updated_at'
    ];

}