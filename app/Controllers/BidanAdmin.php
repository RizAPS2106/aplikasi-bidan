<?php

namespace App\Controllers;

use \App\Models\BidanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class BidanAdmin extends BaseController
{
    public function index()
    {
        $bidan = new BidanModel();
        $data['title'] = "Admin Bidan";
        $data['header'] = "Data Bidan";
        $data['bidans'] = $bidan->findAll();

        echo view('admin/bidan/admin_data_bidan', $data);
    }

    public function preview($id)
    {
        $bidan = new BidanModel();
        $data['bidan'] = $bidan->where('id', $id)->first();

        if (!$data['bidan']) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data['title'] = "Admin Bidan - Detail";
        $data['header'] = "Data Bidan";
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
                'alamat'  => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'telepon'  => [
                    'label' => 'nomor telepon',
                    'rules' => 'required|numeric|min_length[10]|is_unique[bidan.telepon]|is_unique[konsumen.telepon]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'numeric' => 'Harap isi kolom {field} dengan nomor',
                        'min_length' => '{field} minimal {param} digit',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ]
            ]
        );

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $bidan = new BidanModel();
            $bidan->save([
                "nama" => $this->request->getPost('nama'),
                "alamat" => $this->request->getPost('alamat'),
                "telepon" => $this->request->getPost('telepon'),
            ]);

            $message = 'Data Berhasil disimpan';

            session()->setFlashData('pesan', $message);

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

        $bidan = new BidanModel();
        $data['bidan'] = $bidan->where('id', $id)->first();

        if (!$data['bidan']) {
            throw PageNotFoundException::forPageNotFound();
        }

        echo json_encode($data['bidan']);
    }

    public function edit()
    {
        $id = $this->request->getPost('id');

        $bidan = new BidanModel();
        $data['bidan'] = $bidan->where('id', $id)->first();

        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'id' => 'required',
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'alamat'  => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'telepon'  => [
                    'label' => 'nomor telepon',
                    'rules' => 'required|numeric|min_length[10]|is_unique[bidan.telepon,id,{id}]|is_unique[konsumen.telepon]',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}',
                        'numeric' => 'Harap isi kolom {field} dengan nomor',
                        'min_length' => '{field} minimal {param} digit',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ]
            ]
        );

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $bidan->update($id, [
                "nama" => $this->request->getPost('nama'),
                "alamat" => $this->request->getPost('alamat'),
                "telepon" => $this->request->getPost('telepon')
            ]);

            $message = 'Data berhasil diubah';

            session()->setFlashData('pesan', $message);

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

    public function delete($id)
    {
        $bidan = new BidanModel();
        $bidan->delete($id);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect('admin/bidan');
    }
}
