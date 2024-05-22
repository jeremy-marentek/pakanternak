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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="nav nav-pills" role="tablist">
                            <a href="<?= site_url('akun/detail_akun_penjual'); ?>/<?= $penjual['id_penjual']; ?>" class="nav-link active">Detail penjual</a>
                            <a href="<?= site_url('akun/detail_produk_penjual'); ?>/<?= $penjual['id_penjual']; ?>" class="nav-link">Daftar Produk</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td>Nomor Induk penjual</td>
                                        <td>:&nbsp;&nbsp; <?= $penjual['nim']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama penjual</td>
                                        <td>:&nbsp;&nbsp; <?= $penjual['nama_penjual']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Fakultas</td>
                                        <td>:&nbsp;&nbsp; <?= $penjual['nama_fakultas']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Program Studi</td>
                                        <td>:&nbsp;&nbsp; <?= $penjual['nama_prodi']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:&nbsp;&nbsp; <?= $penjual['email_penjual']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon</td>
                                        <td>:&nbsp;&nbsp; <?= $penjual['telepon_penjual']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:&nbsp;&nbsp; <?= $penjual['alamat_penjual']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Daftar</td>
                                        <td>:&nbsp;&nbsp; <?= $penjual['tanggal_daftar']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:&nbsp;&nbsp;
                                            <?php if ($penjual['status_aktif'] == 1) { ?>
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
            <div class="col-sm-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="thumbnail">
                            <div class="thumb">
                                <a href="<?= base_url('upload/foto_user/' . $penjual['foto_penjual']); ?>" data-lightbox="1">
                                    <img src="<?= base_url('upload/foto_user/' . $penjual['foto_penjual']); ?>" alt="" class="img-fluid img-radius" width="142px" style="object-fit: cover; margin-top:15px">
                                </a>
                            </div>
                        </div>
                        <h5 class="mt-4"><?= $penjual['nama_penjual']; ?></h5>
                        <p class="text-muted" style="margin-bottom: 10px;"><?= $penjual['email_penjual']; ?></p>
                    </div>
                </div>
                <a href="<?= site_url('akun/data_akun_penjual'); ?>" class="btn btn-primary col-sm-12"><i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Kembali</a>
            </div>
        </div>
    </div>
</div>