<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('laporan_model');
        $this->load->model('checkout_model');
    }

    //===========================================
    //                  ADMIN
    //===========================================

    public function laporan_transaksi()
    {
        $data = [
            'transaksi' => [],
            'tgl_awal' => "",
            'tgl_akhir' => "",
        ];
        if (isset($_GET['tgl_awal'], $_GET['tgl_akhir'])) {
            $tgl_awal = $this->input->get('tgl_awal');
            $tgl_akhir = $this->input->get('tgl_akhir');

            $query = $this->db->select('*')
                ->from('transaksi')
                ->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang')
                ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
                ->join('keranjang', 'transaksi.id_keranjang = keranjang.id_keranjang')
                ->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
                ->where('akun_penjual.username')
                ->where('DATE(waktu_transaksi) >=', $tgl_awal)
                ->where('DATE(waktu_transaksi) <=', $tgl_akhir)
                ->group_by('transaksi.order_id')
                ->order_by('waktu_transaksi', 'DESC')
                ->get()->result_array();
            //print_r($query);
            $data['transaksi'] = $query;
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
        }

        $data['title'] = 'Warma CIC | Laporan Transaksi';
        //$data['filter'] = $filter;
        $this->paggingAdmin('admin/laporan/laporan_transaksi', $data);
    }

    //detail laporan transaksi
    public function detail_laporan_transaksi($id)
    {
        $data['title'] = 'Warma CIC | Laporan Transaksi';
        $data['transaksi'] = $this->checkout_model->detail_transaksiAdmin($id);
        // $data['item'] = $this->checkout_model->detail_itemAdmin($id);

        $list_penjual = $this->db->select('DISTINCT(akun_penjual.id_penjual), penjual.nama_penjual')
            ->from('keranjang')
            ->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang')
            ->join('transaksi', 'detail_keranjang.id_keranjang = transaksi.id_keranjang')
            ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
            ->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
            ->join('akun_penjual.username')
            ->where('transaksi.order_id', $id)
            ->get()->result_array();

        //Untuk ambil data detail keranjang
        $detail_keranjang = $this->db->select('*')
            ->from('keranjang')
            ->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang')
            ->join('transaksi', 'detail_keranjang.id_keranjang = transaksi.id_keranjang')
            ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
            ->where('transaksi.order_id', $id)
            ->get()->result_array();

        $list_penjual = [];

        foreach ($detail_keranjang as $detail) {
            $list_penjual[] = $detail['id_penjual'];
        }

        $data['list_penjual'] = $list_penjual;
        $data['detail_keranjang'] = $detail_keranjang;
        $this->paggingAdmin('admin/laporan/detail_laporan', $data);
    }

    //print laporan transaksi
    public function print_laporan_transaksi()
    {
        $data['transaksi'] = [];
        if (isset($_GET['tgl_awal'], $_GET['tgl_akhir'])) {
            $tgl_awal = $this->input->get('tgl_awal');
            $tgl_akhir = $this->input->get('tgl_akhir');

            $query = $this->db->select('*')
                ->from('transaksi')
                ->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang')
                ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
                ->join('keranjang', 'transaksi.id_keranjang = keranjang.id_keranjang')
                ->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
                ->join('akun_penjual.username')
                ->where('DATE(waktu_transaksi) >=', $tgl_awal)
                ->where('DATE(waktu_transaksi) <=', $tgl_akhir)
                ->group_by('transaksi.order_id')
                ->order_by('waktu_transaksi', 'DESC')
                ->get()->result_array();
            //print_r($query);
            $data['transaksi'] = $query;
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
        }

        $this->load->view('admin/laporan/print_laporan', $data);
    }

    //===========================================
    //                  penjual
    //===========================================

    public function laporan_penjualan()
    {
        $data = [
            'transaksi' => [],
            'tgl_awal' => "",
            'tgl_akhir' => "",
        ];
        if (isset($_GET['tgl_awal'], $_GET['tgl_akhir'])) {
            $tgl_awal = $this->input->get('tgl_awal');
            $tgl_akhir = $this->input->get('tgl_akhir');

            $query = $this->db->select('*')
                ->from('transaksi')
                ->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang')
                ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
                ->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
                ->where('DATE(waktu_transaksi) >=', $tgl_awal)
                ->where('DATE(waktu_transaksi) <=', $tgl_akhir)
                ->where('produk.id_penjual', $this->session->userdata('id'))
                ->where('transaksi.status_pesanan', 'Selesai')
                ->order_by('waktu_transaksi', 'DESC')
                ->group_by('transaksi.order_id')
                ->get()->result_array();
            //print_r($query);
            $data['transaksi'] = $query;
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
        }

        $data['title'] = 'Warma CIC | Laporan penjualan';
        $this->paggingpenjual('penjual/laporan/laporan_penjualan', $data);
    }

    public function detail_laporan_penjualan($id)
    {
        $data['title'] = 'Warma CIC | Detail Laporan';
        $data['transaksi'] = $this->checkout_model->getDetail_transaksipenjual($id);
        $data['item'] = $this->checkout_model->detailitem_penjual($id);
        $this->paggingpenjual('penjual/laporan/detail_laporan', $data);
    }
}
