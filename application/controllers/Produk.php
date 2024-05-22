<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
    }

    //=========================================
    //                penjual
    //=========================================

    //view data produk
    public function data_produk()
    {
        $data['title'] = 'Warma CIC | Produk';
        $data['produk'] = $this->produk_model->getdata_Produk();
        $this->paggingpenjual('penjual/produk/data_produk', $data);
    }

    //tambah Produk
    public function tambah_produk()
    {
        $data['title'] = 'Warma CIC | Tambah Produk';
        $data['kategori'] = $this->db->get('kategori')->result_array();

        //set rules form validation
        $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kategori', 'kategori', 'required|trim', [
            'required' => 'Harap pilih kategori'
        ]);
        $this->form_validation->set_rules('harga', 'harga', 'required|trim|numeric', [
            'required' => 'Form ini tidak boleh kosong',
            'numeric'  => 'Harus di isi dengan angka'
        ]);
        $this->form_validation->set_rules('stok', 'stok', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong',
            'numeric'  => 'Harus di isi dengan angka'
        ]);
        $this->form_validation->set_rules('berat', 'berat', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong',
            'numeric'  => 'Harus di isi dengan angka'
        ]);
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required|trim', [
            'required' => 'Form ini tidak oleh kosong'
        ]);

        //jika validasi salah 
        if ($this->form_validation->run() == FALSE) {
            $this->paggingpenjual('penjual/produk/tambah_produk', $data);
        } else {
            $this->produk_model->tambahProduk();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di tambahkan"></div>');
            redirect('produk/data_produk');
        }
    }

    public function detail_produk($id)
    {
        $data['title'] = 'Warma CIC | Detail Produk';
        $data['produk'] = $this->produk_model->getProduk_id($id);
        $this->paggingpenjual('penjual/produk/detail_produk', $data);
    }

    //edit produk
    public function edit_produk($id)
    {
        $data['title'] = 'Warma CIC | Edit Produk';
        $data['produk'] = $this->produk_model->getProduk_id($id);
        $data['kategori'] = $this->db->get('kategori')->result_array();

        //set rules form validation
        $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kategori', 'kategori', 'required|trim', [
            'required' => 'Harap pilih kategori'
        ]);
        $this->form_validation->set_rules('harga', 'harga', 'required|trim|numeric', [
            'required' => 'Form ini tidak boleh kosong',
            'numeric'  => 'Harus di isi dengan angka'
        ]);
        $this->form_validation->set_rules('stok', 'stok', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong',
            'numeric'  => 'Harus di isi dengan angka'
        ]);
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required|trim', [
            'required' => 'Form ini tidak oleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->paggingpenjual('penjual/produk/edit_produk', $data);
        } else {
            $this->produk_model->editProduk();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di ubah"></div>');
            redirect('produk/data_produk');
        }
    }

    //hapus produk
    public function hapus_produk($id)
    {
        $this->produk_model->hapusProduk($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di hapus"></div>');
        redirect('produk/data_produk');
    }

    //nonaktifkan status produk
    public function nonaktifkan_statusproduk($id)
    {
        $this->produk_model->nonaktifkan_statusProduk($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-nonaktif="Produk berhasil di nonaktifkan"></div>');
        redirect('produk/data_produk');
    }

    //aktifkan status produk
    public function aktifkan_statusProduk($id)
    {
        $this->produk_model->aktifkan_statusProduk($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-aktif="Produk berhasil di aktifkan"></div>');
        redirect('produk/data_produk');
    }

    //=========================================
    //                FRONTEND
    //=========================================

    //Get data seluruh produk
    public function data_produk_frontend($sortby = '', $id_produk = "")
    {
        $data['title'] = 'Warma CIC | Produk';
        $produk = $this->produk_model->getdata_produkFrontend($sortby);
        if (!empty(trim($sortby)) && !empty(trim($id_produk))) {
            $produk = $this->produk_model->getdata_produkByKategori($id_produk);
        }
        $data['produk'] = $produk;
        $this->paggingFrontend('frontend/data_produk', $data);
    }

    //detail produk 
    public function detail_produk_frontend($id)
    {
        $data['title'] = 'Warma CIC | Detail Produk';
        $data['produk'] = $this->produk_model->detailproduk_Frontend($id);
        $this->paggingFrontend('frontend/detail_produk', $data);
    }

    //cari produk
    public function cari_produk()
    {
        // $kategori = $this->input->post('kategori');
        $keyword =  $this->input->post('keyword', true);

        $data['title'] = 'Warma CIC | Cari Produk';
        $data['produk'] = $this->produk_model->cariProduk($keyword);
        $this->paggingFrontend('frontend/data_produk', $data);
    }
}
