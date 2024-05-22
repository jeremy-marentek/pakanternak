<header class="header header-3">
    <!-- Header Top Area -->
    <div class="header-top bg-theme">
        <div class=" container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-7 col-sm-7 col-12">
                    <p class="header-welcomemsg"><?= $website['nama_website']; ?> &nbsp;&nbsp;|&nbsp;&nbsp;<?= date('d M Y'); ?></p>
                </div>

                <?php if (!$this->session->userdata('id')) { ?>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                        <div class="header-langcurr">
                            <div class="select-currency">
                                <button class="select-currency-current">Masuk</button>
                                <ul class="select-currency-list dropdown-list">
                                    <li><a href="<?= site_url('auth/login_penjual'); ?>">penjual</a></li>
                                    <li><a href="<?= site_url('auth/login_umum'); ?>">Pengguna Umum</a></li>
                                </ul>
                            </div>
                            <div class="select-language">
                                <button class="select-language-current">Daftar</button>
                                <ul class="select-language-list dropdown-list">
                                    <li><a href="<?= site_url('auth/buat_akun_penjual'); ?>">penjual</a></li>
                                    <li><a href="<?= site_url('auth/buat_akun_umum'); ?>">Pengguna Umum</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                        <div class="header-langcurr">
                            <div class="select-currency">
                                <button class="select-currency-current">Silahkan Berbelanja</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <!-- Header Middle Area -->
    <div class="header-middle bg-theme">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-sm-6 order-1 order-lg-1">
                    <a href="<?= site_url('beranda'); ?>" class="header-logo">
                        <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-warma-2.png" alt="logo" width="240px">
                    </a>
                </div>
                <div class="col-lg-6 col-12 order-3 order-lg-2">
                    <form action="<?= site_url('produk/cari_produk'); ?>" class="header-searchbox" method="POST">
                        <!-- <select class="select-searchcategory" name="kategori">
                            <option>Kategori</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select> -->
                        <input type="text" name="keyword" placeholder="Masukkan Produk Yang Ingin Anda Cari...">
                        <button type="submit"><i class="lnr lnr-magnifier"></i></button>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 order-2 order-lg-3">
                    <div class="header-icons">

                        <?php if ($this->session->userdata('id')) { ?>
                            <div class="header-account">
                                <button class="header-accountbox-trigger"><span class="lnr lnr-user"></span> <?= $this->session->userdata('nama'); ?> <i class="ion ion-ios-arrow-down"></i></button>
                                <ul class="header-accountbox dropdown-list">
                                    <li><a href="<?= site_url('dashboard/pembeli'); ?>">Dashboard</a></li>
                                    <li><a href="<?= site_url('keranjang/halaman_keranjang'); ?>">Keranjang</a></li>

                                    <?php if ($this->session->userdata('tipe') == 1) { ?>
                                        <li><a href="<?= site_url('profile/profile_penjual'); ?>">Profile</a></li>
                                        <li><a href="<?= site_url('auth/logout_penjual'); ?>">Logout</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?= site_url('profile/profile_umum'); ?>">Profile</a></li>
                                        <li><a href="<?= site_url('auth/logout_umum'); ?>">Logout</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } else { ?>
                            <div class="header-account">
                                <a href=""><button class="header-accountbox-trigger harap-login"><span class=" lnr lnr-user"></span> Akun Saya</button></a>
                            </div>
                        <?php } ?>

                        <!-- Keranjang -->
                        <div class="header-cart">
                            <a class="header-carticon" href="keranjang/halaman_keranjang"><i class="lnr lnr-cart"></i><span class="count"><?= $jumlah_produk; ?></span></a>
                            <div class="header-minicart minicart">

                                <!-- Variabel Total Belanja -->
                                <?php
                                $total_belanja = 0;
                                ?>

                                <?php if (empty($detail_keranjang)) { ?>
                                    <div class="minicart-header">
                                        <div class="text-center mb-4">
                                            <img src="<?= base_url(); ?>assets/frontend/images/others/cart.png" width="180px">
                                        </div>
                                        <div>
                                            <h5 class="text-dark text-center mb-2">Keranjang Anda Kosong</h5>
                                            <p class="text-muted text-center mb-4">Coba lihat daftar produk siapa tau berminat</p>
                                        </div>
                                    </div>
                                    <div class="minicart-footer">
                                        <a href="<?= site_url('produk/data_produk_frontend'); ?>" class="ho-button ho-button-fullwidth">
                                            <span><b>LIHAT PRODUK</b></span>
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div class="minicart-header">
                                        <?php foreach ($detail_keranjang as $dk) : ?>
                                            
                                            <div class="minicart-product">
                                                <div class="minicart-productimage">
                                                    <a href="<?= site_url('produk/detail_produk_frontend/' . $dk['id_produk']); ?>">
                                                        <img src="<?= base_url('upload/foto_produk/' . $dk['foto_produk']); ?>" alt="product image" class="rounded">
                                                    </a>
                                                    <span class="minicart-productquantity"><?= $dk['kuantitas']; ?>x</span>
                                                </div>
                                                <div class="minicart-productcontent">
                                                    <h6><a href="<?= site_url('produk/detail_produk_frontend/' . $dk['id_produk']); ?>"><?= $dk['nama_produk']; ?></a></h6>
                                                    <span class="minicart-productprice">Rp<?= number_format($dk['harga_produk'], 0, ',', '.'); ?></span>
                                                </div>
                                            </div>

                                            <!-- Hitung Total Belanja -->
                                            <?php
                                            $harga_produk = $dk['harga_produk'];
                                            $kuantitas = $dk['kuantitas'];
                                            $subtotal = $harga_produk * $kuantitas;
                                            $total_belanja = $total_belanja + $subtotal;
                                            ?>

                                        <?php endforeach; ?>
                                    </div>
                                    <ul class="minicart-pricing">
                                        <li>Total Belanja<span>Rp<?= number_format($total_belanja, 0, ',', '.'); ?></span></li>
                                    </ul>
                                    <div class="minicart-footer">
                                        <a href="<?= site_url('keranjang/halaman_keranjang'); ?>" class="ho-button ho-button-fullwidth">
                                            <span>Keranjang</span>
                                        </a>
                                        <a href="<?= site_url('checkout'); ?>" class="ho-button ho-button-dark ho-button-fullwidth">
                                            <span>Checkout</span>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Bottom Area -->
    <div class="header-bottom bg-theme">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10 d-none d-lg-block">
                    <nav class="ho-navigation">
                        <ul>
                            <li class="<?= active_menu('beranda'); ?>"><a href="<?= site_url('beranda'); ?>">Beranda</a></li>
                            <li class="<?= active_menu('produk'); ?>"><a href="<?= site_url('produk/data_produk_frontend'); ?>">Produk</a></li>
                            <li class="<?= active_menu('penjual'); ?>"><a href="<?= site_url('penjual/data_penjual'); ?>">penjual</a></li>
                            <li class="<?= active_menu('tentang_warma'); ?>"><a href="<?= site_url('tentang_warma'); ?>">Tentang Kami</a></li>
                            <li class="<?= active_menu('website'); ?>"><a href="<?= site_url('website/bantuan'); ?>">Bantuan</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header-contactinfo">
                        <a href="https://api.whatsapp.com/send?phone=<?= $website['telepon']; ?>" target="_blank">
                            <i class="flaticon-support text-white"></i>
                            <span class="text-white">Hubungi Kami :</span>
                            <b class="text-white">+<?= $website['telepon']; ?></b>
                        </a>
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="mobile-menu clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</header>