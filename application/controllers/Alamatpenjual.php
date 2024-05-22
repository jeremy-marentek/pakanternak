<?php

use phpDocumentor\Reflection\Types\True_;

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Redirectpenjual.php');
// require_once(APPPATH . '/midtrans/Midtrans.php');

class Alamatpenjual extends Redirectpenjual
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('checkout_model');
    }
    function hitung_ongkir($origin,$des,$qty,$cour)
   {
  	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$des."&weight=".$qty."&courier=".$cour,	  
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    /* masukan api key disini*/
	    "key: cbdbbe3a1fde4dbb8c55d96d79e8044e"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  return $err;
		} else {
		  return $response;
		}
   }
   function _api_ongkir($data)
   {
	   	$curl = curl_init();
		curl_setopt_array($curl, array(
		  //CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
		  //CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/".$data,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",		  
		  CURLOPT_HTTPHEADER => array(
		  	/* masukan api key disini*/
		    "key: cbdbbe3a1fde4dbb8c55d96d79e8044e"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  return  $err;
		} else {
		  return $response;
		}
   }
	public function provinsi()
	{
		$provinsi = $this->_api_ongkir('province');
		$data = json_decode($provinsi, true);
		echo json_encode($data['rajaongkir']['results']);
	}
	public function lokasi()
	{
		$this->load->view('head');
		$this->load->view('nav');
		$this->load->view('halaman');
		$this->load->view('footer');
		
	}
	public function kota($provinsi="")
	{
		if(!empty($provinsi))
		{
			if(is_numeric($provinsi))
			{
				$kota = $this->_api_ongkir('city?province='.$provinsi);	
				$data = json_decode($kota, true);
				echo json_encode($data['rajaongkir']['results']);		  					 
			}
			else
			{
				show_404();
			}
		}
	   else
	   {
	   	show_404();
	   }
	}
	public function tarif($origin,$des,$qty,$cour)
	{
		$berat = $qty*1000;
		$tarif = $this->hitung_ongkir($origin,$des,$berat,$cour);		
		$data = json_decode($tarif, true);
		echo json_encode($data['rajaongkir']['results']);		
	}

    public function index()
{
    if (!$this->session->userdata('id')) {
        redirect('auth/login_umum');
    }
    
    $data['title'] = 'Warma CIC | Checkout';

    $list_penjual = $this->db->select('DISTINCT(akun_penjual.id_penjual)')
            ->from('keranjang')
            ->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang')
            ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
            ->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
            ->where('keranjang.id_pembeli', $this->session->userdata('id'))
            ->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'))
            ->where('keranjang.status_keranjang', 0)
            ->get()->result_array();

        //Untuk ambil data detail keranjang
        $detail_keranjang = $this->db->select('*')
            ->from('keranjang')
            ->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang')
            ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
            ->where('keranjang.id_pembeli', $this->session->userdata('id'))
            ->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'))
            ->where('keranjang.status_keranjang', 0)
            ->get()->result_array();

        $list_penjual = [];

        foreach ($detail_keranjang as $detail) {
            $list_penjual[] = $detail['id_penjual'];
        }

    $data['list_penjual'] = $list_penjual;
    $this->paggingFrontend('frontend/alamatpenjual', $data);
}

    
}