<?php

namespace App\Controllers;

use App\Models\Estudiantes;

class EstudiantesController extends BaseController
{
    public function index(){
        $mestudiantes = new Estudiantes();
        $data['estudiantes'] = $mestudiantes->findAll();

        return view('estudiantes/index', $data);
    }


    public function register(): string
    {
        return view('estudiantes/create');
    }

    public function guardar(){
        $mestudiantes = new Estudiantes();
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $email = $this->request->getPost('email');
        $fecha_nacimiento = $this->request->getPost('fecha_nacimiento');
        $direccion = $this->request->getPost('direccion');

        $data = [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'email' => $email,
            'fecha_nacimiento' => $fecha_nacimiento,
            'direccion' => $direccion,
        ];
    
        $mestudiantes->save($data);
        return redirect()->to(base_url()."public/estudiantes");
    }

}