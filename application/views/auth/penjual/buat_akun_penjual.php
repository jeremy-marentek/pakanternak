<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: cbdbbe3a1fde4dbb8c55d96d79e8044e"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $provinsi = json_decode($response, true);
}
?>

<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('home'); ?>">Beranda</a></li>
                <li>Buat Akun</li>
            </ul>
        </div>
    </div>
</div>

<!-- Page Conttent -->
<main class="page-content">

    <!-- My Account Page -->
    <div class="my-account-area ptb-30">
        <div class="container">
            <br>
            <div class="row">

                <!-- Images  -->
                <div class="col-lg-6">
                    <img src="<?= base_url(); ?>assets/frontend/images/others/daftar_penjual.png" alt="" class="mb-2">
                    <p style="text-align: center;">Waroeng penjual adalah sebuah wadah bagi penjual UCIC yang memiliki usaha di bidang jasa atau produk yang dijual dan dapat dipasarkan melalui internal kampus ataupun eksternal kampus melalui media berbasis website. </p>
                </div>

                <!-- Form Login -->
                <div class="col-lg-6 mt-30 mt-lg-0">
                    <h2>BUAT AKUN penjual</h2>
                    <?= $this->session->userdata('message'); ?>
                    <div class="login-form-wrapper">
                        <div class="card">
                            <div class="card-body">

                            <form action="<?= site_url('auth/buat_akun_penjual'); ?>" method="POST">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-form-label col-form-label-sm">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="" value="<?= set_value('nama'); ?>">
                                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-form-label col-form-label-sm">Username</label>
                                        <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="" value="<?= set_value('username'); ?>">
                                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-form-label col-form-label-sm">Email</label>
                                        <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <!--  -->

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-form-label col-form-label-sm">Telepon</label>
                                        <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" placeholder="" value="<?= set_value('telepon'); ?>">
                                        <?= form_error('telepon', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-form-label col-form-label-sm">Password</label>
                                        <input type="password" class="form-control form-control-sm" id="password1" name="password1" placeholder="" value="<?= set_value('password1'); ?>">
                                        <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="col-sm-12 ho-button mt-2"><span>Buat Akun</span></button>
                                        <div class="text-center mt-3">
                                            <a href="<?= site_url('auth/login_umum'); ?>" class="text-dark">Kembali ke Login</a>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>