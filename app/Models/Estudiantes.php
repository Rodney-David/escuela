<?php 
namespace App\Models;

use CodeIgniter\Model;

class Estudiantes extends Model{
    protected $table      = 'estudiantes';
    
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres','apellidos', 'sexo', 'email','password','fecha_nacimiento','direccion'];
    protected $timestamps = true;

}