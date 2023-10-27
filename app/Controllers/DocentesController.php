<?php

namespace App\Controllers;

use App\Models\Docentes;
use App\Models\Estudiantes;
use App\Models\Inscripciones;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DocentesController extends BaseController
{
    public function index(){
        $nombres = $this->request->getGet('nombres');
        $apellidos = $this->request->getGet('apellidos');
        $sexo = $this->request->getGet('sexo');
        $email = $this->request->getGet('email');
        $direccion = $this->request->getGet('direccion');



        $mdocentes = new Docentes();
        if(!empty($nombres)){
            $mdocentes->like('nombres',$nombres);
        }
        if(!empty($apellidos)){
            $mdocentes->like('apellidos',$apellidos);
        }
        if(!empty($sexo)){
            $mdocentes->like('sexo',$sexo);
        }
        if(!empty($email)){
            $mdocentes->like('email',$email);
        }
        if(!empty($direccion)){
            $mdocentes->like('direccion',$direccion);
        }

        $data['docentes'] = $mdocentes->orderBy('id','DESC')->paginate(30);
        $paginador = $mdocentes->pager;
        $data['paginador'] = $paginador;
        
        $data['nombres'] = $nombres;
        $data['apellidos'] = $apellidos;
        $data['sexo'] = $sexo;
        $data['email'] = $email;
        $data['direccion'] = $direccion;
        return view('docentes/index', $data);
    }


    public function register(): string
    {
        return view('docentes/create');
    }

    public function guardar(){
        $mdocentes = new Docentes();

        if($this->validate('docentes')){
            $mdocentes->insert(
                [
                    'nombres' => $this->request->getPost('nombres'),
                    'apellidos' => $this->request->getPost('apellidos'),
                    'sexo' => $this->request->getPost('sexo'),
                    'email' => $this->request->getPost('email'),
                    'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
                    'direccion' => $this->request->getPost('direccion'),
                ]
            ); 
            return redirect()->to(base_url()."docentes")->with('success', 'Docente creado');
        }
        return  redirect()->to(base_url()."create_docentes")->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                                    - NOMBRE (obligatorio, entre 3 y 50 caracteres, solo letras y espacios)<br>
                                                    - APELLIDO (obligatorio, entre 3 y 50 caracteres)<br>
                                                    - EMAIL (obligatorio, debe ser una dirección de correo válida)<br>
                                                    - FECHA DE NACIMIENTO (obligatoria, debe ser una fecha válida en el formato Y-m-d)<br>
                                                    - DIRECCIÓN (obligatoria, entre 5 y 100 caracteres, caracteres especiales permitidos) ');

    }

    public function editar($id){
        $docente = new Docentes();
        $datos_docente = $docente->find($id);

        if ($datos_docente) {
            return view('docentes/edit', ['docente' => $datos_docente]);
        } 
        else {
            return redirect()->to(base_url()."docentes");
        }
    }

    public function actualizar($id){
        $id = $this->request->getPost('id');
        $mdocentes = new Docentes();
        $datos_docente = $mdocentes->find($id);
        
        if ($datos_docente) {
            if($this->validate('docentes')){
                $mdocentes->update($id,
                    [
                        'nombres' => $this->request->getPost('nombres'),
                        'apellidos' => $this->request->getPost('apellidos'),
                        'sexo' => $this->request->getPost('sexo'),
                        'email' => $this->request->getPost('email'),
                        'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
                        'direccion' => $this->request->getPost('direccion'),
                        'estado' => $this->request->getPost('estado'),
                    ]
                ); 
                return redirect()->to(base_url()."docentes");
            }
            return redirect()->back()->with('error', 'La validación de datos falló. Por favor, revisa tus entradas:<br>
                                                    - NOMBRE (obligatorio, entre 3 y 50 caracteres, solo letras y espacios)<br>
                                                    - APELLIDO (obligatorio, entre 3 y 50 caracteres)<br>
                                                    - EMAIL (obligatorio, debe ser una dirección de correo válida)<br>
                                                    - FECHA DE NACIMIENTO (obligatoria, debe ser una fecha válida en el formato Y-m-d)<br>
                                                    - DIRECCIÓN (obligatoria, entre 5 y 100 caracteres, caracteres especiales permitidos) ');
        }
        else {
            return redirect()->back()->with('error', 'Docente no existe.');
        }
    }

    public function eliminar($id){
        $mdocentes = new Docentes();
        $datos_docente = $mdocentes->find($id);
        
        if($datos_docente){
            $mdocentes->delete($id);
            return redirect()->back()->with('success', 'Docente Eliminado');
        }
        else {
            return redirect()->back()->with('error', 'Docente no Eliminado');
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
        
        $mdocentes = new Docentes();
        $docentes = $mdocentes->findAll();
        
        $cont = 2;

        foreach($docentes as $docente){
            $activeWorksheet->setCellValue('A' . $cont, $docente['nombres']);
            $activeWorksheet->setCellValue('B' . $cont, $docente['apellidos']);
            $activeWorksheet->setCellValue('C' . $cont, $docente['email']);
            $activeWorksheet->setCellValue('D' . $cont, $docente['fecha_nacimiento']);
            $activeWorksheet->setCellValue('E' . $cont, $docente['direccion']);
            
            $activeWorksheet->getStyle('A' . $cont . ':E' . $cont)->getAlignment()->applyFromArray($alignment);

            $cont++;
        }
    
        $writer = new Xlsx($spreadsheet);
    
        // Configura las cabeceras HTTP para forzar la descarga del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="docentes.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }    
    
}