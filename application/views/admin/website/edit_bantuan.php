<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Bantuan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Bantuan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->session->userdata('message'); ?>

        <!-- Main Content -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Ubah Halaman Bantuan</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('website/edit_bantuan'); ?>" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cara Berbelanja <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" name="bantuan1"><?= $bantuan['bantuan1']; ?></textarea>
                                <?= form_error('bantuan1', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cara Menjadi penjual <span class="text-danger">*</span></label>
                                        <textarea class="ckeditor" name="bantuan3"><?= $bantuan['bantuan3']; ?></textarea>
                                        <?= form_error('bantuan3', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jenis Pembayaran <span class="text-danger">*</span></label>
                                        <textarea class="ckeditor" name="bantuan2"><?= $bantuan['bantuan2']; ?></textarea>
                                        <?= form_error('bantuan2', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>&nbsp;&nbsp;Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>