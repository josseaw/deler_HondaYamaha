<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Yamaha extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Yamaha_model');
    }

    public function index_get()
    {
        $nama = $this->get('nama');
        if ($nama === null) {
            $yamaha = $this->Yamaha_model->getYamaha();
        } else {
            $yamaha = $this->Yamaha_model->getYamaha($nama);
        }

        if ($yamaha) {
            $this->response([
                'status' => TRUE,
                'message' => 'Berhasil Diambil',
                'data' => $yamaha
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Berhasil Diambil',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $nama = $this->delete('nama');

        if ($nama === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak ada yang dihapus'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->Yamaha_model->deleteYamaha($nama) > 0) {
                $this->response([
                    'status' => TRUE,
                    'id' => $nama,
                    'message' => 'Berhasil dihapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'kategori' => $this->post('kategori'),
            'nama' => $this->post('nama'),
            'deskripsi' => $this->post('deskripsi'),
            'harga' => $this->post('harga')
        ];

        if ($this->Yamaha_model->createYamaha($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Berhasil ditambahkan',
                'data' => $data
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak berhasil ditambahkan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'kategori' => $this->put('kategori'),
            'nama' => $this->put('nama'),
            'deskripsi' => $this->put('deskripsi'),
            'harga' => $this->put('harga')
        ];

        if ($this->Yamaha_model->updateYamaha($data, $id) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Berhasil diupdate',
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak berhasil diupdate'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
