<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{
    //get data keranjang
    // public function data_keranjang()
    // {
    //     $this->db->select('*');
    //     $this->db->from('detail_keranjang');
    //     $this->db->join('keranjang', 'detail_keranjang.id_keranjang = keranjang.id_keranjang');
    //     $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
    //     $this->db->where('id_pembeli', $this->session->userdata('id'));
    //     $this->db->where('tipe_pembeli', $this->session->userdata('tipe'));
    //     return $this->db->get()->result_array();
    // }

    //get data keranjang
    public function data_keranjang()
    {
        $this->db->select('*');
        $this->db->from('keranjang');
        $this->db->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->where('keranjang.id_pembeli', $this->session->userdata('id'));
        $this->db->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'));
        $this->db->where('keranjang.status_keranjang', 0);
        return $this->db->get()->result_array();
    }

//tambahkan ke keranjang
public function tambah_keranjang($id_produk)
{
    $id_pembeli = $this->session->userdata('id');
    $tipe_pembeli = $this->session->userdata('tipe');

    //STATUS INSERT
    // 1 => SUCCESS
    // 2 => FAILED
    // 3 => REJECTED
    $status_insert = 0;

    //TIDAK DAPAT MEMBELI PRODUK SENDIRI
    if ($tipe_pembeli == 1) {
        $cek_produk = $this->db->select("*")
            ->from('produk')
            ->where('id_penjual', $id_pembeli)
            ->where('id_produk', $id_produk)
            ->get()->num_rows();

        if ($cek_produk > 0) {
            $status_insert = 3;
            return $status_insert;
        }
    }

    //QUERY STATUS KERANJANG
    $sql_keranjang = $this->db->select('*')
        ->from('keranjang')
        ->where('status_keranjang', 0)
        ->where('id_pembeli', $id_pembeli)
        ->get();

    //Jika ada keranjang yang belum dibayar
    if ($sql_keranjang->num_rows() > 0) {
        $keranjang = $sql_keranjang->row_array();
        $id_keranjang = $keranjang['id_keranjang'];

        //Mengambil id_penjual dari produk
        $id_penjual_produk = $this->db->select('id_penjual')
            ->from('produk')
            ->where('id_produk', $id_produk)
            ->get()->row_array()['id_penjual'];

        //Cek barang yang sudah ada di detail keranjang
        $sql_detail_keranjang = $this->db->select("*")
            ->from('detail_keranjang')
            ->where('id_keranjang', $id_keranjang)
            ->where('id_produk', $id_produk)->get();

        if ($sql_detail_keranjang->num_rows() > 0) {
            $detail_keranjang = $sql_detail_keranjang->row_array();
            $id_detail = $detail_keranjang['id_detail'];
            $kuantitas = ($detail_keranjang['kuantitas'] + 1);

            $this->db->where('id_detail', $id_detail)
                ->update('detail_keranjang', [
                    'kuantitas' => $kuantitas
                ]);
            $status_insert = 1;

            $this->update_kuantitas($id_detail, [
                'id_produk' => $id_produk,
                'id_detail' => $id_detail,
                'kuantitas' => $kuantitas
            ]);

            return $status_insert;
        }
    } else {

        //Insert ke tabel keranjang
        $data_keranjang = [
            'id_pembeli' => $id_pembeli,
            'tipe_pembeli' => $tipe_pembeli
        ];
        $this->db->insert("keranjang", $data_keranjang);
        $id_keranjang = $this->db->insert_id();

        //Mengambil id_penjual dari produk
        $id_penjual_produk = $this->db->select('id_penjual')
            ->from('produk')
            ->where('id_produk', $id_produk)
            ->get()->row_array()['id_penjual'];
    }

    //Insert ke tabel detail_keranjang
    $detail_keranjang = [
        'id_keranjang' => $id_keranjang,
        'id_produk' => $id_produk,
        'id_penjual' => $id_penjual_produk, // Menambahkan id_penjual
        'kuantitas' => 1,
        // 'subtotal' => 0
    ];

    $insert_detail = $this->db->insert('detail_keranjang', $detail_keranjang);
    if ($insert_detail) {
        $status_insert = 1;
    } else {
        $status_insert = 2;
    }
    return $status_insert;
}

    //hapus produk di keranjang
    public function hapus_produk($id_detail)
    {
        $this->db->select('*');
        $this->db->from('detail_keranjang');
        $this->db->where('id_detail', $id_detail);
        $this->db->delete('detail_keranjang');
    }

    //update kuantitas
    public function update_kuantitas($id_detail, $data)
    {
        $produk = $this->db->select('*')
            ->from('produk')
            ->where('id_produk', $data['id_produk'])
            ->get()->row_array();

        $kuantitas = $data['kuantitas'];
        $subtotal = $kuantitas * $produk['harga_produk'];

        $this->db->where('id_detail', $id_detail)
            ->update('detail_keranjang', [
                'kuantitas' => $kuantitas,
                // 'subtotal' => $subtotal,
            ]);
    }

    //jumlah produk di detail keranjang
    public function jumlah_produk()
    {
        $this->db->select('*');
        $this->db->from('keranjang');
        $this->db->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang');
        $this->db->join('produk', 'detail_keranjang.id_produk = produk.id_produk');
        $this->db->where('keranjang.id_pembeli', $this->session->userdata('id'));
        $this->db->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'));
        $this->db->where('keranjang.status_keranjang', 0);
        return $this->db->get()->num_rows();
    }
}