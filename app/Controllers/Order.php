<?php

namespace App\Controllers;

use \App\Controllers\BaseController;
use \App\Models\LayananModel;
use \App\Models\AlamatModel;
use \App\Models\DetailOrderModel;
use \App\Models\OrderModel;

class Order extends BaseController
{
    public function index()
    {
        $id_user = session()->get('id_user');

        $layanan = new LayananModel();
        $alamat = new AlamatModel();
        $order = new OrderModel();

        $data = [
            'title' => "Pesan Layanan",
            'invoice' => $order->select('MAX(invoice) as max_invoice')->first(),
            'layanan' => $layanan->findAll(),
            'alamat' => $alamat->where('id_user', $id_user)->where('status_alamat', 'enable')->first(),
            'alamat_disable' => $alamat->where('id_user', $id_user)->where('status_alamat', 'disable')->findAll()
        ];

        echo view('pesan_bidan', $data);
    }

    public function create()
    {
        $detail_order = new DetailOrderModel();
        $order = new OrderModel();

        $id_user = session()->get('id_user');

        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'invoice' => [
                    'label' => 'Invoice',
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap isi kolom {field}']
                ],
                'layanan' => [
                    'label' => 'Layanan',
                    'rules' => 'required',
                    'errors' => ['required' => 'Harap pilih {field}']
                ],
                'jadwal' => [
                    'label' => 'Jadwal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harap isi kolom {field}'
                    ]
                ],
                'layanan_detail' => [
                    'label' => 'Pelayanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harap pilih {field}'
                    ]
                ],
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            foreach ($this->request->getPost('layanan') as $layanan) {
                $data_layanan = json_decode($layanan);
                $id_layanan = $data_layanan->{'id'};
                $harga_layanan = $data_layanan->{'harga'};

                if ($this->request->getPost('layanan_detail') == "onsite") {
                    $detail_order->insert([
                        "invoice" => $this->request->getPost('invoice'),
                        "id_user" => $id_user,
                        "id_layanan" => $id_layanan,
                        "harga" => $harga_layanan,
                        "jadwal" => $this->request->getPost('jadwal'),
                        "layanan_detail" => $this->request->getPost('layanan_detail'),
                        "tracking" => "menuju_lokasi"
                    ]);
                } else if ($this->request->getPost('layanan_detail') == "homecare") {
                    $detail_order->insert([
                        "invoice" => $this->request->getPost('invoice'),
                        "id_user" => $id_user,
                        "id_layanan" => $id_layanan,
                        "harga" => $harga_layanan,
                        "jadwal" => $this->request->getPost('jadwal'),
                        "layanan_detail" => $this->request->getPost('layanan_detail'),
                        "id_alamat" => $this->request->getPost('id_alamat'),
                        "tracking" => "menuju_lokasi"
                    ]);
                } else {
                    echo "Error";
                }
            }

            $order->insert([
                "invoice" => $this->request->getPost('invoice'),
                "total_harga" => $this->request->getPost('total_harga')
            ]);

            echo 'Pesanan berhasil dibuat';
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
