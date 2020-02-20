<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Masuk extends REST_Controller
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
            $this->db->select('kode_barang_masuk, kode_barang, nama_barang, gambar_barang, nama_pemasok, alamat_pemasok, kontak_pemasok, kuantitas_barang_masuk, tanggal_waktu_barang_masuk, catatan_barang_masuk');
            $this->db->from('barang_masuk');
            $this->db->join('barang', 'kode_barang_barang_masuk = kode_barang');
            $this->db->join('pemasok', 'kode_pemasok_barang_masuk = kode_pemasok');
            $barang_masuk = $this->db->get()->result();
        } else {
            $this->db->select('kode_barang_masuk, kode_barang, nama_barang, gambar_barang, nama_pemasok, alamat_pemasok, kontak_pemasok, kuantitas_barang_masuk, tanggal_waktu_barang_masuk, catatan_barang_masuk');
            $this->db->from('barang_masuk');
            $this->db->join('barang', 'kode_barang_barang_masuk = kode_barang');
            $this->db->join('pemasok', 'kode_pemasok_barang_masuk = kode_pemasok');
            $this->db->where('kode_barang_masuk', $kode);
            $barang_masuk = $this->db->get('')->result();
        }
        //echo $this->db->last_query();
        $this->response(
            array(
                'status' => 200,
                'message' => 'Berhasil diambil',
                'data' => $barang_masuk
            ),
            200
        );
    }

    function index_post()
    {
        $data = array(
            'kode_barang_barang_masuk'   => $this->post('kode_barang'),
            'kode_pemasok_barang_masuk'  => $this->post('kode_pemasok'),
            'kuantitas_barang_masuk'     => $this->post('kuantitas'),
            'tanggal_waktu_barang_masuk' => $this->post('tanggal_waktu'),
            'catatan_barang_masuk'       => $this->post('catatan')
        );
        $insert = $this->db->insert('barang_masuk', $data);
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

    function index_delete()
    {
        $this->db->where('kode_barang_masuk', $this->delete('kode'));
        $this->db->delete('barang_masuk');
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
