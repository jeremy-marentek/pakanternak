<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tentang_warma extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('website_model');
    }

    public function index()
    {
        $data['title'] = 'Pakan Ternak | Tentang Warma';
        $data['tentang_warma'] = $this->website_model->tentang_warma();
        $this->paggingFrontend('frontend/tentang_warma', $data);
    }
}
