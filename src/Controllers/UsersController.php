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

}
