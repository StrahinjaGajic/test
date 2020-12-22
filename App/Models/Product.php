<?php

namespace App\Models;

use Core\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'image',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];
}