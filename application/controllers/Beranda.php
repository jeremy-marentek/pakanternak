<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('website_model');
    }

    public function index()
    {
      

        $data['title'] = 'Selamat Datang di Waroeng penjual';
        $data['slider'] = $this->website_model->getData_slider();
        $data['produk'] = $this->produk_model->getdata_produkFrontend('terbaru');
        $data['produk_terlaris'] = $this->produk_model->getdata_produkTerlaris();
        $this->paggingFrontend('frontend/beranda', $data);
    }
}
