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
                            <li class="breadcrumb-item"><a href="#!"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->session->userdata('message'); ?>

        <div class="row">
            <div class="col-sm-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="thumbnail">
                            <div class="thumb">
                                <a href="<?= base_url('upload/foto_user/' . $umum['foto']); ?>" data-lightbox="1">
                                    <img src="<?= base_url('upload/foto_user/' . $umum['foto']); ?>" alt="" class="img-fluid img-radius" width="142px" style="object-fit: cover; margin-top:29px">
                                </a>
                            </div>
                        </div>
                        <h5 class="mt-4"><?= $umum['username']; ?></h5>
                        <p class="text-muted" style="margin-bottom: 17px;"><?= $umum['email']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-1">Profile</h5>
                        <div class="card-header-right">
                            <a href="<?= site_url('profile/edit_profile_umum'); ?>" class="btn waves-effect waves-light btn-primary">
                                <i class="feather icon-edit"></i>
                                &nbsp;Edit Profile
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td>Username</td>
                                        <td>:&nbsp;&nbsp; <?= $umum['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:&nbsp;&nbsp; <?= ucwords($umum['jenis_kelamin']); ?></td>
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
                                        <td>:&nbsp;&nbsp; <?= date('d M Y', strtotime($umum['tanggal_daftar'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:&nbsp;&nbsp;
                                            <?php if ($umum['status_aktif'] == 1) { ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php } else { ?>
                                                <span class="badge badge-success">Tidak Aktif</span>
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