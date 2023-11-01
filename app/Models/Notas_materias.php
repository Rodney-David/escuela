<?php 
namespace App\Models;

use CodeIgniter\Model;

class Notas_materias extends Model{
    protected $table      = 'notas_materias';
    
    protected $primaryKey = 'id';
    protected $allowedFields = ['materias_id','estudiantes_id', 'notas'];
    protected $timestamps = true;
    
    public function mostrar($notas_materias){
        return $notas_materias->select('notas_materias.*, materias.nombre as nombre_materias, materias.codigo as codigo_materias, 
                                                        estudiantes.nombres as nombre_docentes, estudiantes.apellidos as apellido_docentes')
                            ->join('materias', 'materias.id = notas_materias.materias_id', 'left')
                            ->join('estudiantes', 'estudiantes.id = notas_materias.estudiantes_id', 'left')
                            ->join('cursos', 'cursos.id = notas_materias.cursos_id', 'left')
                            ->orderBy('notas_materias.id', 'ASC')
                            ->orderBy('id','ASC')
                            ->paginate(15);
    }
}