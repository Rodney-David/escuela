<?php 
namespace App\Models;

use CodeIgniter\Model;

class Docentes extends Model{
    protected $table      = 'docentes';
    
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres','apellidos', 'sexo', 'email', 'fecha_nacimiento','direccion', 'estado'];
    protected $timestamps = true;

}