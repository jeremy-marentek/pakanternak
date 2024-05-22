<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{

    //======================================
    //             penjual
    //======================================

    //Get data produk berdasarkan id penjual
    public function getdata_Produk()
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->where(['id_penjual' => $this->session->userdata('id')]);
        return $this->db->get()->result_array();
    }

    //get data produk berdasarkan id_produk
    public function getProduk_id($id)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        // $this->db->join('akun_penjual.username');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->where(['id_produk' => $id]);
        return $this->db->get()->row_array();
    }

    //get data produk berdasarkan id penjual
    public function getProduk_idpenjual($id)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->where(['id_penjual' => $id]);
        return $this->db->get()->result_array();
    }

    //tambah produk
    public function tambahProduk()
    {
        //upload gambar
        $upload_image = $_FILES['foto'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '6144';
            $config['file_name']     = $this->input->post('nama');
            $config['upload_path']   = './upload/foto_produk/';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');

                date_default_timezone_set('Asia/Jakarta');
                $data = [
                    "nama_produk" => $this->input->post('nama', true),
                    "id_kategori" => $this->input->post('kategori', true),
                    "harga_produk" => $this->input->post('harga', true),
                    "stok_produk" => $this->input->post('stok', true),
                    "berat_produk" =>  $this->input->post('berat', true),
                    "deskripsi_produk" => $this->input->post('deskripsi', true),
                    "id_penjual" => $this->session->userdata('id'),
                    "foto_produk" => $foto,
                    "status_produk" => 1,
                    "tanggal_input" => date('Y-m-d H:i:s')
                ];
                $this->db->insert('produk', $data);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect('produk/tambah_produk');
            }
        }
    }

    //edit produk 
    public function editProduk()
    {
        $id_produk   = $this->input->post('id');
        $nama_produk = $this->input->post('nama');
        $kategori    = $this->input->post('kategori');
        $harga       = $this->input->post('harga');
        $stok       = $this->input->post('stok');
        $deskripsi   = $this->input->post('deskripsi');

        //cek jika ada gambar
        $upload_image = $_FILES['foto'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2048';
            $config['file_name']     = $this->input->post('nama');
            $config['upload_path']   = './upload/foto_produk/';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                // upload foto dan edit di database
                $new_image = $this->upload->data('file_name');
                $this->db->set('foto_produk', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        //update nama produk, kategori, harga, stok dan deskripsi
        $this->db->set('nama_produk', $nama_produk);
        $this->db->set('id_kategori', $kategori);
        $this->db->set('harga_produk', $harga);
        $this->db->set('stok_produk', $stok);
        $this->db->set('deskripsi_produk', $deskripsi);
        $this->db->where('id_produk', $id_produk);
        $this->db->update('produk');
    }

    //hapus produk
    public function hapusProduk($id)
    {
        $produk = $this->db->get_where('produk', ['id_produk' => $id])->row();
        $query = $this->db->delete('produk', ['id_produk' => $id]);
        if ($query) {
            unlink('./upload/foto_produk/' . $produk->foto_produk);
        }
    }

    //nonaktifkan status produk
    public function nonaktifkan_statusProduk($id)
    {
        $data = [
            "status_produk" => 0
        ];
        $this->db->where(['id_produk' => $id]);
        $this->db->update('produk', $data);
    }

    //aktifkan status produk
    public function aktifkan_statusProduk($id)
    {
        $data = [
            "status_produk" => 1
        ];
        $this->db->where(['id_produk' => $id]);
        $this->db->update('produk', $data);
    }

    //======================================
    //             FRONTEND
    //======================================

    //Get data produk berdasarkan status aktif di bagian menu produk
    public function getdata_produkFrontend($sortby)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        if ($sortby == "terbaru") {
            $this->db->order_by('tanggal_input', 'DESC');
        } else if ($sortby == "termahal") {
            $this->db->order_by('harga_produk', 'DESC');
        } else if ($sortby == "termurah") {
            $this->db->order_by('harga_produk', 'ASC');
        }
        $this->db->where(['status_produk' => 1]);
        return $this->db->get()->result_array();
    }

    //Get data produk berdasarkan kategori
    public function getdata_produkByKategori($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->where(['status_produk' => 1])
            ->where('produk.id_kategori', $id_kategori);
        return $this->db->get()->result_array();
    }

    //Get detail produk by id produk
    public function detailproduk_Frontend($id)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual');
        $this->db->select('akun_penjual.username');
        // $this->db->join('prodi', 'penjual.id_prodi = prodi.id_prodi');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->where(['status_aktif' => 1])
            ->where(['id_produk' => $id]);
        return $this->db->get()->row_array();
    }

    //Cari Produk
    public function cariProduk($keyword)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->like('nama_produk', $keyword);
        return $this->db->get()->result_array();
    }

    //produk terlaris
    public function getdata_produkTerlaris()
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->where(['status_produk' => 1]);
        $this->db->order_by('produk.terjual', 'DESC');
        return $this->db->get()->result_array();
    }
}