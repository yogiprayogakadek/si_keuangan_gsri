<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        // echo "User info:<br>";
        // echo "<pre>";
        // print_r(session()->get());
        // echo "</pre>";
        return view('main\auth\index');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if($user) {
            if(password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'is_active' => $user['is_active'],
                    'logged_id' => true,
                ]);
                return redirect()->to('/');
            } else {
                return redirect()->back()->withInput()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Username salah');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
