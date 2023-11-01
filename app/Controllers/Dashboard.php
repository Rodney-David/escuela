<?php
namespace App\Controllers;

use App\Models\Users;

class Dashboard extends BaseController
{
    public function index(){
        $session = session();
        if($session->get('usuario')['login'] == 1 ){
            return view('dashboard/index');
        }
        
        return redirect()->to(base_url()."login/index")->with('error', 'no tienes acceso.');
    }
}