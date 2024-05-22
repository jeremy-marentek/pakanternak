<div class="pcoded-main-container">
    <div class="pcoded-content">

        <!-- Breadcumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detail</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Detail</a></li>
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
                                <a href="<?= base_url('upload/foto_user/' . $umum['foto']); ?>" data-lightbox="1">
                                    <img src="<?= base_url('upload/foto_user/' . $umum['foto']); ?>" alt="" class="img-fluid img-radius" width="142px" style="object-fit: cover; margin-top:28px">
                                </a>
                            </div>
                        </div>
                        <h5 class="mt-4"><?= $umum['nama']; ?></h5>
                        <p class="text-muted" style="margin-bottom: 17px;"><?= $umum['email']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Pengguna Umum</h5>
                        <div class="card-header-right">
                            <a href="<?= site_url('akun/data_akun_umum'); ?>">
                                <button type="button" class="btn waves-effect waves-light btn-primary">
                                    <i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Kembali
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td>Nama Pengguna</td>
                                        <td>:&nbsp;&nbsp; <?= $umum['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:&nbsp;&nbsp; <?= $umum['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon</td>
                                        <td>:&nbsp;&nbsp; <?= $umum['telepon']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Daftar</td>
                                        <td>:&nbsp;&nbsp; <?= $umum['tanggal_daftar']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:&nbsp;&nbsp;
                                            <?php if ($umum['status_aktif'] == 1) { ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Tidak Aktif</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>