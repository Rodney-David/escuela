<?php

namespace App\Controllers;

use App\Models\Cursos;

class CursosController extends BaseController
{
    public function index(){
        $mcursos = new Cursos();
        $data['cursos'] = $mcursos->findAll();

        return view('cursos/index', $data);
    }


    public function register(): string
    {
        return view('cursos/create');
    }

    public function guardar(){
        $mcursos = new Cursos();

        if($this->validate('cursos')){
            $mcursos->insert(
                [
                    'nivel' => $this->request->getPost('nivel'),
                    'seccion' => $this->request->getPost('seccion'),
                    'periodo' => $this->request->getPost('periodo'),
                    'estado' => 1,
                ]
            ); 
            return redirect()->to(base_url()."cursos")->with('success', 'Curso creado');
        }
        return  redirect()->to(base_url()."create-cursos")->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                                                            - NIVEL (obligatorio, debe ser un número)<br>
                                                                            - SECCIÓN (obligatoria, máximo 50 caracteres, [letras, números, espacios y guiones])<br>
                                                                            - PERIODO (obligatorio, máximo 50 caracteres, [letras, números, espacios y guiones])')->with("data");

    }

    public function editar($id){
        $curso = new Cursos();
        $datos_curso = $curso->find($id);

        if ($datos_curso) {
            return view('cursos/edit', ['curso' => $datos_curso]);
        } 
        else {
            return redirect()->to(base_url()."cursos");
        }
    }

    public function actualizar($id){
        $id = $this->request->getPost('id');
        $mcursos = new Cursos();
        $datos_curso = $mcursos->find($id);
        
        if ($datos_curso) {
            if($this->validate('cursos')){
                $mcursos->update($id,
                    [
                        'nivel' => $this->request->getPost('nivel'),
                        'seccion' => $this->request->getPost('seccion'),
                        'periodo' => $this->request->getPost('periodo'),
                        'estado' => 1,
                    ]
                ); 
                return redirect()->to(base_url()."cursos");
            }
            return redirect()->back()->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                                    - NIVEL (obligatorio, debe ser un número)<br>
                                                    - SECCIÓN (obligatoria, máximo 50 caracteres, [letras, números, espacios y guiones])<br>
                                                    - PERIODO (obligatorio, máximo 50 caracteres, [letras, números, espacios y guiones])');
        }
        else {
            return redirect()->back()->with('error', 'Curso no existe.');
        }
    }

    public function eliminar($id){
        $mcursos = new Cursos();
        $datos_curso = $mcursos->find($id);

        if($datos_curso){
            $mcursos->delete($id);
            return redirect()->back()->with('success', 'Curso Eliminado');
        }
        else {
            return redirect()->back()->with('error', 'Curso no Eliminado');
        }
    }

}