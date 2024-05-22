<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    //get seluruh data kategori
    public function getKategori()
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->order_by('nama_kategori', 'ASC');
        return $this->db->get()->result_array();
    }

    //tambah kategori
    public function tambahKategori()
    {
        $data = [
            "nama_kategori" => $this->input->post('kategori', true)
        ];
        $this->db->insert('kategori', $data);
    }

    //get kategori berdasarkan id
    public function getKategori_id($id)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->where(['id_kategori' => $id]);
        return $this->db->get()->row_array();
    }

    //edit kategori
    public function editKategori()
    {
        $data = [
            "nama_kategori" => $this->input->post('kategori', true)
        ];
        $this->db->where('id_kategori', $this->input->post('id'));
        $this->db->update('kategori', $data);
    }

    //hapus kategori
    public function hapusKategori($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');
    }
}
