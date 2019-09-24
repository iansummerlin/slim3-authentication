<?php 

namespace App\Controllers;

use App\Models\User;
use Slim\Views\Twig as View;

class HomeController extends Controller
{
    public function index($request, $response)
    {
        // $this->flash->addMessage('error', 'Test flash message');
        return $this->view->render($response, 'home.twig');
    }
}