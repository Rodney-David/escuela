<?php 
namespace App\Models;

use CodeIgniter\Model;

class Materias extends Model{
    protected $table      = 'materias';
    
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre','codigo','estado'];
    protected $timestamps = true;

}