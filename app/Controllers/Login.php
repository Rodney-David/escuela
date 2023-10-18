<?php

namespace App\Controllers;

use App\Models\Users;

class Login extends BaseController
{
    public function index(): string
    {
        return view('login/index');
    }

    public function register(): string
    {
        return view('login/register');
    }

    public function guardar(){
        $musers = new Users();

        $password = $this->request->getPost('password');
        $newPassword = password_hash($password, PASSWORD_DEFAULT);

        if($this->validate('users')){
            $musers->insert(
                [
                    'nombres' => $this->request->getPost('nombres'),
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'password' => $newPassword,
                    'estado' => 1,
                    'direccion' => $this->request->getPost('direccion'),
                ]
            ); 
            return redirect()->to(base_url()."public/login");
        }
        return redirect()->to(base_url()."public/register");
    }

    public function iniciar(){
        $musers = new Users();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        $datosUsuario = $musers->obtenerUsuario($username);

        if($datosUsuario){
            if($this->validate('login')){
                if ($datosUsuario != null && password_verify($password, $datosUsuario['password'])){
                    $data = ['usuario' => $datosUsuario[0]['username'], "type" => $datosUsuario[0]['type']];
                    $session = session();
                    $session->set($data);
                    return redirect()->to(base_url()."public/dashboard/index");
                }else{
                    return redirect()->to(base_url()."public/login/index");
                }
            }else{
                return redirect()->to(base_url()."public/login/index");
            }
        }else{
            return redirect()->to(base_url()."public/login/index");
        }  
    }

    public function salir(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url()."public/login/index");
    }
}