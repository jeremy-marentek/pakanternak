<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    // =========================================
    //                 ADMIN
    // =========================================

    //Get data admin by session id
    public function getAdmin_id($id)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where(['id_admin' => $id]);
        return $this->db->get()->row_array();
    }

    //edit profile admin
    public function editProfile_admin()
    {
        $id_admin = $this->input->post('id');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $email = $this->input->post('email');

        //cek jika ada gambar
        $upload_image = $_FILES['foto'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2048';
            $config['file_name']     = $this->input->post('nama');
            $config['upload_path']   = './upload/foto_user/';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                // upload foto dan edit di database
                $new_image = $this->upload->data('file_name');
                $this->db->set('foto_admin', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        //update nama, usernaeme dan email 
        $this->db->set('nama_admin', $nama);
        $this->db->set('username_admin', $username);
        $this->db->set('email_admin', $email);
        $this->db->where('id_admin', $id_admin);
        $this->db->update('admin');
    }


    //==========================================
    //                  penjual                   
    //==========================================

    //get data akun penjual by id
    public function getpenjual_id($id)
    {
        $this->db->select('*');
        $this->db->from('akun_penjual');
        $this->db->where(['id_penjual' => $id]);
        return $this->db->get()->row_array();
    }
    

    //edit profile penjual

    // public function simpan_alamat($data_alamat) {
    //     $this->db->insert('alamat', $data_alamat);
    //     return $this->db->insert_id();
    // }
    public function editProfile_penjual()
    {
        $id_penjual = $this->input->post('id');
        $email = $this->input->post('email');
        $telepon = $this->input->post('telepon');
        $alamat = $this->input->post('alamat');


        //cek jika ada gambar
        $upload_image = $_FILES['foto'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2048';
            $config['file_name']     = $this->input->post('nama');
            $config['upload_path']   = './upload/foto_user/';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                // upload foto dan edit di database
                $new_image = $this->upload->data('file_name');
                $this->db->set('foto_penjual', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        //update email, telepon dan alamat
        $this->db->set('email_penjual', $email);
        $this->db->set('telepon_penjual', $telepon);
        $this->db->set('alamat_penjual', $alamat);
        $this->db->where('id_penjual', $id_penjual);
        $this->db->update('akun_penjual');
    }
    
    

    //get seluruh data akun penjual
    public function getAkun_penjual()
    {
        $this->db->select('*');
        $this->db->from('akun_penjual');
        // $this->db->join('akun_penjual.username');
        return $this->db->get()->result_array();
    }

    //nonaktifkan status akun penjual
    public function nonaktifkan_statusAkun_penjual($id)
    {
        $data = [
            "status_aktif" => 0
        ];
        $this->db->where(['id_penjual' => $id]);
        $this->db->update('akun_penjual', $data);
    }

    //aktifkan status akun penjual
    public function aktifkan_statusAkun_penjual($id)
    {
        $data = [
            "status_aktif" => 1
        ];
        $this->db->where(['id_penjual' => $id]);
        $this->db->update('akun_penjual', $data);
    }


    //==========================================
    //                  UMUM                   
    //==========================================

    //get data umum by id
    public function getUmum_id($id)
    {
        $this->db->select('*');
        $this->db->from('akun_umum');
        $this->db->where(['id_umum' => $id]);
        return $this->db->get()->row_array();
    }

    //edit profile umum
    public function editProfile_umum()
    {
        $id_umum = $this->input->post('id');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $telepon = $this->input->post('telepon');
        $jenis_kelamin = $this->input->post('jenis_kelamin');


        //cek jika ada gambar
        $upload_image = $_FILES['foto'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2048';
            $config['file_name']     = $this->input->post('username');
            $config['upload_path']   = './upload/foto_user/';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                // upload foto dan edit di database
                $new_image = $this->upload->data('file_name');
                $this->db->set('foto', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        //update userneme, email dan telepon 
        $this->db->set('username', $username);
        $this->db->set('email', $email);
        $this->db->set('telepon', $telepon);
        $this->db->set('jenis_kelamin', $jenis_kelamin); 
        $this->db->where('id_umum', $id_umum);
        $this->db->update('akun_umum');
    }

    //get seluruh data akun umum
    public function getAkun_Umum()
    {
        $this->db->select('*');
        $this->db->from('akun_umum');
        return $this->db->get()->result_array();
    }

    //nonaktifkan status akun umum
    public function nonaktifkan_statusAkun_Umum($id)
    {
        $data = [
            "status_aktif" => 0
        ];
        $this->db->where(['id_umum' => $id]);
        $this->db->update('akun_umum', $data);
    }

    //aktifkan status akun umum
    public function aktifkan_statusAkun_Umum($id)
    {
        $data = [
            "status_aktif" => 1
        ];
        $this->db->where(['id_umum' => $id]);
        $this->db->update('akun_umum', $data);
    }


    //==========================================
    //                FRONTEND 
    //==========================================

    public function getdata_penjual($sortby)
    {
        $this->db->select('*');
        $this->db->from('akun_penjual');
        if ($sortby == "ascending") {
            $this->db->order_by('nama_penjual', 'ASC');
        } else if ($sortby == "descending") {
            $this->db->order_by('nama_penjual', 'DESC');
        }
        $this->db->where(['status_aktif' => 1]);
        return $this->db->get()->result_array();
    }
    

    //Get data penjual (penjual) berdasarkan prodi
    // public function getdata_penjualByProdi($id_prodi)
    // {
    //     $this->db->select('*');
    //     $this->db->from('akun_penjual');
    //     $this->db->join('akun_penjual.username');
    //     $this->db->join('prodi', 'penjual.id_prodi = prodi.id_prodi');
    //     $this->db->where(['status_aktif' => 1])
    //         ->where('penjual.id_prodi', $id_prodi);
    //     return $this->db->get()->result_array();
    // }

    //get detail akun penjual(penjual) berdasarkan id
    public function getdetail_penjual($id)
    {
        $this->db->select('*');
        $this->db->from('akun_penjual');
        // $this->db->join('penjual', 'akun_penjual.username = penjual.username');
        // $this->db->join('fakultas', 'penjual.id_fakultas = fakultas.id_fakultas');
        // $this->db->join('prodi', 'penjual.id_prodi = prodi.id_prodi');
        $this->db->where(['status_aktif' => 1])
            ->where(['id_penjual' => $id]);
        return $this->db->get()->row_array();
    }
}
