<?php

namespace App\Controllers;

use App\Models\Estudiantes;
use App\Models\Inscripciones;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EstudiantesController extends BaseController
{
    public function index(){
        $mestudiantes = new Estudiantes();
        $data['estudiantes'] = $mestudiantes->paginate(30);
        $paginador = $mestudiantes->pager;
        $data['paginador'] = $paginador;

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
        return  redirect()->to(base_url()."create-estudiantes")->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
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
        $inscripciones = new Inscripciones();
        if($datos_estudiante){
            if($inscripciones->verificarInscripcion($id) > 0){
                return redirect()->back()->with('error', 'El estudiante está inscrito a un curso');
            }
            $estudiante->delete($id);
            return redirect()->back()->with('success', 'Estudiante Eliminado');
        }
        else {
            return redirect()->back()->with('error', 'Estudiante no Eliminado');
        }
    }

    public function generarExcel() {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        
        $activeWorksheet->getColumnDimension('A')->setWidth(20);
        $activeWorksheet->getColumnDimension('B')->setWidth(20);
        $activeWorksheet->getColumnDimension('C')->setWidth(30);
        $activeWorksheet->getColumnDimension('D')->setWidth(20);
        $activeWorksheet->getColumnDimension('E')->setWidth(30);

        $alignment = [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ];
        $activeWorksheet->getStyle('A1:E1')->getAlignment()->applyFromArray($alignment);

        $titleFont = [
            'bold' => true,
        ];
        $activeWorksheet->getStyle('A1:E1')->getFont()->applyFromArray($titleFont);

        $activeWorksheet->setCellValue('A1', 'Nombre');
        $activeWorksheet->setCellValue('B1', 'Apellido');
        $activeWorksheet->setCellValue('C1', 'Email');
        $activeWorksheet->setCellValue('D1', 'FechaNacimiento');
        $activeWorksheet->setCellValue('E1', 'Direccion');
        
        $mestudiantes = new Estudiantes();
        $estudiantes = $mestudiantes->findAll();
        
        $cont = 2;

        foreach($estudiantes as $estudiante){
            $activeWorksheet->setCellValue('A' . $cont, $estudiante['nombres']);
            $activeWorksheet->setCellValue('B' . $cont, $estudiante['apellidos']);
            $activeWorksheet->setCellValue('C' . $cont, $estudiante['email']);
            $activeWorksheet->setCellValue('D' . $cont, $estudiante['fecha_nacimiento']);
            $activeWorksheet->setCellValue('E' . $cont, $estudiante['direccion']);
            
            $activeWorksheet->getStyle('A' . $cont . ':E' . $cont)->getAlignment()->applyFromArray($alignment);

            $cont++;
        }
    
        $writer = new Xlsx($spreadsheet);
    
        // Configura las cabeceras HTTP para forzar la descarga del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="estudiantes.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}