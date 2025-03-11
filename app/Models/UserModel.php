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
        return $this->where('name', $name)->findAll();
    }

    public function searchByNIM($nim) {
        return $this->where('nim', $nim)->findAll();
    }

    public function searchByYMD($ymd) {
        return $this->where('ymd', $ymd)->findAll();
    }
}
