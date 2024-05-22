<?php
      $tipe_akun = $this->session->userdata('tipe'); 
       // Mengecek apakah sudah ada alamat utama
      $alamat_utama = $this->db->get_where('alamat', ['id_pengguna' => $this->session->userdata('id'), 'set_alamat_utama' => 1])->row();
      if($tipe_akun=1 && $alamat_utama){
      redirect('beranda');
                    }
                    ?>

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
            <!-- <button type="button" class="btn btn-primary" onclick="getGeolocation()">Ambil Lokasi Saat Ini</button> -->
            <p id="lokasi_saat_ini"></p>
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
