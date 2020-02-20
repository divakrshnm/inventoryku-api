<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Barang extends REST_Controller
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
            $barang = $this->db->get('barang')->result();
        } else {
            $this->db->where('kode_barang', $kode);
            $barang = $this->db->get('barang')->result();
        }
        $this->response(
            array(
                'status' => 200,
                'message' => 'Berhasil diambil',
                'data' => $barang
            ),
            200
        );
    }

    function index_post()
    {
        if (!empty($_FILES["gambar"]["name"])) {
            $config['upload_path']          = './images/barang/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite']            = true;
            $config['max_size']             = 1024;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $nama_gambar = $this->upload->data("file_name");
            }
            $data = array(
                'kode_barang' => $this->post('kode'),
                'nama_barang' => $this->post('nama'),
                'catatan_barang' => $this->post('catatan'),
                'gambar_barang' => $nama_gambar
            );
            $insert = $this->db->insert('barang', $data);
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
                'kode_barang' => $this->post('kode'),
                'nama_barang' => $this->post('nama'),
                'catatan_barang' => $this->post('catatan')
            );
            $insert = $this->db->insert('barang', $data);
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
            $config['upload_path']          = './images/barang/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite']            = true;
            $config['max_size']             = 1024;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $nama_gambar = $this->upload->data("file_name");
            }
            $data = array(
                'kode_barang' => $this->post('kode'),
                'nama_barang' => $this->post('nama'),
                'catatan_barang' => $this->post('catatan'),
                'gambar_barang' => $nama_gambar
            );
            $this->db->where('kode_barang', $this->post('kode'));
            $this->db->update('barang', $data);
            // echo $this->db->last_query();
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
                'kode_barang' => $this->post('kode'),
                'nama_barang' => $this->post('nama'),
                'catatan_barang' => $this->post('catatan')
            );
            $this->db->where('kode_barang', $this->post('kode'));
            $this->db->update('barang', $data);
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
        $this->db->where('kode_barang', $this->delete('kode'));
        $this->db->delete('barang');
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
