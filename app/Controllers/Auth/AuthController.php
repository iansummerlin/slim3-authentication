<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;

class AuthController extends Controller
{
    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp($request, $response) 
    {
        $user = User::create([
            'name' => $request->getParam('name'),
            'surname' => $request->getParam('surname'),
            'email' => $request->getParam('email'),
            'username' => $request->getParam('username'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);

        return $response->withRedirect($this->router->pathFor('home'));
    }
}