<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\User;
use \Core\View;

/**
 *
 * Home controller
 *
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
//        new User();
        $commets = (new Comment())->getAll();

        View::renderTemplate('Home/index.html');
    }
}
