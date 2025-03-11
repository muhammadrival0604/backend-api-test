<?php

namespace App\Controllers\Api;
use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class UserController extends BaseController {
    use ResponseTrait;
    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {
        return $this->respond($this->userModel->getUser(), 200);
    }

    public function show($id) {
        return $this->respond($this->userModel->getUser($id), 200);
    }

    public function create() {
        $data = $this->request->getJSON(true);
        $this->userModel->insert($data);
        return $this->respondCreated(["message" => "User created"]);
    }

    public function update($id) {
        $data = $this->request->getJSON(true);
        $this->userModel->update($id, $data);
        return $this->respond(["message" => "User updated"]);
    }

    public function delete($id) {
        $this->userModel->delete($id);
        return $this->respondDeleted(["message" => "User deleted"]);
    }

    public function searchByName($name) {
        return $this->respond($this->userModel->searchByName($name));
    }

    public function searchByNIM($nim) {
        return $this->respond($this->userModel->searchByNIM($nim));
    }

    public function searchByYMD($ymd) {
        return $this->respond($this->userModel->searchByYMD($ymd));
    }
}
