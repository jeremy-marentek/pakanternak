<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('beranda'); ?>">Beranda</a></li>
                <li>penjual</li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="page-content">

    <!-- Shop Page Area -->
    <div class="shop-page-area bg-white ptb-30">
        <div class="container">
            <?= $this->session->userdata('message'); ?>
            <div class="row">

                <!-- Data penjual -->
                <div class="col-lg-8 order-1 order-lg-2">
                    <!-- Header --->
                    <div class="shop-filters">
                        <div class="shop-filters-viewmode">
                            <button class="is-active" data-view="grid"><i class="ion ion-ios-keypad"></i></button>
                            <button data-view="list"><i class="ion ion-ios-list"></i></button>
                        </div>
                        <span class="shop-filters-viewitemcount">DAFTAR penjual</span>
                        <div class="shop-filters-sortby">
                            <b>Urutkan :</b>
                            <div class="select-sortby">
                                <button class="select-sortby-current">Berdasarkan</button>
                                <ul class="select-sortby-list dropdown-list">
                                    <li><a href="<?= site_url('penjual/data_penjual/ascending'); ?>">Nama (A-Z)</a></li>
                                    <li><a href="<?= site_url('penjual/data_penjual/descending'); ?>">Nama (Z-A)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Dafta -->
                    <div class="shop-page-products mt-30">
                        <div class="row no-gutters">

                            <?php if (!$penjual) { ?>
                                <div class="col-sm-12 text-center" style="margin-top: 20px;">
                                    <img src="<?= base_url(); ?>assets/frontend/images/others/produk_empty.png" alt="" width="300px">
                                </div>
                                <div class="col-sm-12 text-center" style="margin-top: 30px; margin-bottom:8px">
                                    <h2>TIDAK ADA penjual</h2>
                                </div>
                            <?php } else { ?>
                                <?php foreach ($penjual as $p) : ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <!-- Single penjual -->
                                        <article class="hoproduct">
                                            <div class="hoproduct-image">
                                                <a class="hoproduct-thumb" href="<?= site_url('penjual/detail_penjual/' . $p['id_penjual']); ?>">
                                                    <img class="hoproduct-frontimage rounded-circle" src="<?= base_url('upload/foto_user/' . $p['foto_penjual']); ?>" alt="product image">
                                                </a>
                                            </div>
                                            <div class="hoproduct-content text-center">
                                                <h5 class="hoproduct-title"><a href="<?= site_url('penjual/detail_penjual/' . $p['id_penjual']); ?>"><?= $p['nama_penjual']; ?></a></h5>
                                                <div class="hoproduct-pricebox">
                                                    <div class="pricebox">
                                                        <!-- <span class=""><?= $p['nama_prodi']; ?></span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 order-2 order-lg-1">
                    <div class="shop-widgets">
                        <div class="single-widget widget-categories">
                            <h5 class="widget-title">PROGRAM STUDI</h5>
                            <ul class="mt-4">
                                <!-- <?php foreach ($prodi as $p) : ?>
                                    <li><a href="<?= site_url('penjual/data_penjual/prodi/' . $p['id_prodi']); ?>"><?= $p['nama_prodi']; ?> <span><?= $p['jumlah_penjual']; ?></span></a></li>
                                <?php endforeach; ?> -->
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>