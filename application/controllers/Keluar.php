<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Keluar extends REST_Controller
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
            $this->db->select('kode_barang_keluar, kode_barang, nama_barang, gambar_barang, nama_konsumen, alamat_konsumen, kontak_konsumen, kuantitas_barang_keluar, tanggal_waktu_barang_keluar, catatan_barang_keluar');
            $this->db->from('barang_keluar');
            $this->db->join('barang', 'kode_barang_barang_keluar = kode_barang');
            $this->db->join('konsumen', 'kode_konsumen_barang_keluar = kode_konsumen');
            $barang_keluar = $this->db->get()->result();
        } else {
            $this->db->select('kode_barang_keluar, kode_barang, nama_barang, gambar_barang, nama_konsumen, alamat_konsumen, kontak_konsumen, kuantitas_barang_keluar, tanggal_waktu_barang_keluar, catatan_barang_keluar');
            $this->db->from('barang_keluar');
            $this->db->join('barang', 'kode_barang_barang_keluar = kode_barang');
            $this->db->join('konsumen', 'kode_konsumen_barang_keluar = kode_konsumen');
            $this->db->where('kode_barang_keluar', $kode);
            $barang_keluar = $this->db->get()->result();
        }
        $this->response(
            array(
                'status' => 200,
                'message' => 'Berhasil diambil',
                'data' => $barang_keluar
            ),
            200
        );
    }

    function index_post()
    {
        $data = array(
            'kode_barang_barang_keluar'   => $this->post('kode_barang'),
            'kode_konsumen_barang_keluar'  => $this->post('kode_konsumen'),
            'kuantitas_barang_keluar'     => $this->post('kuantitas'),
            'tanggal_waktu_barang_keluar' => $this->post('tanggal_waktu'),
            'catatan_barang_keluar'       => $this->post('catatan')
        );
        $insert = $this->db->insert('barang_keluar', $data);
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
        $this->db->where('kode_barang_keluar', $this->delete('kode'));
        $this->db->delete('barang_keluar');
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
