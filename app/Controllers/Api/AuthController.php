<?php

namespace App\Controllers\Api;
use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController {
    use ResponseTrait;
    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        $data = $this->request->getJSON(true);
        $user = $this->userModel->getUserByEmail($data['email']);
    
     
        if ($user && password_verify($data['password'], $user['password'])) {
            return $this->respond([
                "token" => bin2hex(random_bytes(32)), 
                "message" => "Login berhasil"
            ]);
        } else {
            return $this->failUnauthorized("Email atau password salah");
        }
    }
    

    public function register() {
        $data = $this->request->getJSON(true);
    
        if ($this->userModel->getUserByEmail($data['email'])) {
            return $this->fail("Email sudah terdaftar");
        }
    
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        if ($this->userModel->insert($data)) {
            return $this->respondCreated(["message" => "User berhasil didaftarkan"]);
        } else {
            return $this->fail("Gagal mendaftar");
        }
    }
    
}
