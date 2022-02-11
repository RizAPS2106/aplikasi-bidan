<?php

namespace App\Controllers;

use \App\Models\CabangModel;

class Cabang extends BaseController
{
    public function create()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'kode_cabang' => [
                    'label' => 'Kode cabang',
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'min_length' => '{field} minimal 5 karakter'
                    ]
                ],
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'alamat'  => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}',]
                ]
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $cabang = new CabangModel();
            $cabang->insert([
                "kode_cabang" => $this->request->getPost('kode_cabang'),
                "nama" => $this->request->getPost('nama'),
                "alamat" => $this->request->getPost('alamat')
            ]);

            $message = 'Data berhasil disimpan';
            echo $message;
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

    public function preview_edit()
    {
        $id = $this->request->getGet('id');

        $cabang = new CabangModel();
        $data = $cabang->select('cabang.*,user.id as id_user,user.group_user')->join('user', 'user.id_cabang = cabang.id', 'LEFT')->where('cabang.id', $id)->where('user.group_user', 1)->first();

        echo json_encode($data);
    }

    public function edit()
    {
        $id = $this->request->getPost('id');

        $cabang = new CabangModel();

        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'id' => 'required',
                'kode_cabang' => [
                    'label' => 'Kode cabang',
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'min_length' => '{field} minimal 5 karakter'
                    ]
                ],
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'alamat'  => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}',]
                ]
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $cabang->update($id, [
                "kode_cabang" => $this->request->getPost('kode_cabang'),
                "nama" => $this->request->getPost('nama'),
                "alamat" => $this->request->getPost('alamat')
            ]);
            echo 'Data berhasil diubah';
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

    public function delete($id)
    {
        $cabang = new CabangModel();
        $cabang->delete($id);

        echo 'Data berhasil dihapus';
    }
}
