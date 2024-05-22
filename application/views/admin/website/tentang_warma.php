<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Tentang Kami</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Tentang Kami</a></li>
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
                        <h5>Halaman Tentang Kami</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('website/edit_tentang_warma'); ?>" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Apa Itu Warma? <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" name="tentang"><?= $tentang_warma['tentang']; ?></textarea>
                                <?= form_error('tentang', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tujuan Warma <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" name="tujuan"><?= $tentang_warma['tujuan']; ?></textarea>
                                <?= form_error('tujuan', '<small class="text-danger font-weight-bold">', '</small>'); ?>
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