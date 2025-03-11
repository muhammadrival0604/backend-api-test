<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'nim', 'ymd'];

    
    public function getUser($id = null) {
        return $id ? $this->find($id) : $this->findAll();
    }

   
    public function searchByName($name) {
        return $this->like('name', $name)->findAll();
    }

    
    public function searchByNIM($nim) {
        return $this->where('nim', $nim)->findAll();
    }

  
    public function searchByYMD($ymd) {
        return $this->where('ymd', $ymd)->findAll();
    }

    
    public function getUserByEmail($email) {
        return $this->where('email', $email)->first();
    }


    public function createUser($data) {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->insert($data);
    }
}
