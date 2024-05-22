<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penjual extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('produk_model');
    }

    //view data penjual
    public function data_penjual($sortby = '', $id_penjual = '')
    {
        $data['title'] = 'Warma CIC | Data penjual';
    
        // Query menjumlahkan penjual berdasarkan id_prodi
        if (is_array($id_penjual) && count($id_penjual) > 0) {
            $jumlah_penjual = $this->db->query("
                SELECT COUNT(*) AS jumlah FROM akun_penjual WHERE username IN (
                    SELECT username FROM akun_penjual
                )
            ")->row_array();
        } else {
            $jumlah_penjual = ['jumlah' => 0]; // Inisialisasi jika $id_penjual bukan array atau kosong
        }
    
        // Mendapatkan data penjual
        $penjual = $this->user_model->getdata_penjual($sortby);
        if (!empty(trim($sortby)) && !empty(trim($id_penjual))) {
            $penjual = $this->user_model->getdata_penjualByprodi($id_penjual);
        }
        $data['penjual'] = $penjual;
        $this->paggingFrontend('frontend/data_penjual', $data);
    }
    

    //detail penjual 
    public function detail_penjual($id)
    {
        $data['title'] = 'Warma CIC | Detail penjual';
        $data['penjual'] = $this->user_model->getdetail_penjual($id);
        $data['produk'] = $this->produk_model->getProduk_idpenjual($id);
        $this->paggingFrontend('frontend/detail_penjual', $data);
    }
}
