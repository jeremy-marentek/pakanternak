<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('checkout_model');
    }

    //Data transaksi pada halaman admin
    public function data_transaksi($sortby = '')
    {
        $data['title'] = 'Warma CIC | Data Transaksi';
        $data['transaksi'] = $this->checkout_model->getAll_transaksi($sortby);
        $this->paggingAdmin('admin/transaksi/data_transaksi', $data);
    }

    //Detail Transaksi
    public function detail_transaksi($id)
    {
        $data['title'] = 'Warma CIC | Detail Transaksi';
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
        $this->paggingAdmin('admin/transaksi/detail_transaksi', $data);
    }
}
