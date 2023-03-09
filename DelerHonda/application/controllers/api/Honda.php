<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Honda extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Honda_model');
    }

    public function index_get()
    {
        $nama = $this->get('nama');
        if ($nama === null) {
            $honda = $this->Honda_model->getHonda();
        } else {
            $honda = $this->Honda_model->getHonda($nama);
        }

        if ($honda) {
            $this->response([
                'data' => $honda
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE
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
            if ($this->Honda_model->deleteHonda($nama) > 0) {
                $this->response([
                    'id' => $nama
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
            'harga' => $this->post('harga'),
        ];

        if ($this->Honda_model->createHonda($data) > 0) {
            $this->response([
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

        if ($this->Honda_model->updateHonda($data, $id) > 0) {
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
