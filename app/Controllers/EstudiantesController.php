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
            return redirect()->to(base_url()."estudiantes")->with('success', 'Estudiante creado');
        }
        return redirect()->back()->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                                    - NOMBRE (obligatorio, entre 3 y 50 caracteres, solo letras y espacios)<br>
                                                    - APELLIDO (obligatorio, entre 3 y 50 caracteres)<br>
                                                    - EMAIL (obligatorio, debe ser una dirección de correo válida)<br>
                                                    - FECHA DE NACIMIENTO (obligatoria, debe ser una fecha válida en el formato Y-m-d)<br>
                                                    - DIRECCIÓN (obligatoria, entre 5 y 100 caracteres, caracteres especiales permitidos) ');

    }

    public function editar($id){
        $estudiante = new Estudiantes();
        $datos_estudiante = $estudiante->find($id);

        if ($datos_estudiante) {
            return view('estudiantes/edit', ['estudiante' => $datos_estudiante]);
        } 
        else {
            return redirect()->to(base_url()."estudiantes");
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
                return redirect()->to(base_url()."estudiantes");
            }
            return redirect()->back()->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                                    - NOMBRE (obligatorio, entre 3 y 50 caracteres, solo letras y espacios)<br>
                                                    - APELLIDO (obligatorio, entre 3 y 50 caracteres)<br>
                                                    - EMAIL (obligatorio, debe ser una dirección de correo válida)<br>
                                                    - FECHA DE NACIMIENTO (obligatoria, debe ser una fecha válida en el formato Y-m-d)<br>
                                                    - DIRECCIÓN (obligatoria, entre 5 y 100 caracteres, caracteres especiales permitidos) ');
        }
        else {
            return redirect()->back()->with('error', 'Estudiante no existe.');
        }
    }

    public function eliminar($id){
        $estudiante = new Estudiantes();
        $datos_estudiante = $estudiante->find($id);

        if($datos_estudiante){
            $estudiante->delete($id);
            return redirect()->back()->with('success', 'Estudiante Eliminado');
        }
        else {
            return redirect()->back()->with('error', 'Estudiante no Eliminado');
        }
    }

}