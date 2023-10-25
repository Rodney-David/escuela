<?php

namespace App\Controllers;

use App\Models\Cursos;
use App\Models\Estudiantes;
use App\Models\Inscripciones;

class CursosController extends BaseController
{
    public function index(){
        $mcursos = new Cursos();
        $data['cursos'] = $mcursos->paginate(10);
        $paginador = $mcursos->pager;
        $data['paginador'] = $paginador;

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
        $inscripciones = new Inscripciones();
        if($datos_curso){
            if($inscripciones->verificarInscripcionCurso($id) > 0){
                return redirect()->back()->with('error', 'Curso no Eliminado');
            }
            else {
                $mcursos->delete($id);
                return redirect()->back()->with('success', 'Curso Eliminado');
            }
        }else{
            return redirect()->back()->with('error', 'Curso no Encontrado');
        }
    }


    public function ver($id){
        $mcurso = new Cursos();
        $data['curso'] = $mcurso->find($id);

        $inscripciones = new Inscripciones();
        $data['inscripciones'] = $inscripciones->where('cursos_id', $id)->mostrar($inscripciones);
        $paginador = $inscripciones->pager;
        $data['paginador'] = $paginador;

        if ($data) { 
            return view('cursos/show', $data);
        } else {
            return redirect()->to(base_url()."cursos");
        }
    }

    public function inscribir($id){
        $curso = new Cursos();
        $data['curso'] = $curso->find($id);

        $mestudiantes = new Estudiantes();
        $data['estudiantes'] = $mestudiantes->findAll();

        if ($data) {
            return view('cursos/inscribir', $data);
        } 
        else {
            return redirect()->to(base_url()."cursos");
        }
    }

    public function guardarInscripcion($id){

        $minscripcion = new Inscripciones();

        if($this->validate('inscripcion')){
            //$minscripcion->verificarInscripcion($this->request->getPost('estudiantes_id'));
            //return  redirect()->to(base_url()."inscribir-cursos/".$id)->with('error', 'El estudiante ya esta inscrito en el');
            $minscripcion->insert(
                [
                    'estudiantes_id' => $this->request->getPost('estudiantes_id'),
                    'cursos_id' => $id,
                    'estado' => 1,
                ]
            ); 
            return redirect()->to(base_url()."ver_inscripciones/".$id)->with('success', 'Curso creado');
        }
        return  redirect()->to(base_url()."inscribir-cursos/".$id)->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                                                            - Estudiante (obligatorio)');

    }

    public function editar_inscripcion($id){
        $inscripciones = new Inscripciones();
        $data['inscripcion'] = $inscripciones->find($id);

        $mestudiantes = new Estudiantes();
        $data['estudiantes'] = $mestudiantes->findAll();

        if ($data) {
            return view('cursos/edit_inscripcion', $data);
        } 
        else {
            return redirect()->to(base_url()."cursos");
        }
    }

    public function actualizarInscripcion($id){
        $minscripcion = new Inscripciones();
        $inscripcion = $minscripcion->find($id);
    
        if ($inscripcion) { // Verificar si la inscripción existe
            $estado = $this->request->getVar('estado');
            $data = [
                'estado' => $estado == '1' ? '1' : '0',
            ];
            $minscripcion->update($id, $data);
            return redirect()->to(base_url()."ver-cursos/".$inscripcion['cursos_id'])->with('success', 'Curso creado');
        } else {
            return redirect()->to(base_url()."cursos");
        }
    }

    public function eliminar_inscripcion($id){
        $minscripcion = new Inscripciones();
        $inscripcion = $minscripcion->find($id);

        if($inscripcion){
            $minscripcion->delete($id);
            return redirect()->back()->with('success', 'Inscripcion Eliminada');
        }
        else {
            return redirect()->back()->with('error', 'Inscripcion no Eliminada');
        }
    }
}