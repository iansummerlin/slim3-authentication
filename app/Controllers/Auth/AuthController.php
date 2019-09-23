<?php

namespace App\Controllers\Auth;

use Slim\Views\Twig as View;
use App\Controllers\Controller;

class AuthController extends Controller
{
    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp() 
    {
        //
    }
}