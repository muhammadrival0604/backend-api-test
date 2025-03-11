<?php

namespace App\Controllers\Api;
use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class UserController extends BaseController {
    use ResponseTrait;

    private $apiUrl = "https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131";

    private function fetchExternalData() {
        $response = file_get_contents($this->apiUrl);
        return json_decode($response, true);
    }

    public function login() {
        $data = $this->request->getJSON(true);
        $users = $this->fetchExternalData();

        foreach ($users['results'] as $user) {
            if ($user['email'] == $data['email'] && $user['login']['uuid'] == $data['password']) {
                return $this->respond(["token" => bin2hex(random_bytes(32))]);
            }
        }

        return $this->failUnauthorized("Invalid credentials");
    }

    public function searchByName($name) {
        $users = $this->fetchExternalData();
        $filtered = array_filter($users['results'], function ($user) use ($name) {
            return stripos($user['name']['first'] . " " . $user['name']['last'], $name) !== false;
        });

        return $this->respond(array_values($filtered));
    }

    public function searchByNIM($nim) {
        $users = $this->fetchExternalData();
        $filtered = array_filter($users['results'], function ($user) use ($nim) {
            return $user['login']['uuid'] == $nim;
        });

        return $this->respond(array_values($filtered));
    }

    public function searchByYMD($ymd) {
        $users = $this->fetchExternalData();
        $filtered = array_filter($users['results'], function ($user) use ($ymd) {
            return date('Ymd', strtotime($user['dob']['date'])) == $ymd;
        });

        return $this->respond(array_values($filtered));
    }
}
