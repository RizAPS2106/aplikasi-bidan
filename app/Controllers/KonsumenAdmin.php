<?php

namespace App\Controllers;

use \App\Models\KonsumenModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KonsumenAdmin extends BaseController
{
    public function index()
    {
        $konsumen = new KonsumenModel();
        $data['title'] = "Admin Konsumen";
        $data['header'] = "Data Konsumen";
        $data['konsumens'] = $konsumen->findAll();
        echo view('admin/konsumen/admin_data_konsumen', $data);
    }

    public function preview($id)
    {
        $konsumen = new KonsumenModel();
        $data['konsumen'] = $konsumen->where('id', $id)->first();

        if (!$data['konsumen']) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data['title'] = "Admin Konsumen";
        $data['header'] = "Data Konsumen";
        echo view('admin/konsumen/admin_detail_konsumen', $data);
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
                    'rules' => 'required|numeric|min_length[10]|is_unique[konsumen.telepon]|is_unique[konsumen.telepon]',
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
            $konsumen = new KonsumenModel();
            $konsumen->save([
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

        $konsumen = new KonsumenModel();
        $data['konsumen'] = $konsumen->where('id', $id)->first();

        if (!$data['konsumen']) {
            throw PageNotFoundException::forPageNotFound();
        }

        echo json_encode($data['konsumen']);
    }

    public function edit()
    {
        $id = $this->request->getPost('id');

        $konsumen = new konsumenModel();
        $data['konsumen'] = $konsumen->where('id', $id)->first();

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
                    'rules' => 'required|numeric|min_length[10]|is_unique[bidan.telepon]|is_unique[konsumen.telepon,id,{id}]',
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
            $konsumen->update($id, [
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
        $konsumen = new KonsumenModel();
        $konsumen->delete($id);

        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect('admin/konsumen');
    }
}
