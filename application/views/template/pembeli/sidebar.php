<nav class="pcoded-navbar menu-light">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div ">

            <?php if ($this->session->userdata('tipe') == 1) { ?>
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="<?= base_url('upload/foto_user/' . $s_penjual['foto_penjual']); ?>" alt="User-Profile-Image">
                        <div class="user-details">
                            <div id="more-details"><?= $s_penjual['nama_penjual']; ?></div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="<?= base_url('upload/foto_user/' . $s_umum['foto']); ?>" alt="User-Profile-Image">
                        <div class="user-details">
                            <div id="more-details"><?= $s_umum['nama']; ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <br>

            <ul class="nav pcoded-inner-navbar ">
                <!-- Dashboard -->
                <li class="nav-item <?= active_menu('dashboard'); ?>">
                    <a href="<?= site_url('dashboard/pembeli'); ?>" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item pcoded-menu-caption">
                    <label>Menu Utama</label>
                </li>

                <!-- Pesanan -->
                <li class="nav-item <?= active_menu('pesanan'); ?>">
                    <a href="<?= site_url('pesanan/daftar_pesanan_pembeli/all'); ?>" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                        <span class="pcoded-mtext">Daftar Pesanan</span>
                    </a>
                </li>

                <!-- Akun Saya -->
                <?php if ($this->session->userdata('tipe') == 1) { ?>
                    <li class="nav-item pcoded-hasmenu <?= active_menu('profile'); ?>">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext"> Kelola Akun</span></a>
                        <ul class="pcoded-submenu">
                            <li class="<?php echo $this->uri->segment(2) == 'profile_penjual' || $this->uri->segment(2) == 'edit_profile_penjual' ? 'active' : '' ?>"><a href="<?= site_url('profile/profile_penjual'); ?>">Profile</a></li>
                            <li class="<?php echo $this->uri->segment(2) == 'ubah_password_penjual' ? 'active' : '' ?>"><a href="<?= site_url('profile/ubah_password_penjual'); ?>">Ubah Password</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item pcoded-hasmenu <?= active_menu('profile'); ?>">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext"> Kelola Akun</span></a>
                        <ul class="pcoded-submenu">
                            <li class="<?php echo $this->uri->segment(2) == 'profile_umum' || $this->uri->segment(2) == 'edit_profile_umum' ? 'active' : '' ?>"><a href="<?= site_url('profile/profile_umum'); ?>">Profile</a></li>
                            <li class="<?php echo $this->uri->segment(2) == 'ubah_password_umum' ? 'active' : '' ?>"><a href="<?= site_url('profile/ubah_password_umum'); ?>">Ubah Password</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <li class="nav-item pcoded-menu-caption">
                    <label>Utilities</label>
                </li>

                <!-- Halaman penjual -->
                <?php if ($this->session->userdata('tipe') == 1) { ?>
                    <li class="nav-item">
                        <a href="<?= site_url('dashboard/penjual'); ?>" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                            <span class="pcoded-mtext">Warma Seller</span>
                        </a>
                    </li>
                <?php } ?>

                <!-- Lihat Website -->
                <li class="nav-item">
                    <a href="<?= site_url('beranda'); ?>" class="nav-link" target="blank">
                        <span class="pcoded-micon"><i class="feather icon-eye"></i></span>
                        <span class="pcoded-mtext">Lihat Website</span>
                    </a>
                </li>

                <!-- Logout -->
                <?php if ($this->session->userdata('tipe') == 1) { ?>
                    <li class="nav-item">
                        <a href="<?= site_url('auth/logout_penjual'); ?>" class="nav-link ">
                            <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                            <span class="pcoded-mtext">Logout</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="<?= site_url('auth/logout_umum'); ?>" class="nav-link ">
                            <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                            <span class="pcoded-mtext">Logout</span>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</nav>