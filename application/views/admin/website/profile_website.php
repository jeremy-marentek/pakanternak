<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Profile Website</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Profile Website</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->session->userdata('message'); ?>

        <!-- Main Content -->
        <div class="row">
            <div class="col-sm-12">

                <!-- Data Website -->
                <div class="card">
                    <?php foreach ($website as $w) : ?>
                        <div class="card-header">
                            <h5>Profile Website</h5>
                            <a href="<?= site_url('website/edit_profile_website/' . $w['id']); ?>">
                                <div class="card-header-right">
                                    <button type="button" class="btn waves-effect waves-light btn-primary">
                                        <i class="feather icon-edit"></i>
                                        &nbsp;Edit Profile
                                    </button>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Nama Website</td>
                                            <td>:&nbsp;&nbsp; <?= $w['nama_website']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:&nbsp;&nbsp; <?= $w['alamat']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:&nbsp;&nbsp; <?= $w['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Telepon</td>
                                            <td>:&nbsp;&nbsp; <?= $w['telepon']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Instagram</td>
                                            <td>:&nbsp;&nbsp; <?= $w['instagram']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>