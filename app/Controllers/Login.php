<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function proses()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->getUserByUsername($username);

        if ($user) {
            if ($password == $user['password']) {
                $session->set('user_id', $user['id']);
                $session->set('role', $user['role']);

                if ($user['role'] == 'admin') {
                    return redirect()->to(base_url('admin'));
                } else {
                    return redirect()->to(base_url('user'));
                }
            } else {
                $session->setFlashdata('message', 'Password salah.');
            }
        } else {
            $session->setFlashdata('message', 'Username tidak ditemukan.');
        }

        return redirect()->to(base_url('Login'));
    }

    public function logout()
    {
        $session = session();
        $session->remove(['user_id', 'role']);

        return redirect()->to(base_url('Login'));
    }
}