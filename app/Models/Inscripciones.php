<?php 
namespace App\Models;

use CodeIgniter\Model;

class Inscripciones extends Model{
    protected $table      = 'inscripciones';
    
    protected $primaryKey = 'id';
    protected $allowedFields = ['estudiantes_id','cursos_id','estado'];
    protected $timestamps = true;

}