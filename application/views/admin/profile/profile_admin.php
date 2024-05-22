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

        <?= $this->session->userdata('message'); ?>

        <div class="row">
            <div class="col-sm-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="thumbnail">
                            <div class="thumb">
                                <a href="<?= base_url('upload/foto_user/' . $admin['foto_admin']); ?>" data-lightbox="1">
                                    <img src="<?= base_url('upload/foto_user/' . $admin['foto_admin']); ?>" alt="" class="img-fluid img-radius" width="142px" style="object-fit: cover; margin-top:15px">
                                </a>
                            </div>
                        </div>
                        <h5 class="mt-4"><?= $admin['nama_admin']; ?></h5>
                        <p class="text-muted" style="margin-bottom: 10px;">Administrator</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-1">Profile</h5>
                        <div class="card-header-right">
                            <a href="<?= site_url('profile/edit_profile_admin'); ?>" class="btn waves-effect waves-light btn-primary">
                                <i class="feather icon-edit"></i>
                                &nbsp;Edit Profile
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <td width="30%">Nama</td>
                                        <td>:&nbsp;&nbsp; <?= $admin['nama_admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td>:&nbsp;&nbsp; <?= $admin['username_admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:&nbsp;&nbsp; <?= $admin['email_admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Level</td>
                                        <td>:&nbsp;&nbsp; administrator</td>
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