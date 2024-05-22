<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('website_model');
    }

    //====================================
    //              SLIDER
    //====================================

    public function data_slider()
    {
        $data['title'] = 'Pakan Ternak | Data Slider';
        $data['slider'] = $this->website_model->getData_slider();
        $this->paggingAdmin('admin/website/data_slider', $data);
    }

    public function tambah_slider()
    {
        $data['title'] = 'Pakan Ternak | Tambah Slider';

        //form validasi set rules
        $this->form_validation->set_rules('headline1', 'headline1', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('headline2', 'headline2', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('headline3', 'headline3', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingAdmin('admin/website/tambah_slider', $data);
        } else {
            $this->website_model->tambah_slider();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di tambah"></div>');
            redirect('website/data_slider');
        }
    }

    public function edit_slider($id)
    {
        $data['title'] = 'Warma CIC | Edit Slider';
        $data['slider'] = $this->website_model->dataSlider_id($id);

        //form validasi set rules
        $this->form_validation->set_rules('headline1', 'headline1', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('headline2', 'headline2', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('headline3', 'headline3', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingAdmin('admin/website/edit_slider', $data);
        } else {
            $this->website_model->edit_slider();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di ubah"></div>');
            redirect('website/data_slider');
        }
    }

    public function hapus_slider($id)
    {
        $this->website_model->hapus_slider($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di hapus"></div>');
        redirect('website/data_slider');
    }

    public function update_status_slider($id)
    {
        $this->website_model->update_status_slider($id);
        $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Slider utama telah dirubah"></div>');
        redirect('website/data_slider');
    }


    //====================================
    //             PROFILE WEBSITE 
    //====================================

    public function edit_profile_website()
    {
        $data['title'] = 'Warma CIC | Edit Profile Website';
        $data['website'] = $this->website_model->getProfile_website();

        //form validasi set rules
        $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', [
            'required' => 'Form ini tidak boleh kosong',
            'valid_email' => 'Email tidak valid'
        ]);
        $this->form_validation->set_rules('telepon', 'telepon', 'required|trim|numeric', [
            'required' => 'Form ini tidak boleh kosong',
            'numeric' => 'Harus di isi dengan angka'
        ]);
        $this->form_validation->set_rules('instagram', 'instagram', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingAdmin('admin/website/edit_profile_website', $data);
        } else {
            $this->website_model->editProfile_website();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di ubah"></div>');
            redirect('website/edit_profile_website');
        }
    }


    //======================================
    //              TENTANG WARMA
    //======================================

    public function edit_tentang_warma()
    {
        $data['title'] = 'Warma CIC | Tentang Warma';
        $data['tentang_warma'] = $this->website_model->tentang_warma();

        //form validasi set rules
        $this->form_validation->set_rules('tentang', 'tentang', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('tujuan', 'tujuan', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingAdmin('admin/website/tentang_warma', $data);
        } else {
            $this->website_model->edit_tentang_warma();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di ubah"></div>');
            redirect('website/edit_tentang_warma');
        }
    }


    //======================================
    //              BANTUAN
    //======================================

    //view halaman bantuan di frontend
    public function bantuan()
    {
        $data['title'] = 'Warma CIC | Bantuan';
        $data['bantuan'] = $this->website_model->bantuan();
        $this->paggingFrontend('frontend/bantuan', $data);
    }

    //edit halaman bantuan
    public function edit_bantuan()
    {
        $data['title'] = 'Warma CIC | Bantuan';
        $data['bantuan'] = $this->website_model->bantuan();

        //form validasi set rules
        $this->form_validation->set_rules('bantuan1', 'bantuan1', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('bantuan2', 'bantuan2', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('bantuan3', 'bantuan3', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingAdmin('admin/website/edit_bantuan', $data);
        } else {
            $this->website_model->edit_bantuan();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data berhasil di ubah"></div>');
            redirect('website/edit_bantuan');
        }
    }
}
