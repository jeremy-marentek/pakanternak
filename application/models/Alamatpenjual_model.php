<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Checkout_model extends CI_Model
{
    //get data detail keranjang
    public function getdetail_keranjang()
    {
        $this->db->select('*');
        $this->db->from('keranjang');
        $this->db->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->where('keranjang.id_pembeli', $this->session->userdata('id'));
        $this->db->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'));
        $this->db->where('keranjang.status_keranjang', 0);
        return $this->db->get()->result_array();
    }

    //=======================================
    // Alamat
    // =======================================
    
    public function tambahAlamat($data) {
        $this->db->insert('alamat', $data);
        return $this->db->insert_id(); // Mengembalikan ID alamat yang baru saja dimasukkan
    }
    //=======================================
    //                MIDTRANS
   //=======================================

    //  


    //=======================================
    //                 ADMIN
    //=======================================

    //get All data transaksi
    public function getAll_transaksi($sortby)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('keranjang', 'transaksi.id_keranjang = keranjang.id_keranjang');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->join('akun_penjual.username');
        if ($sortby == "settlement") {
            $this->db->where(['status_bayar' => 'settlement']);
        } else if ($sortby == "pending") {
            $this->db->where(['status_bayar' => 'pending']);
        } else if ($sortby == "failure") {
            $this->db->where(['status_bayar' => 'expire']);
        }
        $this->db->order_by('waktu_transaksi', 'DESC');
        $this->db->group_by('transaksi.order_id');
        return $this->db->get()->result_array();
    }

    //get detail transaksi admin
    public function detail_transaksiAdmin($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('order_id', $id);
        return $this->db->get()->row_array();
    }

    //get detail item
    public function detail_itemAdmin($id)
    {
        $this->db->select('*');
        $this->db->from('detail_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->join('akun_penjual.username');
        $this->db->join('transaksi', 'detail_keranjang.id_keranjang = transaksi.id_keranjang');
        $this->db->where('transaksi.order_id', $id);
        return $this->db->get()->result_array();
    }

    //count volume transaksi
    public function volume_transaksi()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('keranjang', 'transaksi.id_keranjang = keranjang.id_keranjang');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->join('akun_penjual.username');
        $this->db->where(['transaksi.status_bayar' => 'settlement']);
        $this->db->order_by('waktu_transaksi', 'DESC');
        $this->db->group_by('transaksi.order_id');
        return $this->db->get()->result_array();
    }


    //========================================
    //                penjual
    //========================================

    public function getTransaksi_penjual($sortby)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        if ($sortby == "belum_bayar") {
            $this->db->where(['status_pesanan' => 'Belum Bayar']);
        } else if ($sortby == "diproses") {
            $this->db->where(['status_pesanan' => 'Diproses']);
        } else if ($sortby == "dikirim") {
            $this->db->where(['status_pesanan' => 'Dikirim']);
        } else if ($sortby == "selesai") {
            $this->db->where(['status_pesanan' => 'Selesai']);
        }
        $this->db->where('produk.id_penjual', $this->session->userdata('id'));
        $this->db->order_by('transaksi.waktu_transaksi', 'DESC');
        $this->db->group_by('transaksi.order_id');
        return $this->db->get()->result_array();
    }

    //get detail transaksi
    public function getDetail_transaksipenjual($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('order_id', $id);
        return $this->db->get()->row_array();
    }

    //get detail item
    public function detailitem_penjual($id)
    {
        $this->db->select('*');
        $this->db->from('detail_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('transaksi', 'detail_keranjang.id_keranjang = transaksi.id_keranjang');
        $this->db->where('produk.id_penjual', $this->session->userdata('id'));
        $this->db->where('transaksi.order_id', $id);
        return $this->db->get()->result_array();
    }

    //input pengiriman
    public function input_pengiriman($id)
    {
        $data = [
            'status_pesanan' => 'Dikirim'
        ];
        $this->db->where('order_id', $id);
        $this->db->update('transaksi', $data);
    }

    //input pengiriman resi
    public function input_pengiriman_resi($id)
    {
        $data = [
            'kurir' => $this->input->post('jasa'),
            'no_resi' => $this->input->post('no_resi'),
            'status_pesanan' => 'Dikirim'
        ];
        $this->db->where('order_id', $id);
        $this->db->update('transaksi', $data);
    }

    //jumlah pesanan (dashboard)
    public function jumlah_pesanan()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->where('produk.id_penjual', $this->session->userdata('id'));
        $this->db->group_by('transaksi.order_id');
        return $this->db->get()->num_rows();
    }

    //belum bayar (dashboard)
    public function belum_bayar()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->where('produk.id_penjual', $this->session->userdata('id'));
        $this->db->where('transaksi.status_pesanan', 'Belum Bayar');
        $this->db->group_by('transaksi.order_id');
        return $this->db->get()->num_rows();
    }


    //diproses (dashboard)
    public function diproses()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->where('produk.id_penjual', $this->session->userdata('id'));
        $this->db->where('transaksi.status_pesanan', 'Diproses');
        $this->db->group_by('transaksi.order_id');
        return $this->db->get()->num_rows();
    }


    //========================================
    //                PEMBELI
    //========================================

    //get data transaksi berdasarkan id penjual
    public function getTransaksi_pembeli($sortby)
{
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->join('detail_keranjang', 'transaksi.id_keranjang = detail_keranjang.id_keranjang');
    $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
    $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
    // Tidak perlu melakukan join untuk menambahkan kolom tambahan
    // Tambahkan kolom 'username' ke dalam pernyataan select
    $this->db->select('akun_penjual.username');
    if ($sortby == "belum_bayar") {
        $this->db->where(['status_pesanan' => 'Belum Bayar']);
    } else if ($sortby == "diproses") {
        $this->db->where(['status_pesanan' => 'Diproses']);
    } else if ($sortby == "dikirim") {
        $this->db->where(['status_pesanan' => 'Dikirim']);
    } else if ($sortby == "selesai") {
        $this->db->where(['status_pesanan' => 'Selesai']);
    }
    $this->db->order_by('waktu_transaksi', 'DESC');
    $this->db->group_by('transaksi.order_id');
    $this->db->where('id_pembeli', $this->session->userdata('id'));
    return $this->db->get()->result_array();
}


    //Detail transaksi bagian pembeli
    public function getDetail_transaksi($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('order_id', $id);
        return $this->db->get()->row_array();
    }

    //get detail item
    public function detailitem_Pembeli($id)
    {
        $this->db->select('*');
        $this->db->from('detail_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->join('akun_penjual.username');
        $this->db->join('transaksi', 'detail_keranjang.id_keranjang = transaksi.id_keranjang');
        $this->db->where('transaksi.id_pembeli', $this->session->userdata('id'));
        $this->db->where('transaksi.order_id', $id);
        return $this->db->get()->result_array();
    }

    //konfirmasi barang
    public function konfirmasi_barang($id)
    {
        $data = [
            'status_pesanan' => 'Selesai'
        ];
        $this->db->where('order_id', $id);
        $this->db->update('transaksi', $data);
    }

    //cancel pesanan
    public function cancel_pesanan($id)
    {
        $data = [
            'status_pesanan' => 'Batal',
            'status_bayar'   => 'cancel'
        ];
        $this->db->where('order_id', $id);
        $this->db->update('transaksi', $data);
    }
}
