<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alamat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Alamat_model');
    }
    
    public function cekAlamatUtama() {
        // Memeriksa keberadaan alamat utama di database
        $alamat_utama = $this->db->get_where('alamat', ['id_pengguna' => $this->session->userdata('id'), 'set_alamat_utama' => 1])->row();
    
        // Kirimkan respons ke client-side
        if ($alamat_utama) {
            echo json_encode(['alamat_utama' => true]);
        } else {
            echo json_encode(['alamat_utama' => false]);
        }
    }
    

    
    // Metode untuk menangani proses penambahan alamat dari form
    public function tambahAlamat() {
        $set_alamat_utama = $this->input->post('set_alamat_utama') ? 1 : 0;

        $alamat_utama = $this->db->get_where('alamat', ['id_pengguna' => $this->session->userdata('id'), 'set_alamat_utama' => 1])->row();

    // Jika sudah ada alamat utama, hapus status alamat utama tersebut
    if ($alamat_utama) {

        $this->hapusStatusAlamatUtama();
    }
        
        $tipe_akun = $this->session->userdata('tipe');
        // Ambil nilai latitude dan longitude dari form
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');

        $data = array(
            'nama' => $this->input->post('nama'),
            'id_pengguna' =>$this->session->userdata('id'),
            'telepon' => $this->input->post('telepon'),
            'id_provinsi' => $this->input->post('provinsi'),
            'nama_provinsi' => $this->input->post('nama_provinsi'),
            'id_kota' => $this->input->post('kota'),
            'nama_kota' => $this->input->post('nama_kota'),
            // 'kecamatan' => $this->input->post('kecamatan'),
            'kode_pos' => $this->input->post('kode_pos'),
            'latitude' => $latitude, // Simpan nilai latitude
            'longitude' => $longitude,
            'set_alamat_utama' => $set_alamat_utama,
            'tipe' => $tipe_akun
        );
        // Memanggil model untuk menyimpan alamat baru

        $this->Alamat_model->tambahAlamat($data);
        
         // Tambahkan kondisional untuk mengalihkan halaman berdasarkan tipe akun
    if ($tipe_akun == 1) {
        // Redirect ke halaman beranda jika tipe akun adalah 1
        redirect('beranda');
    } elseif ($tipe_akun == 2) {
        // Redirect ke halaman checkout jika tipe akun adalah 2
        redirect('checkout');
    }}
    
    private function hapusStatusAlamatUtama() {
            $this->db->where('id_pengguna', $this->session->userdata('id'));
            $this->db->update('alamat', array('set_alamat_utama' => 0));
        }
    
    

}
?>
