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

        if($this->validate('users')){
            $password = $this->request->getPost('password');
            $newPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $musers->insert(
                [
                    'nombres' => $this->request->getPost('nombres'),
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'password' => $newPassword,
                    'estado' => 1,
                ]
            ); 
            return redirect()->to(base_url()."login");
        }else{
            return redirect()->back()->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                                    - NOMBRE (obligatorio, 3 - 50 caracteres [letras y espacios])<br>
                                                    - EMAIL (obligatorio, debe ser una dirección de correo válida)<br>
                                                    - USERNAME (obligatorio, 4 - 20 caracteres [letras, números, espacios y guiones]<br>
                                                    - PASSWORD (obligatorio, al menos 8 caracteres [letras, números, espacios y guiones])');
        }
    }

    public function iniciar(){
        $musers = new Users();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        $datosUsuario = $musers->obtenerUsuario($username);

        if($datosUsuario && $this->validate('login')){
            if ($datosUsuario != null && password_verify($password, $datosUsuario['password'])){
                $data = ['usuario' => $datosUsuario[0]['username'], "type" => $datosUsuario[0]['type']];
                $session = session();
                $datos['user'] = $datosUsuario['username'];
                $datos['email'] = $datosUsuario['email'];
                $datos['login'] = 1;
                $session->set("usuario",$datos);
                
                return redirect()->to(base_url()."dashboard/index");
            }else{
                return redirect()->back()->with('error', 'Usuario o contraseña incorrectos.');
            }
        }else{
            return redirect()->back()->with('error', 'La validación de datos falló, ambos campos obligatorios.');
        }
    }

    public function salir(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url()."login/index");
    }

    public function session(){
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . base_url() . 'login/index');
            exit;
        }
        return redirect()->to(base_url()."dashboard/index");
    }
}