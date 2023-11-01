<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        print_r($_SESSION['usuario']);
        return view('index');
    }

    public function holaMundo(): string
    {
        return view('welcome_message');
    }

}
