<?php 
namespace App\Models;

use CodeIgniter\Model;

class Materias_cursos extends Model{
    protected $table      = 'materias_cursos';
    
    protected $primaryKey = 'id';
    protected $allowedFields = ['materias_id','cursos_id','docentes_id', 'estado'];
    protected $timestamps = true;
    
    public function mostrar($materias_cursos){
        return $materias_cursos->select('materias_cursos.*, materias.nombre as nombre_materias, materias.codigo as codigo_materias, 
                                        cursos.nivel as nivel_curso, cursos.seccion as seccion_curso, 
                                        docentes.nombres as nombre_docentes, docentes.apellidos as apellido_docentes')
                            ->join('materias', 'materias.id = materias_cursos.materias_id', 'left')
                            ->join('cursos', 'cursos.id = materias_cursos.cursos_id', 'left')
                            ->join('docentes', 'docentes.id = materias_cursos.docentes_id', 'left')
                            ->orderBy('materias_cursos.id', 'ASC')
                            ->orderBy('id','ASC')
                            ->paginate(15);
    }

    public function verificarAsignacion($id){
        return $this->select('materias_cursos.*')
                            ->where('materias_id', $id)->countAllResults();
    }
    
    public function verificarAsignacionCurso($id){
        return $this->select('materias_cursos.*')
                            ->where('cursos_id', $id)->countAllResults();
    }

}