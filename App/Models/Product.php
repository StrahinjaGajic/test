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

    public function withComments($limit = 100)
    {
        $sql = "SELECT 
          products.id as id, 
          products.image as image, 
          products.title as title, 
          products.description as description, 
          products.created_at as created_at, 
          comments.name as comment_name, 
          comments.email as comment_email, 
          comments.text as comment_text
        FROM products
        LEFT JOIN comments
        ON products.id = comments.product_id limit {$limit}";

        $data = self::$DB->query($sql)->rowCount();
dd($data);
        $this->formatModelData($data);
    }
}