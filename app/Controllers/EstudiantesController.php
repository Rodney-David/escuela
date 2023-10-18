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

        if($this->validate('estudiantes')){
            $mestudiantes->insert(
                [
                    'nombres' => $this->request->getPost('nombres'),
                    'apellidos' => $this->request->getPost('apellidos'),
                    'email' => $this->request->getPost('email'),
                    'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
                    'direccion' => $this->request->getPost('direccion'),
                ]
            ); 
            return redirect()->to(base_url()."public/estudiantes");
        }
        return redirect()->back();
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
        $mestudiantes = new Estudiantes();
        $datos_estudiante = $mestudiantes->find($id);
        
        if ($datos_estudiante) {
            if($this->validate('estudiantes')){
                $mestudiantes->update($id,
                    [
                        'nombres' => $this->request->getPost('nombres'),
                        'apellidos' => $this->request->getPost('apellidos'),
                        'email' => $this->request->getPost('email'),
                        'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
                        'direccion' => $this->request->getPost('direccion'),
                    ]
                ); 
                return redirect()->to(base_url()."public/estudiantes");
            }
            return redirect()->back();
        }
        else {
            return redirect()->to(base_url()."public/estudiantes");
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