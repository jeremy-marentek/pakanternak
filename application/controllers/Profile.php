<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    //=========================================
    //                 ADMIN
    //=========================================

    public function index()
    {
        //jika session tidak ada
        if (!$this->session->userdata('id')) {
            redirect('auth');
        }

        $data['title'] = 'Warma CIC | Profile';
        $id = $this->session->userdata('id');
        $data['admin'] = $this->user_model->getAdmin_id($id);
        $this->paggingAdmin('admin/profile/profile_admin', $data);
    }

    //edit profile admin
    public function edit_profile_admin()
    {
        //jika session tidak ada
        if (!$this->session->userdata('id')) {
            redirect('auth');
        }

        $data['title'] = 'Warma CIC | Edit Profile';
        $id = $this->session->userdata('id');
        $data['admin'] = $this->user_model->getAdmin_id($id);

        //form validasi set rules
        $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', [
            'required' => 'Form ini tidak boleh kosong',
            'valid_email' => 'Penulisan email tidak valid'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingAdmin('admin/profile/edit_profile', $data);
        } else {
            $this->user_model->editProfile_admin();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data Berhasil di Ubah"></div>');
            redirect('profile/index');
        }
    }

    //ubah password admin
    public function ubah_password_admin()
    {
        //jika session tidak ada
        if (!$this->session->userdata('id')) {
            redirect('auth');
        }

        $data['title'] = 'Warma CIC | Ubah Password';
        $id = $this->session->userdata('id');
        $data['admin'] = $this->user_model->getAdmin_id($id);

        //form validasi set rules
        $this->form_validation->set_rules('pw_lama', 'pw_lama', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('pw_baru', 'pw_baru', 'required|min_length[3]', [
            'required' => 'Form ini tidak boleh kosong',
            'min_length' => 'Minimal di isi dengan 3 Karakter',
        ]);
        $this->form_validation->set_rules('pw_baru2', 'pw_baru2', 'required|min_length[3]|matches[pw_baru]', [
            'required' => 'Form ini tidak boleh kosong',
            'min_length' => 'Minimal di isi dengan 3 Karakter',
            'matches' => 'Password tidak sama'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingAdmin('admin/profile/ubah_password', $data);
        } else {
            $password_lama = $this->input->post('pw_lama');
            $password_baru = $this->input->post('pw_baru');
            if (!password_verify($password_lama, $data['admin']['password_admin'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah</div>');
                redirect('profile/ubah_password_admin');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                    redirect('profile/ubah_password_admin');
                } else {
                    //password OK
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                    $this->db->set('password_admin', $password_hash);
                    $this->db->where('id_admin', $this->session->userdata('id'));
                    $this->db->update('admin');
                    $this->session->set_flashdata('message', '<div class="flash-data" data-ubahpassword="Password Berhasil Diubah"></div>');
                    redirect('profile');
                }
            }
        }
    }


    //=========================================
    //                 penjual
    //=========================================

    public function profile_penjual()
    {
        if (!$this->session->userdata('id')) {
            redirect('auth/login_penjual');
        }

        $data['title'] = 'Warma CIC | Profile';
        $id = $this->session->userdata('id');
        $data['penjual'] = $this->user_model->getpenjual_id($id);
        $this->paggingPembeli('pembeli/profile/profile_penjual', $data);
    }

    //edit profile penjual

    public function edit_profile_penjual()
    {
        $data['title'] = 'Warma CIC | Edit Profile';
        $id = $this->session->userdata('id');
        $data['penjual'] = $this->user_model->getpenjual_id($id);

        //form validasi set rules
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', [
            'required' => 'Form ini tidak boleh kosong',
            'valid_email' => 'Email tidak valid'
        ]);
        $this->form_validation->set_rules('telepon', 'telepon', 'required|trim|numeric', [
            'required' => 'Form ini tidak boleh kosong',
            'numeric' => 'Harus di isi dengan angka'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingPembeli('pembeli/profile/edit_profile_penjual', $data);
        } else {
            $this->user_model->editProfile_penjual();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data Berhasil di Ubah"></div>');
            redirect('profile/profile_penjual');
        }
    }

    // Di bagian controller atau tempat Anda menyimpan data dari form

    //ubah password penjual
    public function ubah_password_penjual()
    {
        $data['title'] = 'Warma CIC | Ubah Password';
        $id = $this->session->userdata('id');
        $data['penjual'] = $this->user_model->getpenjual_id($id);

        //form validasi set rules
        $this->form_validation->set_rules('pw_lama', 'pw_lama', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('pw_baru', 'pw_baru', 'required|min_length[3]', [
            'required' => 'Form ini tidak boleh kosong',
            'min_length' => 'Minimal di isi dengan 3 Karakter',
        ]);
        $this->form_validation->set_rules('pw_baru2', 'pw_baru2', 'required|min_length[3]|matches[pw_baru]', [
            'required' => 'Form ini tidak boleh kosong',
            'min_length' => 'Minimal di isi dengan 3 Karakter',
            'matches' => 'Password tidak sama'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingPembeli('pembeli/profile/ubah_password_penjual', $data);
        } else {
            $password_lama = $this->input->post('pw_lama');
            $password_baru = $this->input->post('pw_baru');
            if (!password_verify($password_lama, $data['penjual']['password_penjual'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah</div>');
                redirect('profile/ubah_password_penjual');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                    redirect('profile/ubah_password_penjual');
                } else {
                    //password OK
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                    $this->db->set('password_penjual', $password_hash);
                    $this->db->where('id_penjual', $this->session->userdata('id'));
                    $this->db->update('akun_penjual');
                    $this->session->set_flashdata('message', '<div class="flash-data" data-ubahpassword="Password Berhasil Diubah"></div>');
                    redirect('profile/ubah_password_penjual');
                }
            }
        }
    }

    //=========================================
    //                 UMUM
    //=========================================

    public function profile_umum()
    {
        if (!$this->session->userdata('id')) {
            redirect('auth/login_umum');
        }

        $data['title'] = 'Warma CIC | Profile';
        $id = $this->session->userdata('id');
        $data['umum'] = $this->user_model->getUmum_id($id);
        $this->paggingPembeli('pembeli/profile/profile_umum', $data);
    }

    //edit profile umum
    public function edit_profile_umum()
    {
        $data['title'] = 'Warma CIC | Edit Profile';
        $id = $this->session->userdata('id');
        $data['umum'] = $this->user_model->getUmum_id($id);

        //form validasi set rules
        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', [
            'required' => 'Form ini tidak boleh kosong',
            'valid_email' => 'Penulisan email tidak valid'
        ]);
        $this->form_validation->set_rules('telepon', 'telepon', 'required|trim|numeric', [
            'required' => 'Form ini tidak boleh kosong',
            'numeric' => 'Harus di isi dengan angka'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingPembeli('pembeli/profile/edit_profile_umum', $data);
        } else {
            $this->user_model->editProfile_umum();
            $this->session->set_flashdata('message', '<div class="flash-data" data-flashdata="Data Berhasil di Ubah"></div>');
            redirect('profile/profile_umum');
        }
    }

    //ubah password umum
    public function ubah_password_umum()
    {
        $data['title'] = 'Warma CIC | Ubah Password';
        $id = $this->session->userdata('id');
        $data['umum'] = $this->user_model->getUmum_id($id);

        //form validasi set rules
        $this->form_validation->set_rules('pw_lama', 'pw_lama', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('pw_baru', 'pw_baru', 'required|min_length[3]', [
            'required' => 'Form ini tidak boleh kosong',
            'min_length' => 'Minimal di isi dengan 3 Karakter',
        ]);
        $this->form_validation->set_rules('pw_baru2', 'pw_baru2', 'required|min_length[3]|matches[pw_baru]', [
            'required' => 'Form ini tidak boleh kosong',
            'min_length' => 'Minimal di isi dengan 3 Karakter',
            'matches' => 'Password tidak sama'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == FALSE) {
            $this->paggingPembeli('pembeli/profile/ubah_password_umum', $data);
        } else {
            $password_lama = $this->input->post('pw_lama');
            $password_baru = $this->input->post('pw_baru');
            if (!password_verify($password_lama, $data['umum']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah</div>');
                redirect('profile/ubah_password_umum');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                    redirect('profile/ubah_password_umum');
                } else {
                    //password OK
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('id_umum', $this->session->userdata('id'));
                    $this->db->update('akun_umum');
                    $this->session->set_flashdata('message', '<div class="flash-data" data-ubahpassword="Password Berhasil Diubah"></div>');
                    redirect('profile/ubah_password_umum');
                }
            }
        }
    }
}
