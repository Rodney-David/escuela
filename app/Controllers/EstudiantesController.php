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

    public function editar($id){
        $estudiante = new Estudiantes();
        $datos_estudiante = $estudiante->find($id);

        if ($datos_estudiante) {
            return view('estudiantes/edit', ['estudiante' => $datos_estudiante]);
        } 
        else {
            return redirect()->to(base_url()."public/estudiantes");
        }
    }

    public function actualizar($id){
        $id = $this->request->getPost('id');
        $estudiante = new Estudiantes();
        $datos_estudiante = $estudiante->find($id);
        
        if ($datos_estudiante) {
            
            $nuevos_datos = [
                'nombres' => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'email' => $this->request->getPost('email'),
                'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
                'direccion' => $this->request->getPost('direccion')
            ];
            $estudiante->update($id, $nuevos_datos);
            return redirect()->to(base_url()."public/estudiantes");
        }
        else {
            return redirect()->to(base_url()."public/estudiantes/index");
        }
    }

    public function eliminar($id){
        $estudiante = new Estudiantes();
        $datos_estudiante = $estudiante->find($id);

        if($datos_estudiante){
            $estudiante->delete($id);
            return redirect()->to(base_url()."public/estudiantes");
        }
        else {
            return redirect()->to(base_url()."public/estudiantes");
        }
    }

}