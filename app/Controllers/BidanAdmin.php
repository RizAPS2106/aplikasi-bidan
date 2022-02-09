<?php

namespace App\Controllers;

use \App\Models\UsersModel;

class BidanAdmin extends BaseController
{
    public function index()
    {
        $user = new UsersModel();
        $data = [
            'title' => "Admin Bidan",
            'header' => "Data Bidan",
            'bidans' => $user->where('group_user', 3)->findAll()
        ];

        echo view('admin/bidan/admin_data_bidan', $data);
    }

    public function preview($id)
    {
        $user = new UsersModel();

        $data = [
            'title' => "Admin Bidan",
            'header' => "Detail Bidan",
            'bidan' => $user->where('id', $id)->first()
        ];
        echo view('admin/bidan/admin_detail_bidan', $data);
    }

    public function create()
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
                "saldo" => 0,
                "group_user" => 3
            ]);

            $message = 'Data Berhasil disimpan';

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

    public function preview_edit()
    {
        $id = $this->request->getGet('id');

        $user = new UsersModel();
        $data['bidan'] = $user->where('id', $id)->first();

        echo json_encode($data['bidan']);
    }

    public function edit()
    {
        $id = $this->request->getPost('id');

        $user = new UsersModel();
        $data['bidan'] = $user->where('id', $id)->first();

        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'id' => 'required',
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'telepon'  => [
                    'label' => 'nomor telepon',
                    'rules' => 'required|numeric|min_length[10]|is_unique[user.telepon,id,{id}]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'numeric' => 'Harap isi kolom {field} dengan nomor',
                        'min_length' => '{field} minimal {param} digit',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                'email'  => [
                    'rules' => 'required|valid_email|is_unique[user.email,id,{id}]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'valid_email' => 'Harap isi email yang valid',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'first_password'  => [
                    'label' => 'Password lama',
                    'rules' => 'min_length[8]|permit_empty',
                    'errors' => [
                        'min_length' => 'Kolom {field} Minimal 8 karakter'
                    ]
                ],
                'password'  => [
                    'rules' => 'min_length[8]|permit_empty',
                    'errors' => [
                        'min_length' => 'Kolom {field} Minimal 8 karakter'
                    ]
                ],
                'password_confirm'  => [
                    'label' => 'konfirmasi password',
                    'rules' => 'min_length[8]|matches[password]|permit_empty',
                    'errors' => [
                        'min_length' => 'Kolom {field} minimal 8 karakter',
                        'matches' => '{field} salah',
                    ]
                ]
            ]
        );

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            if (empty($this->request->getPost('password')) && empty($this->request->getPost('first_password')) && empty($this->request->getPost('password_confirm'))) {
                $user->update($id, [
                    "nama" => $this->request->getPost('nama'),
                    "telepon" => $this->request->getPost('telepon'),
                    "email" => $this->request->getPost('email')
                ]);

                $message = 'Data berhasil diubah';

                echo $message;
            } else {
                $db = \Config\Database::connect();
                $builder = $db->table('user');
                $builder->select('password');
                $builder->where('id', $id);
                $builder->limit(1);
                $query = $builder->get();
                $result = $query->getResultArray();
                foreach ($result as $rst) {
                    $first_password = $rst['password'];
                    $first_password_field = md5($this->request->getPost('first_password'));
                    $password = $this->request->getPost('password');
                    $password_confirm = $this->request->getPost('password_confirm');

                    if ($first_password == $first_password_field) {
                        if ($password != '' || $password_confirm != '') {
                            if ($password == $password_confirm) {
                                $user->update($id, [
                                    "nama" => $this->request->getPost('nama'),
                                    "telepon" => $this->request->getPost('telepon'),
                                    "email" => $this->request->getPost('email'),
                                    "password" => md5($this->request->getPost('password'))
                                ]);

                                $message = 'Data berhasil diubah';
                            } else {
                                $message = 'Password dan konfirmasi password tidak sesuai';
                            }
                        } else {
                            $message = 'Jika ingin mengubah password silahkan isi semua kolom password, jika tidak kosongkan saja';
                        }
                    } else {
                        $message = 'Password lama tidak sesuai';
                    }
                    echo $message;
                }
            }
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

    public function delete($id)
    {
        $user = new UsersModel();
        $user->delete($id);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect('admin/bidan');
    }
}
