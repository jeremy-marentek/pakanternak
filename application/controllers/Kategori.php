<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kategori_model');

        if (!$this->session->userdata('id')) {
            redirect('auth');
        }
    }

    //view data kategori
    public function index()
    {
        $data['title'] = 'Warma CIC | Kategori';
        $data['kategori'] = $this->kategori_model->getKategori();
        $this->paggingAdmin('admin/kategori/data_kategori', $data);
    }

    //tambah kategori
    public function tambah_kategori()
    {
        //form validasi setrules
        $this->form_validation->set_rules('kategori', 'kategori', 'required|trim|is_unique[kategori.nama_kategori]',);

        //jika validasi salah
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('kategori', '<div class="alert alert-danger" role="alert">Kategori' . '&nbsp;' . $this->input->post('kategori') . '&nbsp;' . 'sudah ada</div>');
            redirect('kategori');
        } else {
            $this->kategori_model->tambahKategori();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di tambahkan"></div>');
            redirect('kategori');
        }
    }

    //edit kategori
    public function edit_kategori()
    {
        //form validasi setrules
        $this->form_validation->set_rules('kategori', 'kategori', 'required|trim');

        //jika validasi salah
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('kategori', '<div class="alert alert-danger" role="alert">Form nama kategori tidak boleh kosong</div>');
            redirect('kategori');
        } else {
            $this->kategori_model->editKategori();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di ubah"></div>');
            redirect('kategori');
        }
    }

    //hapus kategori
    public function hapus_kategori($id)
    {
        $this->kategori_model->hapusKategori($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di hapus"></div>');
        redirect('kategori');
    }
}
