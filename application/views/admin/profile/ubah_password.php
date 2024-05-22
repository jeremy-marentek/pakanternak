<div class="pcoded-main-container">
    <div class="pcoded-content">

        <!-- Breadcumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Ubah Password</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Ubah Password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="thumbnail">
                            <div class="thumb">
                                <a href="<?= base_url('upload/foto_user/' . $admin['foto_admin']); ?>" data-lightbox="1">
                                    <img src="<?= base_url('upload/foto_user/' . $admin['foto_admin']); ?>" alt="" class="img-fluid img-radius" width="142px" style="object-fit: cover; margin-top:28px;">
                                </a>
                            </div>
                        </div>
                        <h5 class="mt-4"><?= $admin['nama_admin']; ?></h5>
                        <p class="text-muted" style="margin-bottom: 16px;">Administrator</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-1">Ubah Password</h5>
                    </div>

                    <!-- Form -->
                    <form action="<?= site_url('profile/ubah_password_admin/' . $admin['id_admin']); ?>" method="POST">
                        <div class="card-body">
                            <?= $this->session->userdata('message'); ?>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label col-form-label-sm">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control form-control-sm" id="pw_lama" name="pw_lama" placeholder="Masukkan Password Lama" value="<?= set_value('pw_lama'); ?>">
                                    <?= form_error('pw_lama', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control form-control-sm" id="pw_baru" name="pw_baru" placeholder="Masukkan Password Baru" value="<?= set_value('pw_baru'); ?>">
                                    <?= form_error('pw_baru', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">Ulangi Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control form-control-sm" id="pw_baru2" name="pw_baru2" placeholder="Ulangi Password Baru">
                                    <?= form_error('pw_baru2', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row mt-4 mb-0">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-5">
                                    <button type="reset" class="btn btn-danger"><i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Reset</button>
                                    <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>&nbsp;&nbsp;Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>