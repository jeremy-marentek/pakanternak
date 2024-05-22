<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    //==========================================
    //                 ADMIN
    //==========================================

    public function penghasilan_penjual()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->join('akun_penjual.username');
        $this->db->join('prodi', 'penjual.id_prodi = prodi.id_prodi');
        $this->db->where(['transaksi.status_pesanan' => "Selesai"]);
        $this->db->group_by('akun_penjual.id_penjual');
        return $this->db->get()->result_array();
    }

    public function hitung_penghasilan($id)
    {

        $penghasilan = 0;
        $transaksi = $this->db->select('*')
            ->from('transaksi')
            ->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang')
            ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
            ->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
            ->where('produk.id_penjual', $id)
            ->where(['transaksi.status_pesanan' => 'Selesai'])
            ->group_by('transaksi.order_id')
            ->get()->result_array();

        foreach ($transaksi as $t) {
            $penghasilan = $penghasilan + $t['total_bayar'];
        }
        return $penghasilan;
    }

    public function get_penjualan_id($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->where('akun_penjual.id_penjual', $id);
        $this->db->where(['transaksi.status_pesanan' => "Selesai"]);
        $this->db->group_by('produk.id_produk');
        return $this->db->get()->result_array();
    }



    //==========================================
    //              penjual
    //==========================================

    public function get_penjualan()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->where('produk.id_penjual', $this->session->userdata('id'));
        $this->db->where(['transaksi.status_pesanan' => "Selesai"]);
        $this->db->group_by('produk.id_produk');
        return $this->db->get()->result_array();
    }

    public function get_detailpenjualan($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->where('produk.id_produk', $id);
        $this->db->where('produk.id_penjual', $this->session->userdata('id'));
        $this->db->where(['transaksi.status_pesanan' => "Selesai"]);
        $this->db->order_by('transaksi.waktu_transaksi', 'DESC');
        return $this->db->get()->result_array();
    }
}
