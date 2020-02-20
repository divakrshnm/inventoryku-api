<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Konsumen extends REST_Controller
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get()
    {
        $kode = $this->get('kode');
        if ($kode == '') {
            $konsumen = $this->db->get('konsumen')->result();
        } else {
            $this->db->where('kode_konsumen', $kode);
            $konsumen = $this->db->get('konsumen')->result();
        }
        $this->response(
            array(
                'status' => 200,
                'message' => 'Berhasil diambil',
                'data' => $konsumen
            ),
            200
        );
    }

    function index_post()
    {
        if (!empty($_FILES["gambar"]["name"])) {
            $config['upload_path']          = './images/konsumen/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite']            = true;
            $config['max_size']             = 1024;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $nama_gambar = $this->upload->data("file_name");
            }
            $data = array(
                'nama_konsumen' => $this->post('nama'),
                'alamat_konsumen' => $this->post('alamat'),
                'kontak_konsumen' => $this->post('kontak'),
                'gambar_konsumen' => $nama_gambar
            );
            $insert = $this->db->insert('konsumen', $data);
            if ($insert) {
                $this->response(
                    array(
                        'status' => 200,
                        'message' => 'Berhasil disimpan'
                    ),
                    200
                );
            } else {
                $this->response(
                    array(
                        'status' => 502,
                        'message' => 'Gagal disimpan'
                    ),
                    200
                );
            }
        } else {
            $data = array(
                'nama_konsumen' => $this->post('nama'),
                'alamat_konsumen' => $this->post('alamat'),
                'kontak_konsumen' => $this->post('kontak')
            );
            $insert = $this->db->insert('konsumen', $data);
            if ($insert) {
                $this->response(
                    array(
                        'status' => 200,
                        'message' => 'Berhasil disimpan'
                    ),
                    200
                );
            } else {
                $this->response(
                    array(
                        'status' => 502,
                        'message' => 'Gagal disimpan'
                    ),
                    200
                );
            }
        }
    }

    function update_post()
    {
        if (!empty($_FILES["gambar"]["name"])) {
            $config['upload_path']          = './images/konsumen/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite']            = true;
            $config['max_size']             = 1024;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $nama_gambar = $this->upload->data("file_name");
            }
            $data = array(
                'kode_konsumen' => $this->post('kode'),
                'nama_konsumen' => $this->post('nama'),
                'alamat_konsumen' => $this->post('alamat'),
                'kontak_konsumen' => $this->post('kontak'),
                'gambar_konsumen' => $nama_gambar
            );
            $this->db->where('kode_konsumen', $this->post('kode'));
            $this->db->update('konsumen', $data);
            if ($this->db->affected_rows()) {
                $this->response(
                    array(
                        'status' => 200,
                        'message' => 'Berhasil diubah'
                    ),
                    200
                );
            } else {
                $this->response(
                    array(
                        'status' => 502,
                        'message' => 'Gagal diubah'
                    ),
                    200
                );
            }
        } else {
            $data = array(
                'kode_konsumen' => $this->post('kode'),
                'nama_konsumen' => $this->post('nama'),
                'alamat_konsumen' => $this->post('alamat'),
                'kontak_konsumen' => $this->post('kontak')
            );
            $this->db->where('kode_konsumen', $this->post('kode'));
            $this->db->update('konsumen', $data);
            if ($this->db->affected_rows()) {
                $this->response(
                    array(
                        'status' => 200,
                        'message' => 'Berhasil diubah'
                    ),
                    200
                );
            } else {
                $this->response(
                    array(
                        'status' => 502,
                        'message' => 'Gagal diubah'
                    ),
                    200
                );
            }
        }
    }

    function index_delete()
    {
        $this->db->where('kode_konsumen', $this->delete('kode'));
        $this->db->delete('konsumen');
        if ($this->db->affected_rows()) {
            $this->response(
                array(
                    'status' => 200,
                    'message' => 'Berhasil dihapus'
                ),
                200
            );
        } else {
            $this->response(
                array(
                    'status' => 502,
                    'message' => 'Gagal dihapus'
                ),
                200
            );
        }
    }
}
