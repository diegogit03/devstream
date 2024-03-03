<?php

namespace DevStream\Controllers;

use DevStream\Auth;
use DevStream\Models\Stream;
use DevStream\Models\User;
use Psr\Http\Message\RequestInterface;

class UsersController extends Controller {
    public function show(RequestInterface $request, array $args)
    {
        $id = $args['id'];

        $streamModel = new Stream();
        $streams = $streamModel->allFromUser($id);

        $userModel = new User();
        $user = $userModel->find($id);

        return $this->render('userDetails', compact('user', 'streams'));
    }

    public function create()
    {
        return $this->render('register');
    }

    public function store()
    {
        $userModel = new User();

        $userModel->create([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ]);

        $user = $userModel->findBy('email', $_POST['email']);

        $_SESSION['user_id'] = $user->id;

        return $this->redirect('/');
    }

}
