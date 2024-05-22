<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website_model extends CI_Model
{

    //===================================
    //        PROFILE WEBSITE
    //===================================

    //get data profile website
    public function getProfile_website()
    {
        $this->db->select('*');
        $this->db->from('profile_website');
        return $this->db->get()->row_array();
    }

    //edit profile website
    public function editProfile_website()
    {

        $nama   = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $telepon = $this->input->post('telepon');
        $instagram = $this->input->post('instagram');

        //cek jika ada gambar
        $upload_image = $_FILES['foto'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2048';
            $config['file_name']     = $this->input->post('nama');
            $config['upload_path']   = './upload/logo_website/';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                // upload foto dan edit di database
                $new_image = $this->upload->data('file_name');
                $this->db->set('logo', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->set('nama_website', $nama);
        $this->db->set('alamat', $alamat);
        $this->db->set('email', $email);
        $this->db->set('telepon', $telepon);
        $this->db->set('instagram', $instagram);
        $this->db->update('profile_website');
    }


    //===================================
    //             SLIDER
    //===================================

    public function getData_slider()
    {
        $this->db->select('*');
        $this->db->from('slider');
        return $this->db->get()->result_array();
    }

    public function dataSlider_id($id)
    {
        $this->db->select('*');
        $this->db->from('slider');
        $this->db->where(['id_slider' => $id]);
        return $this->db->get()->row_array();
    }

    //tambah slider
    public function tambah_slider()
    {
        //upload gambar
        $upload_image = $_FILES['foto'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '6144';
            $config['file_name']     = $this->input->post('headline2');
            $config['upload_path']   = './upload/foto_slider/';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');

                $data = [
                    "foto_slider" => $foto,
                    "headline1" => $this->input->post('headline1', true),
                    "headline2" => $this->input->post('headline2', true),
                    "headline3" => $this->input->post('headline3', true),
                    "status" => $this->input->post('status', true)
                ];
                $this->db->insert('slider', $data);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect('website/data_slider');
            }
        }
    }

    //edit slider
    public function edit_slider()
    {
        $id_slider   = $this->input->post('id');
        $headline1 = $this->input->post('headline1');
        $headline2 = $this->input->post('headline2');
        $headline3 = $this->input->post('headline3');
        $status    = $this->input->post('status');

        //cek jika ada gambar
        $upload_image = $_FILES['foto'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '6144';
            $config['file_name']     = $this->input->post('headline2');
            $config['upload_path']   = './upload/foto_slider/';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                // upload foto dan edit di database
                $new_image = $this->upload->data('file_name');
                $this->db->set('foto_slider', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        //update 
        $this->db->set('headline1', $headline1);
        $this->db->set('headline2', $headline2);
        $this->db->set('headline3', $headline3);
        $this->db->set('status', $status);
        $this->db->where('id_slider', $id_slider);
        $this->db->update('slider');
    }

    //hapus slider
    public function hapus_slider($id)
    {
        $slider = $this->db->get_where('slider', ['id_slider' => $id])->row();
        $query = $this->db->delete('slider', ['id_slider' => $id]);
        if ($query) {
            unlink('./upload/foto_slider/' . $slider->foto_slider);
        }
    }

    //update status slider
    public function update_status_slider($id)
    {
        //Update nonaktifkan semua slider yang statusna 1
        $this->db->query("UPDATE slider SET status = 0 WHERE status = 1");

        $data = ["status" => 1];
        $this->db->where(['id_slider' => $id]);
        $this->db->update('slider', $data);
    }


    //===================================
    //             TENTANG WARMA
    //===================================

    //get data tentang warma
    public function tentang_warma()
    {
        $this->db->select('*');
        $this->db->from('tentang_warma');
        return $this->db->get()->row_array();
    }

    //edit tentang warma
    public function edit_tentang_warma()
    {
        $data = [
            'tentang' => $this->input->post('tentang'),
            'tujuan' => $this->input->post('tujuan'),
        ];
        $this->db->update('tentang_warma', $data);
    }

    //===================================
    //              BANTUAN
    //===================================

    //get data bantuan dari database
    public function bantuan()
    {
        $this->db->select('*');
        $this->db->from('bantuan');
        return $this->db->get()->row_array();
    }

    //edit bantuan
    public function edit_bantuan()
    {
        $data = [
            'bantuan1' => $this->input->post('bantuan1'),
            'bantuan2' => $this->input->post('bantuan2'),
            'bantuan3' => $this->input->post('bantuan3'),
        ];
        $this->db->update('bantuan', $data);
    }
}
