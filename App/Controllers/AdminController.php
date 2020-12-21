<?php

namespace App\Controllers;


use App\Models\Comment;
use Core\Controller;
use Core\Session;
use Core\View;

class AdminController extends Controller
{

    /**
     * Show the admin index page
     *
     * @return void
     */
    public function indexAction()
    {
        if (Session::has('login') && Session::get('login') === true) {
            return redirect('admin/showCommentList');
        }

        View::renderTemplate('admin/index.html', [
            'session' => $_SESSION
        ]);
    }

    /**
     *
     * Authenticate administrator
     *
     */
    public function loginAction()
    {
        if($_POST['password'] !== 'adminPassword2020' && $_POST['email'] !== 'admin@email.com') {

            Session::set('error', 'You email and password doesn\'t match');

            return redirect('admin');
        }

        Session::delete('error');

        Session::set('login', true);

        return redirect('admin/showCommentList');
    }

    public function showCommentListAction()
    {
        if(!Session::has('login') && Session::get('login') !== true) {
            return redirect('admin');
        }

        $comment = new Comment();

        View::renderTemplate('admin/show.html', [
            'comments' => $comment->getAll()
        ]);
    }

    public function enableCommentAction()
    {
        $id = $_POST['id'];

        $comment = new Comment();

        $comment->update($id, [
            'allowed' => '1'
        ]);
    }

    public function disableCommentAction()
    {
        $id = $_POST['id'];

        $comment = new Comment();

        $comment->update($id, [
            'allowed' => '1'
        ]);
    }

    public function logoutAction()
    {
        Session::delete('login');

        return redirect('admin');
    }
}