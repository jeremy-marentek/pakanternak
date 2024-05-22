<div class="pcoded-main-container">
    <div class="pcoded-content">

        <!-- Breadcumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Profile</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form action="<?= site_url('profile/edit_profile_penjual'); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $penjual['id_penjual']; ?>">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="<?= base_url('upload/foto_user/' . $penjual['foto_penjual']); ?>" width="142px" height="142px" class="img-fluid img-radius" style="object-fit: cover; margin-top:25px; margin-bottom:19px" id="image-field">

                            <!-- Custom Input File -->
                            <input type="file" id="foto" name="foto" style="visibility: hidden" onchange="previewImage(event)">
                            <button type="button" class="btn btn-outline-primary col-sm-12" onclick="document.getElementById('foto').click()"><i class="feather icon-camera"></i>&nbsp;&nbsp; Ubah Foto</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mt-1">Edit Profile</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">NIM</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="nim" name="nim" placeholder="NIM" value="<?= $penjual['nim']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama" value="<?= $penjual['nama_penjual']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">Fakultas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="fakultas" name="fakultas" placeholder="Fakultas" value="<?= $penjual['nama_fakultas']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">Program Studi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="prodi" name="prodi" placeholder="Prodi" value="<?= $penjual['nama_prodi']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email" value="<?= $penjual['email_penjual']; ?>">
                                    <?= form_error('email', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" placeholder="Nomor Telepon" value="<?= $penjual['telepon_penjual']; ?>">
                                    <?= form_error('telepon', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="alamat" name="alamat" placeholder="Alamat" value="<?= $penjual['alamat_penjual']; ?>">
                                    <?= form_error('alamat', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row mt-4 mb-0">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-5">
                                    <a href="<?= site_url('profile/profile_penjual'); ?>" class="btn btn-secondary"><i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Kembali </a>
                                    <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>&nbsp;&nbsp;Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>