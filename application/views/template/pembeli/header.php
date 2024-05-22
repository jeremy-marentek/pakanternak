<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="<?= site_url('dashboard/seller'); ?>" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-warma-3.png" alt="" class="logo" width="140px">
            <img src="<?= base_url(); ?>assets/backend/images/logo-icon.png" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <?php if ($this->session->userdata('tipe') == 1) { ?>
                            <div class="pro-head">
                                <img src="<?= base_url('upload/foto_user/' . $s_penjual['foto_penjual']); ?>" class="img-radius" alt="User-Profile-Image">
                                <span><?= $s_penjual['nama_penjual']; ?></span>
                            </div>
                        <?php } else { ?>
                            <div class="pro-head">
                                <img src="<?= base_url('upload/foto_user/' . $s_umum['foto']); ?>" class="img-radius" alt="User-Profile-Image">
                                <span><?= $s_umum['nama']; ?></span>
                            </div>
                        <?php } ?>

                        <ul class="pro-body">
                            <?php if ($this->session->userdata('tipe') == 1) { ?>
                                <li><a href="<?= site_url('profile/profile_penjual'); ?>" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                <li><a href="<?= site_url('auth/logout_penjual'); ?>" class="dropdown-item"><i class="feather icon-log-out"></i> Logout</a></li>
                            <?php } else { ?>
                                <li><a href="<?= site_url('profile/profile_umum'); ?>" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                <li><a href="<?= site_url('auth/logout_umum'); ?>" class="dropdown-item"><i class="feather icon-log-out"></i> Logout</a></li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>