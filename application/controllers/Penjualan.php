<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penjualan extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('laporan_model');
        $this->load->model('produk_model');
    }

    //=======================================
    //                ADMIN
    //=======================================
    public function penghasilan_penjual()
    {
        $data = [
            'penghasilan' => [],
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
                ->join('akun_penjual.username')
                // ->join('prodi', 'penjual.id_prodi = prodi.id_prodi')
                ->where('DATE(waktu_transaksi) >=', $tgl_awal)
                ->where('DATE(waktu_transaksi) <=', $tgl_akhir)
                ->where(['transaksi.status_pesanan' => "Selesai"])
                ->group_by('akun_penjual.id_penjual')
                ->order_by('penjual.nama_penjual', 'ASC')
                ->get()->result_array();
            //print_r($query);

            $data['penghasilan'] = $query;
            for ($i = 0; $i < count($data['penghasilan']); $i++) {
                $id = $data['penghasilan'][$i]['id_penjual'];
                $data['penghasilan'][$i]['total_penghasilan'] = $this->laporan_model->hitung_penghasilan($id);
            }

            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
        }

        $data['title'] = 'Warma CIC | Penghasilan penjual';
        $this->paggingAdmin('admin/penghasilan/penghasilan_penjual', $data);
    }

    public function detail_penghasilan($id)
    {
        $data['title'] = 'Warma CIC | penjualan';
        $penjualan = $this->laporan_model->get_penjualan_id($id);
        $produk_terjual = 0;
        for ($i = 0; $i < count($penjualan); $i++) {
            $id_produk = $penjualan[$i]['id_produk'];
            $penjualan[$i]['terjual'] = $this->db->query("SELECT SUM(kuantitas) AS terjual FROM detail_keranjang JOIN keranjang USING (id_keranjang) JOIN transaksi USING (id_keranjang) WHERE id_produk = '$id_produk' AND status_pesanan = 'Selesai'")->row()->terjual;
            $produk_terjual += $penjualan[$i]['terjual'];
        }

        $data['penjualan'] = $penjualan;
        $data['produk_terjual'] = $produk_terjual;

        $id = $this->session->userdata('id');
        $data['penghasilan'] = $this->laporan_model->hitung_penghasilan($id);

        $this->paggingAdmin('admin/penghasilan/detail_penghasilan', $data);
    }

    public function print_penghasilan_penjual()
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
                // ->join('prodi', 'penjual.id_prodi = prodi.id_prodi')
                // ->join('fakultas', 'prodi.id_fakultas = fakultas.id_fakultas')
                ->where('DATE(waktu_transaksi) >=', $tgl_awal)
                ->where('DATE(waktu_transaksi) <=', $tgl_akhir)
                ->where(['transaksi.status_pesanan' => "Selesai"])
                ->group_by('akun_penjual.id_penjual')
                ->order_by('penjual.nama_penjual', 'ASC')
                ->get()->result_array();
            //print_r($query);
            $data['transaksi'] = $query;
            for ($i = 0; $i < count($data['transaksi']); $i++) {
                $id = $data['transaksi'][$i]['id_penjual'];
                $data['transaksi'][$i]['total_penghasilan'] = $this->laporan_model->hitung_penghasilan($id);
            }

            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
        }

        $this->load->view('admin/penghasilan/print_penghasilan', $data);
    }


    //=======================================
    //               penjual
    //=======================================
    public function info_penjualan()
    {

        $data['title'] = 'Warma CIC | penjualan';
        $penjualan = $this->laporan_model->get_penjualan();
        $produk_terjual = 0;
        for ($i = 0; $i < count($penjualan); $i++) {
            $id_produk = $penjualan[$i]['id_produk'];
            $penjualan[$i]['terjual'] = $this->db->query("SELECT SUM(kuantitas) AS terjual FROM detail_keranjang JOIN keranjang USING (id_keranjang) JOIN transaksi USING (id_keranjang) WHERE id_produk = '$id_produk' AND status_pesanan = 'Selesai'")->row()->terjual;
            $produk_terjual += $penjualan[$i]['terjual'];
        }

        $data['penjualan'] = $penjualan;
        $data['produk_terjual'] = $produk_terjual;

        $id = $this->session->userdata('id');
        $data['penghasilan'] = $this->laporan_model->hitung_penghasilan($id);

        $this->paggingpenjual('penjual/penjualan/info_penjualan', $data);
    }

    public function detail_penjualan($id)
    {
        $data['title'] = 'Warma CIC | penjualan';
        $data['produk'] = $this->produk_model->getProduk_id($id);
        $data['penjualan'] = $this->laporan_model->get_detailpenjualan($id);
        $this->paggingpenjual('penjual/penjualan/detail_penjualan', $data);
    }
}
