<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('keranjang_model');
    }

    //Halaman Keranjang Belanja
    public function halaman_keranjang()
    {
        if (!$this->session->userdata('id')) {
            redirect('auth/login_umum');
        }

        $data['title'] = 'Warma CIC | Keranjang';
        $data['keranjang'] = $this->keranjang_model->data_keranjang();
        $this->paggingFrontend('frontend/halaman_keranjang', $data);
    }

    //Tambahkan ke keranjang
    public function tambah_keranjang($id_produk)
    {
        if (!$this->session->userdata('id')) {
            redirect('auth/login_umum');
        }

        $insert = $this->keranjang_model->tambah_keranjang($id_produk);
        if ($insert == 1) {
            $this->session->set_flashdata('message', '<div class="flash-data" data-tambahkeranjang="Produk berhasil ditambahkan"></div>');
        } else if ($insert == 2) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Gagal menambahkan ke keranjang</div>');
        } else if ($insert == 3) {
            $this->session->set_flashdata('message', '<div class="flash-data" data-keranjanggagal="Tidak dapat membeli produk sendiri"></div>');
        }
        echo '<script>window.history.back();</script>';
    }

    //Hapus produk di keranjang
    public function hapus_produk($id_produk)
    {
        $this->keranjang_model->hapus_produk($id_produk);
        $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di hapus"></div>');
        echo '<script>window.history.back();</script>';
    }

    //Update kuantitas otomatis
    public function update_kuantitas($id_detail)
    {
        $kuantitas = $this->input->post('kuantitas');
        $id_produk = $this->input->post('id_produk');
        $produk = $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();

        if ($kuantitas > $produk['stok_produk']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Tidak boleh lebih dari stok produk</div>');
        } else if ($kuantitas <= 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Kuantitas tidak boleh kurang dari nol</div>');
        } else {

            $data = [
                'id_detail' => $id_detail,
                'id_produk' => $id_produk,
                'kuantitas' => $kuantitas
            ];
            $this->keranjang_model->update_kuantitas($id_detail, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" align="center" role="alert">Berhasil mengupdate kuantitas</div>');
        }
        redirect('keranjang/halaman_keranjang');
    }
}
