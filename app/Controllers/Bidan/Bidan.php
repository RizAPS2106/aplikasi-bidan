<?php

namespace App\Controllers\Bidan;

use \App\Controllers\BaseController;
use \App\Models\UserModel;
use \App\Models\CabangModel;
use \App\Models\OrderModel;
use \App\Models\DetailOrderModel;

class Bidan extends BaseController
{
    public function index()
    {
        $order = new OrderModel();
        $detail_order = new DetailOrderModel();

        $data = [
            'title' => "Bidan",
            'header' => "Dashboard",
            'order' => $order->select('order.*,detail_order.*,user.*,user.id as id_user,layanan.*,GROUP_CONCAT(layanan.nama_layanan) as list_layanan')
                ->join('detail_order', 'detail_order.invoice = order.invoice', 'LEFT')
                ->join('user', 'user.id = detail_order.id_user', 'LEFT')
                ->join('layanan', 'layanan.id = detail_order.id_layanan', 'LEFT')
                ->join('master_alamat', 'master_alamat.id = detail_order.id_alamat', 'LEFT')
                ->groupBy('detail_order.invoice')
                ->where('detail_order.tracking !=', 'done')
                ->findAll(),
            'order_done' => $order->select('order.*,detail_order.*,user.*,user.id as id_user,layanan.*,GROUP_CONCAT(layanan.nama_layanan) as list_layanan')
                ->join('detail_order', 'detail_order.invoice = order.invoice', 'LEFT')
                ->join('user', 'user.id = detail_order.id_user', 'LEFT')
                ->join('layanan', 'layanan.id = detail_order.id_layanan', 'LEFT')
                ->join('master_alamat', 'master_alamat.id = detail_order.id_alamat', 'LEFT')
                ->groupBy('detail_order.invoice')
                ->where('detail_order.tracking', 'done')
                ->findAll()
        ];

        echo view('bidan/bidan_dashboard', $data);
    }

    public function profil()
    {
        $user = new UserModel();
        $cabang = new CabangModel();

        $id_user = session()->get('id_user');

        $data = [
            'title' => "Profil Bidan",
            'header' => "Profil",
            'profil' => $user->select('user.*,cabang.nama as nama_cabang')->join('cabang', 'cabang.id = user.id_cabang', 'LEFT')->where('user.id', $id_user)->first(),
            'cabang' => $cabang->findAll(),
        ];

        echo view('bidan/bidan_profil', $data);
    }

    public function profil_preview_edit()
    {
        $user = new UserModel();

        $id_user = session()->get('id_user');

        $data = $user->where('id', $id_user)->first();

        echo json_encode($data);
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
}
