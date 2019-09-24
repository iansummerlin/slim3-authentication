<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
    public function getSignIn($request, $response)
    {
        return $this->view->render($response, 'auth/signin.twig');
    }

    public function postSignIn($request, $response)
    {
        $auth = $this->auth->attempt(
            $request->getParam('username'),
            $request->getParam('password')
        );

        if (!$auth) {
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp($request, $response) 
    {
        $validation = $this->validator->validate($request, [
            'name' => v::noWhitespace()->notEmpty()->alpha(),
            'surname' => v::noWhitespace()->notEmpty()->alpha(),
            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'username' => v::noWhitespace()->notEmpty(),
            'password' => v::noWhitespace()->notEmpty(),

        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }

        $user = User::create([
            'name' => $request->getParam('name'),
            'surname' => $request->getParam('surname'),
            'email' => $request->getParam('email'),
            'username' => $request->getParam('username'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);

        $this->auth->attempt($user->username, $request->getParam('password'));

        return $response->withRedirect($this->router->pathFor('home'));
    }
}