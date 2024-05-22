<?php

use phpDocumentor\Reflection\Types\True_;

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Rajaongkir.php');
// require_once(APPPATH . '/midtrans/Midtrans.php');

class Checkout extends Rajaongkir
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('checkout_model');
    }

	public function hitungOngkir($id_pembeli, $id_penjual, $total_berat, $selected_courier)
{
    // Mendapatkan data alamat pembeli dan penjual
    $alamat_pembeli = $this->db->get_where('alamat', ['id_pengguna' => $id_pembeli, 'set_alamat_utama' => 1])->row();
    $alamat_penjual = $this->db->get_where('alamat', ['id_pengguna' => $id_penjual, 'set_alamat_utama' => 1])->row();

    // Pastikan alamat pembeli dan penjual ditemukan

    // Mendapatkan tipe pembeli
    $tipe_pembeli = $this->session->userdata('tipe');

    // Mendapatkan detail keranjang berdasarkan id_pembeli dan id_penjual
    $detail_keranjang = $this->db->select('*')
        ->from('detail_keranjang')
        ->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
        ->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
        ->join('keranjang', 'detail_keranjang.id_keranjang = keranjang.id_keranjang')
        ->where('keranjang.id_pembeli', $id_pembeli)
        ->where('keranjang.tipe_pembeli', $tipe_pembeli)
        ->where('keranjang.status_keranjang', 0)
        ->get()->result_array();

    // Menghitung total berat per produk dan menambahkannya ke total berat
    $total_berat_per_produk = [];
    foreach ($detail_keranjang as $detail) {
        if (isset($detail['berat_produk'])) {
            $total_berat_per_produk[$detail['id_produk']] = $detail['berat_produk'] * $detail['kuantitas'];
        }
    }

    // Menghitung ongkir dengan menggunakan API Rajaongkir
    $origin = $alamat_penjual->id_kota; // ID kota penjual
    $destination = $alamat_pembeli->id_kota; // ID kota pembeli
    $courier = $selected_courier; // Anda bisa mengganti kurir sesuai kebutuhan

    // Memastikan total berat lebih dari 0
    if ($total_berat <= 0) {
        return "Total berat produk harus lebih dari 0";
    }

    // Menggunakan metode _api_ongkir_post untuk menghitung ongkir
    $response = $this->_api_ongkir_post($origin, $destination, $total_berat, $courier);

    // Mengurai respons json 
	$ongkir_data = json_decode($response, true);

    // Mengembalikan data ongkir
    return $ongkir_data;
}
		
public function _api_ongkir_post($origin,$des,$qty,$cour)
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
		$berat = $qty;
		$tarif = $this->_api_ongkir_post($origin,$des,$berat,$cour);		
		$data = json_decode($tarif, true);
		echo json_encode($data['rajaongkir']['results']);		
	}

	

	public function index()
	{
		if (!$this->session->userdata('id')) {
			redirect('auth/login_umum');
		}
	
		$tipe_akun = $this->session->userdata('tipe');
		
		$alamat_utama = $this->db->get_where('alamat', ['id_pengguna' => $this->session->userdata('id'), 'set_alamat_utama' => 1])->row();
		if($tipe_akun == 1 && !$alamat_utama) {
			redirect('alamatpenjual');
		}
	
		$data['title'] = 'Warma CIC | Checkout';
	
		// Retrieve list of sellers
		$list_penjual = $this->db->select('DISTINCT(akun_penjual.id_penjual)')
			->from('keranjang')
			->join('detail_keranjang', 'keranjang.id_keranjang = detail_keranjang.id_keranjang')
			->join('produk', 'detail_keranjang.id_produk = produk.id_produk')
			->join('akun_penjual', 'produk.id_penjual = akun_penjual.id_penjual')
			->where('keranjang.id_pembeli', $this->session->userdata('id'))
			->where('keranjang.tipe_pembeli', $this->session->userdata('tipe'))
			->where('keranjang.status_keranjang', 0)
			->get()->result_array();
	
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
			$list_penjual[$detail['id_penjual']][] = $detail;
		}
	
		$data['ongkir'] = [];
		foreach ($list_penjual as $id_penjual => $detail_list) {
			// Retrieve origin (seller's city ID) for each seller
			$origin = $this->db->get_where('alamat', ['id_pengguna' => $id_penjual, 'set_alamat_utama' => 1])->row()->id_kota;
			
			// Retrieve destination (buyer's city ID) for each transaction
			$des = $alamat_utama->id_kota;
	
			// Calculate total weight for each seller's products
			$berat = 0;
			foreach ($detail_list as $detail) {
				if (isset($detail['berat_produk'])) {
					$berat += $detail['berat_produk'] * $detail['kuantitas'];
				}
			}
			
			// Set default courier
			$selected_courier = "jne";
			
			// Calculate shipping cost
			$ongkir_data = $this->hitungOngkir($this->session->userdata('id'), $id_penjual, $berat, $selected_courier);
			
			// Store shipping cost data
			$data['ongkir'][$id_penjual] = $ongkir_data;
	
			foreach ($detail_list as $detail) {
				// Display shipping cost for each product
				$ongkir_data = $data['ongkir'][$detail['id_penjual']];
			
				?>
				 
				<!-- Display shipping cost for each product -->
				<div>
					<p>Nama Produk: <?= $detail['nama_produk'] ?></p>
					<?php if (isset($ongkir_data['rajaongkir']['results'][0]['costs'])): ?>
						<?php foreach ($ongkir_data['rajaongkir']['results'][0]['costs'] as $cost): ?>
							<p>Layanan: <?= $cost['service'] ?></p>
							<p>Deskripsi: <?= $cost['description'] ?></p>
							<p>Biaya Pengiriman: <?= $cost['cost'][0]['value'] ?> <?= $cost['cost'][0]['etd'] ?></p>
						<?php endforeach; ?>
					<?php else: ?>
						<p>Biaya Pengiriman tidak tersedia</p>
						<!-- You can handle this case based on your requirements -->
					<?php endif; ?>
				</div>
				<?php
			}
		}
		

		$data['origin'] = $origin;
		$data['destination'] = $des;
		$data['total_berat'] = $berat;
		
		$this->paggingFrontend('frontend/checkout', $data);
		
		$data['list_penjual'] = array_keys($list_penjual);
		var_dump($data['ongkir']);
		$this->paggingFrontend('frontend/checkout', $data);
	}
	



    
}