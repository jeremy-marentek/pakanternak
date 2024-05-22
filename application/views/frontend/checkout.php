


<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('beranda'); ?>">Beranda</a></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="page-content">

    <!-- Shop Page Area -->
    <div class="checkout-area bg-white ptb-30">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 mb-30">
                    <?php
                    // Mengecek apakah sudah ada alamat utama
                    $alamat_utama = $this->db->get_where('alamat', ['id_pengguna' => $this->session->userdata('id'), 'set_alamat_utama' => 1])->row();
                    ?>

                    <!-- Bagian untuk menampilkan data alamat utama -->
                    <?php if ($alamat_utama) : ?>
                        <!-- Tampilan Alamat Utama -->
                        <h3 class="small-title">PENERIMA</h3>
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?= $alamat_utama->nama; ?></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>: <?= $alamat_utama->telepon; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= 'Provinsi ' . $alamat_utama->nama_provinsi . ', ' . $alamat_utama->nama_kota . ', Kode Pos ' . $alamat_utama->kode_pos; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAlamatModal">
                                Tambah Alamat
                            </button>
                        </p>
                    <?php endif; ?>
                </div>







                
                <!-- Daftar Belanja -->
                <div class="col-12">

                <?php 
$total_belanja = 0;

// Mengelompokkan produk berdasarkan penjual
$grouped_products = [];
foreach ($detail_keranjang as $detail) {
    $id_penjual = $detail['id_penjual'];
    $grouped_products[$id_penjual][] = $detail;
}

// Inisialisasi variabel untuk total berat per penjual
$total_berat_penjual = [];

// Menghitung total berat per penjual
foreach ($grouped_products as $id_penjual => $products) {
    $total_berat_penjual[$id_penjual] = 0;
    foreach ($products as $product) {
        // Periksa apakah berat produk tersedia
        if (isset($product['berat_produk'])) {
            $total_berat_penjual[$id_penjual] += $product['berat_produk'] * $product['kuantitas'];
        }
    }
}

// Output total berat per penjual
foreach ($total_berat_penjual as $id_penjual => $total_berat) {
    echo "Total berat untuk penjual dengan ID $id_penjual: $total_berat grams<br>";
}
?>

<!-- DAFTAR BELANJA -->
<h3 class="small-title">DAFTAR BELANJA</h3>
<?php foreach ($grouped_products as $id_penjual => $products) :
    $alamat_penjual = $this->db->get_where('alamat', ['id_pengguna' => $id_penjual])->row();
    $nama_kota_penjual = $alamat_penjual->nama_kota;
    // Dapatkan alamat pembeli dari tabel "alamat" berdasarkan ID pembeli
    $id_pembeli = $this->session->userdata('id');
    $alamat_pembeli = $this->db->get_where('alamat', ['id_pengguna' => $id_pembeli])->row();

    // Inisialisasi ulang variabel $total_belanja_penjual untuk setiap penjual
    $total_belanja_penjual = 0;
    $penjual_info = $this->db->get_where('akun_penjual', ['id_penjual' => $id_penjual])->row();
?>

<!-- Display seller's information and products -->
<div class="order-infobox mb-30">
    <div class="checkout-table">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-1 text-center mb-2">
                        <a href="<?= site_url('penjual/detail_penjual/' . $penjual_info->id_penjual); ?>">
                            <img src="<?= base_url('upload/foto_user/' . $penjual_info->foto_penjual); ?>" alt="" class="img-fluid rounded-circle mt-1" width="50px" style="object-fit: cover;">
                        </a>
                    </div>
                    <div class="col-sm-2 mb-3">
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="text-center mb-2">
                                    <a href="<?= site_url('penjual/detail_penjual/' . $penjual_info->id_penjual); ?>">
                                        <?= $penjual_info->nama_penjual; ?>
                                    </a>
                                </h5>
                            </div>
                            <div class="col-sm-9 text-center">
                                <a href="https://api.whatsapp.com/send?phone=<?= $penjual_info->telepon_penjual; ?>&text=Hai,%20saya%20ingin%20bertanya%20tentang%20produk%20yang%20anda%20jual" class="btn btn-sm btn-success text-white" target="_blank">Chat penjual</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product table -->
        <div class="">
            <table class="table mb-0">
                <!-- Table headers -->
                <thead>
                    <tr>
                        <th class="text-left">NAMA</th>
                        <th class="text-center">JUMLAH</th>
                        <th class="text-right">HARGA</th>
                        <th class="text-right">TOTAL</th>
                    </tr>
                </thead>
                <!-- Product details -->
                <tbody>
                    <?php foreach ($products as $product) :
                        // Inisialisasi ulang variabel $total_belanja di setiap iterasi loop
                        $total_belanja = $product['harga_produk'] * $product['kuantitas'];
                        // Hitung total belanja untuk setiap produk
                        $total_belanja_penjual += $total_belanja;
                    ?>
                    <!-- Display product information -->
                    <tr>
                        <td class="text-left"><?= $product['nama_produk']; ?></td>
                        <td class="text-center"><?= $product['kuantitas']; ?></td>
                        <td class="text-right">Rp<?= number_format($product['harga_produk'], 0, ',', '.'); ?></td>
                        <td class="text-right">Rp<?= number_format($total_belanja, 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <!-- Table footer -->
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-left">TOTAL BELANJA</th>
                        <td class="text-right">Rp<?= number_format($total_belanja_penjual, 0, ',', '.'); ?></td>
                    </tr>
                    <!-- Courier selection and shipping cost calculation -->
                    <tr>
                        <th colspan="3" class="text-left">Jasa Pengirim</th>
                        <td class="text-right">
                            <select class="form-control kurir" id="kurir" data-origin="<?= $alamat_penjual->id_kota ?>" data-destination="<?= $alamat_pembeli->id_kota ?>" data-weight="<?= $total_berat_penjual[$id_penjual] ?>" data-penjual="<?= $id_penjual ?>">

                                <option value="">Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr class="ongkir-row" data-penjual="<?= $id_penjual ?>"> 
        <th colspan="3" class="text-left">Ongkir</th>
        <td class="text-right ongkir" id="ongkir<?= $id_penjual ?>" data-totalbelanja="<?= $total_belanja_penjual ?>">
    <select class="form-control ongkir" id="ongkirSelect<?= $id_penjual ?>" style="width: 100%">
    </select> 
</td>
</tr>
    <tr>
        <th></th>
    <th colspan="3" class="text-right">DIKIRIM DARI: <?= $nama_kota_penjual ?></th>
    </tr>
    </tr>
    <tr>
    <th colspan="3" class="text-left">subtotal</th>
    <td class="text-right" id="subtotal<?= $id_penjual ?>"></td>
</tr>



                </tfoot>
            </table>
        </div>
    </div>
</div>



<?php endforeach; ?>

<!-- Bagian untuk menampilkan total belanja dan tombol bayar -->
<div class="order-infobox mb-30">
    <div class="checkout-table">
        <table class="table table-borderless">
            <tfoot>
                <tr class="total-price">
                    <th class="text-left">TOTAL BAYAR</th>
                    <td class="text-right"></td>
                </tr>
            </tfoot>
        </table>
        <button class="ho-button ho-button-fullwidth col-sm-12" type="submit">
            <span>Bayar</span>
        </button>
    </div>
</div>

        </div>
    </div>
</main>


















<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="tambahAlamatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('alamat/tambahAlamat') ?>" id="formTambahAlamat" method="POST">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>
          <div class="form-group col-md-6">
            <label for="telepon">Telepon:</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
          </div>
        </div>
        <div class="form-group">
    <label for="provinsi">Provinsi:</label>
    <select class="form-control" id="provinsi" name="provinsi" required>
      <option value="">Pilih Provinsi</option>
    </select>
      </div>
      <input type="hidden" id="nama_provinsi" name="nama_provinsi" value="">


<div class="form-group">
    <label for="kota">Kota/Kabupaten:</label>
    <select class="form-control" id="kota" name="kota" required disabled>
        <option value="">Pilih Provinsi Terlebih Dahulu...</option>
    </select>
</div>
<input type="hidden" id="nama_kota" name="nama_kota" value="">

            <div class="form-group">
              <label for="kode_pos">Kode Pos:</label>
              <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
            </div>
          <div class="form-group">
            <label for="lokasi_saat_ini">Detail Alamat :</label><br>
            <input type="text" class="form-control" id="detail_alamat" name="detail_alamat" placeholder="Nama jalan" required>
            

            <!-- <button type="button" class="btn btn-primary" onclick="getGeolocation()">Ambil Lokasi Saat Ini</button> -->
            <!-- <p id="lokasi_saat_ini"></p> -->
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">

          </div>
          <!-- Checkbox Set Alamat Utama -->
          <div class="form-group form-check">
            <?php
            // Mengecek apakah sudah ada alamat utama
            $alamat_utama = $this->db->get_where('alamat', ['id_pengguna' => $this->session->userdata('id'), 'set_alamat_utama' => 1])->row();
            // Set atribut untuk checkbox
            $isChecked = $alamat_utama ? '' : 'checked';
            $isDisabled = $alamat_utama ? '' : 'disabled';
            ?>
            <!-- Cetak kode HTML untuk checkbox -->
            <?php if (!$alamat_utama) : ?>
              <input type="hidden" name="set_alamat_utama" value="1">
            <?php endif ?>
            <input type="checkbox" class="form-check-input" id="set_alamat_utama" name="set_alamat_utama" value=1 <?= $isChecked ?> <?= $isDisabled ?>>
            <label class="form-check-label" for="set_alamat_utama">Set sebagai alamat utama</label>
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>