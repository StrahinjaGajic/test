<?php

namespace App\Controllers;

use App\Models\Comment;
use Core\Controller;

/**
 *
 * Comment controller
 *
 */
class CommentController extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function storeAction()
    {
        $comment = new Comment();

        $comment->create($_POST);

        return redirect('');
    }
}
