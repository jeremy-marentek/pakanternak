<nav class="pcoded-navbar menu-light">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div ">

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="<?= base_url('upload/foto_user/' . $s_penjual['foto_penjual']); ?>" alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details"><?= $s_penjual['nama_penjual']; ?></div>
                    </div>
                </div>
            </div>
            <br>

            <ul class="nav pcoded-inner-navbar ">
                <!-- Dashboard -->
                <li class="nav-item <?= active_menu('dashboard'); ?>">
                    <a href="<?= site_url('dashboard/penjual'); ?>" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item pcoded-menu-caption">
                    <label>Menu Utama</label>
                </li>

                <!-- Produk -->
                <li class="nav-item <?= active_menu('produk'); ?>">
                    <a href="<?= site_url('produk/data_produk'); ?>" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                        <span class="pcoded-mtext">Kelola Produk</span>
                    </a>
                </li>
                <!-- Pesanan -->
                <li class="nav-item <?= active_menu('pesanan'); ?>">
                    <a href="<?= site_url('pesanan/daftar_pesanan_penjual/all'); ?>" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                        <span class="pcoded-mtext">Kelola Pesanan</span>
                    </a>
                </li>
                <!-- Info Keuangan -->
                <li class="nav-item <?= active_menu('penjualan'); ?>">
                    <a href="<?= site_url('penjualan/info_penjualan'); ?>" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span>
                        <span class="pcoded-mtext">Laporan penjualan</span>
                    </a>
                </li>
                <!-- Laporan -->
                <!-- <li class="nav-item <?= active_menu('laporan'); ?>">
                    <a href="<?= site_url('laporan/laporan_penjualan'); ?>" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span>
                        <span class="pcoded-mtext">Laporan penjualan</span>
                    </a>
                </li> -->

                <li class="nav-item pcoded-menu-caption">
                    <label>Utilities</label>
                </li>

                <!-- Lihat Website -->
                <li class="nav-item">
                    <a href="<?= site_url('dashboard/pembeli'); ?>" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                        <span class="pcoded-mtext">Warma Buyer</span>
                    </a>
                </li>

                <!-- Lihat Website -->
                <li class="nav-item">
                    <a href="<?= site_url('beranda'); ?>" class="nav-link" target="_blank">
                        <span class="pcoded-micon"><i class="feather icon-eye"></i></span>
                        <span class="pcoded-mtext">Lihat Website</span>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="<?= site_url('auth/logout_penjual'); ?>" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>