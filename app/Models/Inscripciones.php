<?php 
namespace App\Models;

use CodeIgniter\Model;

class Inscripciones extends Model{
    protected $table      = 'inscripciones';
    
    protected $primaryKey = 'id';
    protected $allowedFields = ['estudiantes_id','cursos_id','estado'];
    protected $timestamps = true;
    
    public function verificarInscripcion($id){
        
    }
    
    public function mostrar($inscripciones){
        return $inscripciones->select('inscripciones.*, estudiantes.nombres as nombre_estudiante, estudiantes.apellidos as apellidos_estudiante, 
                                        cursos.nivel as nivel_curso, cursos.seccion as seccion_curso')
                            ->join('estudiantes', 'estudiantes.id = inscripciones.estudiantes_id', 'left')
                            ->join('cursos', 'cursos.id = inscripciones.cursos_id', 'left')
                            ->orderBy('inscripciones.id', 'ASC')
                            ->orderBy('id','ASC')
                            ->findAll();
    }


}