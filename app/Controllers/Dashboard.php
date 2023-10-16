<?php
namespace App\Controllers;

use App\Models\Users;

class Dashboard extends BaseController
{
    public function index(): string{
        return view('dashboard/index');
    }
}