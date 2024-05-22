<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('checkout_model');
    }

    //========================================
    //                penjual
    //========================================

    public function daftar_pesanan_penjual($sortby = '')
    {
        $data['title'] = 'Warma CIC | Pesanan';
        $data['transaksi'] = $this->checkout_model->getTransaksi_penjual($sortby);
        $this->paggingpenjual('penjual/pesanan/daftar_pesanan', $data);
    }

    public function detail_pesanan_penjual($id)
    {
        $data['title'] = 'Warma CIC | Detail Pesanan';
        $data['transaksi'] = $this->checkout_model->getDetail_transaksipenjual($id);
        $data['item'] = $this->checkout_model->detailitem_penjual($id);
        $this->paggingpenjual('penjual/pesanan/detail_pesanan', $data);
    }

    public function input_pengiriman($id)
    {

        $data['title'] = 'Warma CIC | Input Pengiriman';
        $data['transaksi'] = $this->db->get_where('transaksi', ['order_id' => $id])->row_array();

        //form validasi setrules
        $this->form_validation->set_rules('jasa', 'jasa', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);

        //jika validasi salah
        if ($this->form_validation->run() == false) {
            $this->paggingpenjual('penjual/pesanan/input_pengiriman', $data);
        } else {
            $this->checkout_model->input_pengiriman_resi($id);
            $this->session->set_flashdata('message', '<div class="flash-data" data-inputpengiriman="Produk sedang dikirim"></div>');
            redirect('pesanan/daftar_pesanan_penjual/dikirim');
        }
    }

    public function input_pengiriman_noresi($id)
    {
        $this->checkout_model->input_pengiriman($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-inputpengiriman="Produk sedang dikirim"></div>');
        echo '<script>window.history.back();</script>';
    }

    //========================================
    //                PEMBELI
    //========================================

    public function daftar_pesanan_pembeli($sortby = '')
    {
        $data['title'] = 'Warma CIC | Pesanan';
        $data['transaksi'] = $this->checkout_model->getTransaksi_pembeli($sortby);
        $this->paggingPembeli('pembeli/pesanan/daftar_pesanan', $data);
    }

    //get detail pesanan
    public function detail_pesanan_pembeli($id)
    {
        $data['title'] = 'Warma CIC | Detail Pesanan';
        $data['transaksi'] = $this->checkout_model->getDetail_transaksi($id);
        // $data['item'] = $this->checkout_model->detailitem_Pembeli($id);


        $list_penjual = $this->db->select('DISTINCT(akun_penjual.id_penjual), penjual.nama_penjual')
            ->from('keranjang')
            ->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang')
            ->join('transaksi', 'detail_keranjang.id_keranjang = transaksi.id_keranjang')
            ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
            ->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
            ->join('akun_penjual.username')
            ->where('keranjang.id_pembeli', $this->session->userdata('id'))
            ->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'))
            ->where('transaksi.order_id', $id)
            ->get()->result_array();

        //Untuk ambil data detail keranjang
        $detail_keranjang = $this->db->select('*')
            ->from('keranjang')
            ->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang')
            ->join('transaksi', 'detail_keranjang.id_keranjang = transaksi.id_keranjang')
            ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
            ->where('keranjang.id_pembeli', $this->session->userdata('id'))
            ->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'))
            ->where('transaksi.order_id', $id)
            ->get()->result_array();

        $list_penjual = [];

        foreach ($detail_keranjang as $detail) {
            $list_penjual[] = $detail['id_penjual'];
        }

        $data['list_penjual'] = $list_penjual;
        $data['detail_keranjang'] = $detail_keranjang;
        $this->paggingPembeli('pembeli/pesanan/detail_pesanan', $data);
    }

    public function konfirmasi_barang($id)
    {
        $order_id = $id;
        $data['transaksi'] = $this->db->get_where('transaksi', ['order_id' => $order_id])->row();

        $detail_keranjang = $this->db->get_where('detail_keranjang', ['id_keranjang' => $data['transaksi']->id_keranjang])->result_array();

        $list_product = [];

        foreach ($detail_keranjang as $detail) {
            $list_product[] = $detail['id_produk'];
        }

        $produk = $this->db->select('*')
            ->from('produk')
            ->where_in('id_produk', $list_product)
            ->get()->result_array();

        for ($i = 0; $i < count($produk); $i++) {
            $total_stok_akhir = $produk[$i]['stok_produk'] - $detail_keranjang[$i]['kuantitas'];
            $total_terjual_akhir = $produk[$i]['terjual'] + $detail_keranjang[$i]['kuantitas'];

            $this->db->where('id_produk', $produk[$i]['id_produk']);
            $this->db->update('produk', ['stok_produk' => $total_stok_akhir, 'terjual' => $total_terjual_akhir]);
        }

        $this->checkout_model->konfirmasi_barang($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-konfirmasibarang="Barang telah diterima"></div>');
        echo '<script>window.history.back();</script>';
    }

    public function cancel_pesanan($id)
    {
        $this->checkout_model->cancel_pesanan($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-cancelpesanan="Pesanan Berhasil Dibatalkan"></div>');
        echo '<script>window.history.back();</script>';
    }

    public function invoice($id)
    {
        $data['title'] = 'Warma CIC | Invoice';
        $data['transaksi'] = $this->checkout_model->getDetail_transaksi($id);


        $list_penjual = $this->db->select('DISTINCT(akun_penjual.id_penjual), penjual.nama_penjual')
            ->from('keranjang')
            ->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang')
            ->join('transaksi', 'detail_keranjang.id_keranjang = transaksi.id_keranjang')
            ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
            ->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
            ->join('akun_penjual.username')
            ->where('keranjang.id_pembeli', $this->session->userdata('id'))
            ->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'))
            ->where('transaksi.order_id', $id)
            ->get()->result_array();

        //Untuk ambil data detail keranjang
        $detail_keranjang = $this->db->select('*')
            ->from('keranjang')
            ->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang')
            ->join('transaksi', 'detail_keranjang.id_keranjang = transaksi.id_keranjang')
            ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
            ->where('keranjang.id_pembeli', $this->session->userdata('id'))
            ->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'))
            ->where('transaksi.order_id', $id)
            ->get()->result_array();

        $list_penjual = [];

        foreach ($detail_keranjang as $detail) {
            $list_penjual[] = $detail['id_penjual'];
        }

        $data['ongkir'] = $this->db->get_where('transaksi', ['order_id' => $id])->row_array();
        $data['list_penjual'] = $list_penjual;
        $data['detail_keranjang'] = $detail_keranjang;
        $this->paggingPembeli('pembeli/pesanan/invoice', $data);
    }
}
