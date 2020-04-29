<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jurusan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusan_model', 'jurusan');
    }

    public function index_get()
    {
        $kd = $this->get('kdjurusan');
        if ($kd === null) {
            $jurusan = $this->jurusan->getJurusan();
        } else {
            $jurusan = $this->jurusan->getJurusan($kd);
        }

        if ($jurusan) {
            $this->response([
                'status' => true,
                'data' => $jurusan
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Sorry, Code not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $kd = $this->delete('kdjurusan');
        if ($kd === null) {
            $this->response([
                'status' => false,
                'message' => 'Please provide ID'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->jurusan->deleteJurusan($kd) > 0) {
                $this->response([
                    'status' => true,
                    'kd' => $kd,
                    'message' => 'Success Deleted.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Sorry, Code not found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'kdjurusan' => $this->post('kdjurusan'),
            'namajurusan' => $this->post('namajurusan'),
        ];
        if ($this->jurusan->createJurusan($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Jurusan added successfully.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Sorry, failed to create new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $kd = $this->put('kdjurusan');
        $data = [
            'namajurusan' => $this->put('namajurusan'),
        ];
        if ($this->jurusan->updateJurusan($data, $kd) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Jurusan updated successfully.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Sorry, failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
