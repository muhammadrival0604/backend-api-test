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
        $user = $this->userModel->where('email', $data['email'])->first();

        if ($user && password_verify($data['password'], $user['password'])) {
            return $this->respond(["token" => bin2hex(random_bytes(32))]);
        } else {
            return $this->failUnauthorized("Invalid credentials");
        }
    }
}
