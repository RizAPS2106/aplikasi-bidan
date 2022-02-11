<?php

namespace App\Controllers;

use \App\Models\LayananModel;

class Layanan extends BaseController
{
    public function create()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'nama_layanan' => [
                    'label' => 'Nama Layanan',
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'harga'  => [
                    'label' => 'Harga',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'numeric' => 'Harap isi kolom {field} dengan nomor'
                    ]
                ]
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        $harga = str_replace(".", "", $this->request->getPost('harga'));

        if ($isDataValid) {
            $layanan = new LayananModel();
            $layanan->insert([
                "nama_layanan" => $this->request->getPost('nama_layanan'),
                "harga" => $harga,
            ]);

            echo 'Data berhasil disimpan';
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

        $layanan = new LayananModel();

        $data = $layanan->where('layanan.id', $id)->first();

        echo json_encode($data);
    }

    public function edit()
    {
        $id = $this->request->getPost('id');

        $layanan = new LayananModel();
        $data = $layanan->where('id', $id)->first();

        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'id' => 'required',
                'nama_layanan' => [
                    'label' => 'Nama Layanan',
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'harga'  => [
                    'label' => 'Harga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}'
                    ]
                ]
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        $harga = str_replace(".", "", $this->request->getPost('harga'));

        if ($isDataValid) {
            $layanan->update($id, [
                "id_cabang" => $this->request->getPost('id_cabang'),
                "nama_layanan" => $this->request->getPost('nama_layanan'),
                "harga" => $harga,
            ]);

            $message = 'Data berhasil diubah';

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

    public function delete($id)
    {
        $layanan = new LayananModel();
        $layanan->delete($id);

        echo 'Data berhasil dihapus';
    }
}
