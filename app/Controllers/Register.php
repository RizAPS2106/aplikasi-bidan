<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Register extends BaseController
{
    public function index()
    {
        //include helper form

        helper(['form']);
        $data = ['title' => 'Daftar'];
        echo view('login/register', $data);
    }

    public function save()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'telepon'  => [
                    'label' => 'nomor telepon',
                    'rules' => 'required|numeric|min_length[10]|is_unique[user.telepon]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'numeric' => 'Harap isi kolom {field} dengan nomor',
                        'min_length' => '{field} minimal {param} digit',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                'email'  => [
                    'rules' => 'required|valid_email|is_unique[user.email]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'valid_email' => 'Harap isi email yang valid',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'password'  => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'min_length' => 'Minimal 8 karakter'
                    ]
                ],
                'password_confirm'  => [
                    'label' => 'konfirmasi password',
                    'rules' => 'required|min_length[8]|matches[password]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'min_length' => 'Minimal 8 karakter',
                        'matches' => '{field} salah',
                    ]
                ]
            ]
        );

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $user = new UsersModel();
            $user->save([
                "nama" => $this->request->getPost('nama'),
                "telepon" => $this->request->getPost('telepon'),
                "email" => $this->request->getPost('email'),
                "password" => md5($this->request->getPost('password')),
                "group_user" => 1
            ]);

            $message = 'Registrasi berhasil';

            echo $message;
        } else {
            $message = $validation->getErrors();

            foreach ($message as $msg) {
                if ($msg == end($message)) {
                    echo $msg . '.';
                } else {
                    echo $msg . ', ';
                }
            }
        }
    }
}
