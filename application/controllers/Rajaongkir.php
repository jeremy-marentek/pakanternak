<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rajaongkir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keranjang_model');
        $this->load->model('checkout_model');
    }

    //TEMPLATE ADMIN
    public function paggingAdmin($content, $data = NULL)
    {
        //SESSION ADMIN
        $data['session'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id')])->row_array();

        $data['header'] = $this->load->view('template/admin/header', $data, TRUE);
        $data['sidebar'] = $this->load->view('template/admin/sidebar', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $this->load->view('template/admin/index', $data);
    }

    //TEMPLATE penjual
    public function paggingpenjual($content, $data = NULL)
    {
        //Sesion penjual join ke tabel master penjual
        $data['s_penjual'] =
            $this->db->select('*')
            ->from('akun_penjual')
            ->where('id_penjual', $this->session->userdata('id'))
            ->get()->row_array();

        $data['header'] = $this->load->view('template/penjual/header', $data, TRUE);
        $data['sidebar'] = $this->load->view('template/penjual/sidebar', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $this->load->view('template/penjual/index', $data);
    }

    //TEMPLATE PEMBELI
    public function paggingPembeli($content, $data = NULL)
    {
        //Sesion penjual join ke tabel master penjual
        $data['s_penjual'] =
            $this->db->select('*')
            ->from('akun_penjual')
            ->where('id_penjual', $this->session->userdata('id'))
            ->get()->row_array();

        //Session umum
        $data['s_umum'] = $this->db->get_where('akun_umum', ['id_umum' => $this->session->userdata('id')])->row_array();

        $data['header'] = $this->load->view('template/pembeli/header', $data, TRUE);
        $data['sidebar'] = $this->load->view('template/pembeli/sidebar', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $this->load->view('template/pembeli/index', $data);
    }

    //TEMPLATE FRONTEND
    public function paggingFrontend($content, $data = NULL)
    {
        //Query menjumlahkan produk berdasarkan kategori
        $kategori = $this->db->get('kategori')->result_array();
        for ($i = 0; $i < count($kategori); $i++) {
            $id_kategori = $kategori[$i]['id_kategori'];
            $jumlah_produk = $this->db->query("
                SELECT COUNT(*) AS jumlah FROM produk WHERE id_kategori = '$id_kategori'
            ")->row_array();
            $kategori[$i]['jumlah_produk'] = $jumlah_produk['jumlah'];
        }

        $data['kategori'] = $kategori;
        $data['jumlah_produk'] = $this->keranjang_model->jumlah_produk();
        $data['detail_keranjang'] = $this->keranjang_model->data_keranjang();
        $data['website'] = $this->db->get('profile_website')->row_array();
        $data['header'] = $this->load->view('template/frontend/header', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('template/frontend/footer', $data, TRUE);
        $this->load->view('template/frontend/index2', $data);
    }
}
