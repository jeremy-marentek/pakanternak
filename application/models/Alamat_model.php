<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alamat_model extends CI_Model
{
    public function tambahAlamat($data)
    {
        return $this->db->insert('alamat', $data);
    }

}   
?>