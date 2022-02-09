<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    public function index()
    {
        //include helper form

        helper(['form']);
        $data = ['title' => 'Login'];
        echo view('login/login', $data);
    }

    public function auth()
    {
        $session = session();
        $users = new UsersModel();
        $email = $this->request->getVar('email');
        $password = md5($this->request->getVar('password'));
        $data = $users->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            if ($password == $pass) {
                $ses_data = [
                    'id'            => $data['id'],
                    'nama'          => $data['nama'],
                    'email'         => $data['email'],
                    'group_user'    => $data['group_user'],
                    'logged_in'     => TRUE
                ];

                $users->update($data['id'], [
                    'status_login' => 'login'
                ]);

                $session->set($ses_data);

                if ($data['group_user'] == 1) {
                    $message = "Konsumen berhasil masuk";
                } else if ($data['group_user'] == 2) {
                    $message = "Admin berhasil masuk";
                } else if ($data['group_user'] == 3) {
                    $message = "Bidan berhasil masuk";
                }
            } else {
                $message = 'Password Salah';
            }
        } else {
            $message = 'Email tidak terdaftar';
        }

        echo $message;
    }

    public function logout()
    {
        $session = session();
        $id = $session->get('id');

        $users = new UsersModel();
        $users->update($id, [
            'status_login' => 'logout'
        ]);

        $session->destroy();
        return redirect()->to('/');
    }
}
