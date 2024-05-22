<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('produk_model');
    }

    //===========================================
    //               AKUN penjual
    //===========================================
    public function data_akun_penjual()
    {
        $data['title'] = 'Warma CIC | Akun penjual';
        $data['penjual'] = $this->user_model->getAkun_penjual();
        $this->paggingAdmin('admin/akun_penjual/data_akun_penjual', $data);
    }

    //lihat detail akun penjual
    public function detail_akun_penjual($id)
    {
        $data['title'] = 'Warma CIC | Detail Akun penjual';
        $data['penjual'] = $this->user_model->getpenjual_id($id);
        $this->paggingAdmin('admin/akun_penjual/detail_akun_penjual', $data);
    }

    //detail produk penjual
    public function detail_produk_penjual($id)
    {
        $data['title'] = 'Warma CIC | Detail Produk penjual';
        $data['penjual'] = $this->user_model->getpenjual_id($id);
        $data['produk'] = $this->produk_model->getProduk_idpenjual($id);
        $this->paggingAdmin('admin/akun_penjual/detail_produk_penjual', $data);
    }

    //nonaktifkan status akun penjual
    public function nonaktifkan_statusakun_penjual($id)
    {
        $this->user_model->nonaktifkan_statusAkun_penjual($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-nonaktif="Akun berhasil di nonaktifkan"></div>');
        redirect('akun/data_akun_penjual');
    }

    //aktifkan status penjual
    public function aktifkan_statusakun_penjual($id)
    {
        $this->user_model->aktifkan_statusAkun_penjual($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-aktif="Akun berhasil di aktifkan"></div>');
        redirect('akun/data_akun_penjual');
    }

    //nonaktifkan status produk
    public function nonaktifkan_status_produk($id)
    {
        $this->produk_model->nonaktifkan_statusProduk($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-nonaktif="Produk berhasil di nonaktifkan"></div>');
        echo '<script>window.history.back();</script>';
    }

    //aktifkan status produk
    public function aktifkan_status_produk($id)
    {
        $this->produk_model->aktifkan_statusProduk($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-aktif="Produk berhasil di aktifkan"></div>');
        echo '<script>window.history.back();</script>';
    }


    //===========================================
    //               AKUN UMUM
    //===========================================
    public function data_akun_umum()
    {
        $data['title'] = 'Warma CIC | Akun Umum';
        $data['umum'] = $this->user_model->getAkun_Umum();
        $this->paggingAdmin('admin/akun_umum/data_akun_umum', $data);
    }

    //lihat detail akun umum
    public function detail_akun_umum($id)
    {
        $data['title'] = 'Warma CIC | Detail Akun Pengguna Umum';
        $data['umum'] = $this->user_model->getUmum_id($id);
        $this->paggingAdmin('admin/akun_umum/detail_akun_umum', $data);
    }

    //nonaktifkan status akun umum
    public function nonaktifkan_statusakun_umum($id)
    {
        $this->user_model->nonaktifkan_statusAkun_Umum($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-nonaktif="Akun berhasil di nonaktifkan"></div>');
        redirect('akun/data_akun_umum');
    }

    //aktifkan status akun umum
    public function aktifkan_statusakun_umum($id)
    {
        $this->user_model->aktifkan_statusAkun_Umum($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-aktif="Akun berhasil di aktifkan"></div>');
        redirect('akun/data_akun_umum');
    }
}
