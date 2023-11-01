<?php 
namespace App\Models;

use CodeIgniter\Model;

class Users extends Model{
    protected $table      = 'users';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres','username','email','password','estado'];
    protected $timestamps = true;

    public function obtenerUsuario($username)
    {
        return $this->select('*')->where('username', $username)->first();
        //return $query->getRowArray();
    }
}