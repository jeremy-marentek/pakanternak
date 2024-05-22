<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('home'); ?>">Beranda</a></li>
                <li>Login penjual</li>
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
                    <img src="<?= base_url(); ?>assets/frontend/images/others/daftar_penjual.png" alt="">
                </div>

                <!-- Form Login -->
                <div class="col-lg-6 mt-30 mt-lg-0">
                    <h2>LOGIN penjual</h2>
                    <?= $this->session->userdata('message'); ?>
                    <div class="login-form-wrapper">
                        <div class="card">
                            <div class="card-body">

                                <form action="<?= site_url('auth/login_penjual'); ?>" method="POST">
                                <div class="form-group">
                                        <label for="inputEmail3" class="col-form-label col-form-label-sm">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="" value="<?= set_value('username'); ?>">
                                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-form-label col-form-label-sm">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="" value="">
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="col-sm-12 ho-button mt-2"><span>Login</span></button>
                                        <div class="text-center mt-3">
                                            <a href="<?= site_url('auth/lupa_password_penjual'); ?>" class="text-dark">Lupa Password</a>
                                        </div>
                                        <div class="text-center">
                                            <a href="<?= site_url('auth/buat_akun_penjual'); ?>" class="text-dark">Buat Akun</a>
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
