<?php

namespace DevStream\Controllers;

use DevStream\Models\User;

class AuthController extends Controller
{
    public function create()
    {
        return $this->render('login');
    }

    public function store()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $model = new User();

        $user = $model->findBy('email', $email);

        if (!password_verify($password, $user->password)) {
            return 'Credenciais inválidas!';
        }

        $_SESSION['user_id'] = $user->id;

        return $this->redirect('/');
    }

    public function destroy()
    {
        unset($_SESSION['user_id']);
        header('location: /');
    }
}
