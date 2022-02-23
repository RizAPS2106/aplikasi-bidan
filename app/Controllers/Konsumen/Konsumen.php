<?php

namespace App\Controllers\Konsumen;

use \App\Controllers\BaseController;
use \App\Models\UserModel;
use \App\Models\AlamatModel;

class Konsumen extends BaseController
{
    public function profil()
    {
        $user = new UserModel();

        $id_user = session()->get('id_user');

        $data = [
            'title' => "Profil",
            'profil' => $user->where('id', $id_user)->first()
        ];

        echo view('profil', $data);
    }

    public function profil_edit()
    {
        $id_user = $this->request->getPost('id');

        $user = new UserModel();
        $data = $user->where('id', $id_user)->first();

        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'id' => 'required',
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'telepon' => [
                    'label' => 'nomor telepon',
                    'rules' => 'required|numeric|min_length[10]|is_unique[user.telepon,id,{id}]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'numeric' => 'Harap isi kolom {field} dengan nomor',
                        'min_length' => '{field} minimal {param} digit',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[user.email,id,{id}]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'valid_email' => 'Harap isi email yang valid',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'first_password' => [
                    'label' => 'Password lama',
                    'rules' => 'min_length[8]|permit_empty',
                    'errors' => [
                        'min_length' => 'Kolom {field} Minimal 8 karakter'
                    ]
                ],
                'password' => [
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
            $first_password_data = $data['password'];
            $first_password = $this->request->getPost('first_password');
            $password = $this->request->getPost('password');
            $password_confirm = $this->request->getPost('password_confirm');

            if (empty($password) && empty($first_password) && empty($password_confirm)) {
                $user->update($id_user, [
                    "nama" => $this->request->getPost('nama'),
                    "telepon" => $this->request->getPost('telepon'),
                    "email" => $this->request->getPost('email')
                ]);

                echo 'Data berhasil diubah';
            } else {
                if (md5($first_password) == $first_password_data) {
                    if ($password != '' || $password_confirm != '') {
                        if ($password == $password_confirm) {
                            $user->update($id_user, [
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

    public function saldo()
    {
        $user = new UserModel();

        $id_user = session()->get('id_user');

        $data = [
            'title' => "Profil",
            'profil' => $user->where('id', $id_user)->first()
        ];

        echo view('saldo', $data);
    }

    public function alamat()
    {
        $user = new UserModel();
        $alamat = new AlamatModel();

        $id_user = session()->get('id_user');

        $data = [
            'title' => "Profil",
            'profil' => $user->where('id', $id_user)->first(),
            'alamat' => $alamat->where('id_user', $id_user)->where('status_alamat', 'enable')->first(),
            'alamat_disable' => $alamat->where('id_user', $id_user)->where('status_alamat', 'disable')->findAll()
        ];

        echo view('alamat', $data);
    }

    public function saldo_add()
    {
        $id_user = session()->get('id_user');

        $user = new UserModel();
        $data = $user->where('id', $id_user)->first();

        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'saldo' => [
                    'label' => 'Tambah saldo',
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'greater_than' => 'Harap isi kolom {field} dengan angka yang lebih besar dari 0'
                    ]
                ]
            ]
        );

        $saldo_lama = $data['saldo'];
        $saldo_baru = (int)$saldo_lama + (int)str_replace(".", "", $this->request->getPost('saldo'));

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $user->update($id_user, [
                "saldo" => $saldo_baru
            ]);

            echo "Saldo berhasil ditambahkan";
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

    public function alamat_add()
    {
        $alamat = new AlamatModel();

        $id_user = session()->get('id_user');

        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ]
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $max_id = $alamat->select('MAX(id) as max_id')->first();

            $id = $max_id['max_id'] + 1;

            $alamat->set("status_alamat", "disable")->where('id_user', $id_user)->whereNotIn('id', $id)->update();

            $alamat->insert([
                "id_user" => $id_user,
                "alamat" => $this->request->getPost('alamat'),
                "status_alamat" => 'enable'
            ]);

            echo 'Alamat berhasil disimpan';
        } else {
            $message = $validation->getErrors();

            foreach ($message as $msg) {
                if ($msg == end($message)) {
                    echo ucfirst($msg . '.');
                } else {
                    echo ucfirst($msg . ', ');
                }
            }
        }
    }

    public function alamat_pick()
    {
        $alamat = new AlamatModel();

        $id_user = session()->get('id_user');

        $max_id = $alamat->select('MAX(id) as max_id')->first();

        $id_disable = $max_id['max_id'] + 1;
        $id_enable = $this->request->getPost("id_alamat");

        $alamat->set("status_alamat", "disable")->where('id_user', $id_user)->whereNotIn('id', $id_disable)->update();
        $alamat->set("status_alamat", "enable")->where('id_user', $id_user)->where('id', $id_enable)->update();

        echo $id_enable;
    }
}
