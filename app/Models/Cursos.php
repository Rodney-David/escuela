<?php 
namespace App\Models;

use CodeIgniter\Model;

class Cursos extends Model{
    protected $table      = 'cursos';
    
    protected $primaryKey = 'id';
    protected $allowedFields = ['nivel','seccion','periodo','estado'];
    protected $timestamps = true;

}