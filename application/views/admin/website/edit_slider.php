<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit Slider</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Edit Slider</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->session->userdata('message'); ?>

        <!-- Main Content -->
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $slider['id_slider']; ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mt-1">Tambah Slider</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-form-label col-form-label-sm">Foto Slider <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="foto">
                                    <label class="custom-file-label" for="inputGroupFile01">Ubah Foto</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label col-form-label-sm">Headline 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="headline1" name="headline1" placeholder="Masukkan Headline 1" value="<?= $slider['headline1']; ?>">
                                <?= form_error('headline1', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label col-form-label-sm">Headline 2 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="headline2" name="headline2" placeholder="Masukkan Headline 2" value="<?= $slider['headline2']; ?>">
                                <?= form_error('headline2', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label col-form-label-sm">Headline 3 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="headline3" name="headline3" placeholder="Masukkan Headline 3" value="<?= $slider['headline3']; ?>">
                                <?= form_error('headline3', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label col-form-label-sm">Jadikan Foto Awal <span class="text-danger">*</span></label>
                                <select class="form-control" name="status">
                                    <?php if ($slider['status'] == 1) {
                                        $aktif = "selected";
                                        $tidak_aktif = "";
                                    } else {
                                        $aktif = "";
                                        $tidak_aktif = "selected";
                                    }; ?>
                                    <option <?php echo $tidak_aktif; ?> value="0"> Tidak Aktif</option>
                                    <option <?php echo $aktif; ?> value="1"> Aktif</option>
                                </select>
                            </div>
                            <div class="form-group mt-4 mb-0">
                                <button type="submit" class="btn btn-primary float-right"><i class="feather icon-save"></i>&nbsp;&nbsp;Simpan</button>
                                <a href="<?= site_url('website/data_slider'); ?>" class="btn btn-secondary float-right mr-1"><i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>