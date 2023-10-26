<?php

namespace App\Controllers;

use App\Models\Materias;
use App\Models\Cursos;
use App\Models\Estudiantes;
use App\Models\Inscripciones;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MateriasController extends BaseController
{
    public function index(){
        $mmaterias = new Materias();
        $data['materias'] = $mmaterias->paginate(10);
        $paginador = $mmaterias->pager;
        $data['paginador'] = $paginador;

        return view('materias/index', $data);
    }

    public function register(): string
    {
        return view('materias/create');
    }

    public function guardar(){
        $mmaterias = new Materias();

        if($this->validate('materias')){
            $mmaterias->insert(
                [
                    'nombre' => $this->request->getPost('nombre'),
                    'codigo' => $this->request->getPost('codigo'),
                    'estado' => 1,
                ]
            ); 
            return redirect()->to(base_url()."materias")->with('success', 'Materia creada');
        }
        return  redirect()->to(base_url()."create_materias")->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                                                            - Nombres (obligatorio)<br>
                                                                            - Codigo (obligatoria, máximo 20 caracteres)')->with("data");
    }

    public function editar($id){
        $materia = new Materias();
        $datos_materia = $materia->find($id);

        if ($datos_materia) {
            return view('materias/edit', ['materia' => $datos_materia]);
        } 
        else {
            return redirect()->to(base_url()."materia");
        }
    }

    public function actualizar($id){
        $id = $this->request->getPost('id');
        $mmaterias = new Materias();
        $datos_materia = $mmaterias->find($id);
        
        if ($datos_materia) {
            if($this->validate('materias')){
                $estado = $this->request->getVar('estado');
                $data = [
                    'estado' => $estado == '1' ? '1' : '0',
                ];
                $mmaterias->update($id,
                    [
                        'nombre' => $this->request->getPost('nombre'),
                        'codigo' => $this->request->getPost('codigo'),
                        'estado' => $data,
                    ]
                ); 
                return redirect()->to(base_url()."materias");
            }
            return redirect()->back()->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                            - Nombres (obligatorio, No caracteres Especiales)<br>
                                            - Codigo (obligatoria, máximo 20 caracteres)');
        }
        else {
            return redirect()->back()->with('error', 'Materia no existe.');
        }
    }

    public function eliminar($id){
        $mmaterias = new Materias();
        $datos_materia = $mmaterias->find($id);
        
        if($datos_materia){
            $mmaterias->delete($id);
            return redirect()->back()->with('success', 'Materia Eliminada');
        }
        else {
            return redirect()->back()->with('error', 'Materia no Eliminada');
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

    public function generarExcel($id) {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        
        $activeWorksheet->getColumnDimension('A')->setWidth(20);
        $activeWorksheet->getColumnDimension('B')->setWidth(20);
        $activeWorksheet->getColumnDimension('C')->setWidth(20);

        $alignment = [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ];
        $activeWorksheet->getStyle('A1:C1')->getAlignment()->applyFromArray($alignment);
        $activeWorksheet->getStyle('A2:C2')->getAlignment()->applyFromArray($alignment);

        $titleFont = [
            'bold' => true,
        ];
        $activeWorksheet->getStyle('A1:C1')->getFont()->applyFromArray($titleFont);
        $activeWorksheet->getStyle('A2:C2')->getFont()->applyFromArray($titleFont);

        $mcursos = new Cursos();
        $curso = $mcursos->find($id);

        $minscripciones = new Inscripciones();
        $inscripciones = $minscripciones
            ->where('cursos_id', $id)
            ->join('estudiantes', 'inscripciones.estudiantes_id = estudiantes.id')
            ->select('inscripciones.id, estudiantes.nombres, estudiantes.apellidos, inscripciones.estado')
            ->findAll();

        if ($curso) {
            $activeWorksheet->mergeCells('A1:C1');
            $activeWorksheet->setCellValue('A1', 'Curso: ' . $curso['nivel'] . ' - ' . $curso['seccion']);

            $activeWorksheet->setCellValue('A2', 'Id Matricula');
            $activeWorksheet->setCellValue('B2', 'Nombres');
            $activeWorksheet->setCellValue('C2', 'Estado');

            $cont = 3;

            foreach ($inscripciones as $inscripcion) {
                $activeWorksheet->setCellValue('A' . $cont, $inscripcion['id']);
                $activeWorksheet->setCellValue('B' . $cont, $inscripcion['nombres'] . ' ' . $inscripcion['apellidos']);
                $activeWorksheet->setCellValue('C' . $cont, $inscripcion['estado'] == '1' ? 'Activo' : 'Inactivo');

                $activeWorksheet->getStyle('A' . $cont . ':E' . $cont)->getAlignment()->applyFromArray($alignment);

                $cont++;
            }
        } 
        else {
            $activeWorksheet->setCellValue('A1', 'Curso no encontrado');
        }
    
        $writer = new Xlsx($spreadsheet);
    
        // Configura las cabeceras HTTP para forzar la descarga del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="inscripciones.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}