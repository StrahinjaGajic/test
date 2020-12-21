<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Core\Controller;
use \Core\View;

/**
 *
 * home controller
 *
 */
class HomeController extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $product = new Product();
        $comment = new Comment();

        $products = $product->getAll();
        $comments = $comment->getAll();

        View::renderTemplate('home/index.html',[
            'products' => $products,
            'comments' => $comments
        ]);
    }
}
