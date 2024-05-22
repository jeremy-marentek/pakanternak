<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('beranda'); ?>">Beranda</a></li>
                <li>Produk</li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="page-content">

    <!-- Shop Page Area -->
    <div class="shop-page-area bg-white ptb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-1 order-lg-2">

                    <?= $this->session->userdata('message'); ?>

                    <!-- Header --->
                    <div class="shop-filters">
                        <div class="shop-filters-viewmode">
                            <button class="is-active" data-view="grid"><i class="ion ion-ios-keypad"></i></button>
                            <button data-view="list"><i class="ion ion-ios-list"></i></button>
                        </div>
                        <span class="shop-filters-viewitemcount">DAFTAR PRODUK</span>
                        <div class="shop-filters-sortby">
                            <b>Urutkan :</b>
                            <div class="select-sortby">
                                <button class="select-sortby-current">Berdasarkan</button>
                                <ul class="select-sortby-list dropdown-list">
                                    <li><a href="<?= site_url('produk/data_produk_frontend/terbaru'); ?>">Produk Terbaru</a></li>
                                    <li><a href="<?= site_url('produk/data_produk_frontend/termurah'); ?>">Produk Termurah</a></li>
                                    <li><a href="<?= site_url('produk/data_produk_frontend/termahal'); ?>">Produk Termahal</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Produk -->
                    <div class="shop-page-products mt-30">
                        <div class="row no-gutters">

                            <?php if (!$produk) { ?>
                                <div class="col-sm-12 text-center mt-3">
                                    <img src="<?= base_url(); ?>assets/frontend/images/others/produk_empty.png" alt="" width="400px">
                                </div>
                                <div class="col-sm-12 text-center" style="margin-top: 30px;">
                                    <h2>TIDAK ADA PRODUK</h2>
                                </div>
                            <?php } else { ?>
                                <?php foreach ($produk as $p) : ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <!-- Single Product -->
                                        <article class="hoproduct">
                                            <div class="hoproduct-image">
                                                <a class="hoproduct-thumb" href="<?= site_url('produk/detail_produk_frontend/' . $p['id_produk']); ?>">
                                                    <img id="foto-produk-<?= $p['id_produk'] ?>" class="hoproduct-frontimage" src="<?= base_url('upload/foto_produk/' . $p['foto_produk']); ?>" alt="product image">
                                                </a>
                                                <ul class="hoproduct-actionbox">

                                                    <!-- <?php if ($p['nama_kategori'] == 'Jasa') { ?>

                                                    <?php } else { ?>
                                                        <!-- <li><a href="<?= site_url('keranjang/tambah_keranjang/' . $p['id_produk']); ?>"><i class="lnr lnr-cart"></i></a></li> -->
                                                    <?php } ?> -->

                                                    <!-- <li><a href="#" onclick="showDetailProduk(<?= $p['id_produk'] ?>)"><i class="lnr lnr-eye"></i></a></li> -->
                                                </ul>
                                            </div>
                                            <div class="hoproduct-content">
                                                <h5 class="hoproduct-title"><a id="nama-produk-<?= $p['id_produk'] ?>" href="<?= site_url('produk/detail_produk_frontend/' . $p['id_produk']); ?>"><?= $p['nama_produk']; ?></a></h5>
                                                <div class="hoproduct-pricebox">
                                                    <div class="pricebox">
                                                        <span class="price" id="price-produk-<?= $p['id_produk'] ?>">Rp<?= number_format($p['harga_produk'], 0, ',', '.'); ?></span>
                                                    </div>
                                                </div>
                                                <p class="hoproduct-content-description">
                                                    <!-- Kategori : <span id="nama-kategori-produk-<?= $p['id_produk'] ?>"><?= $p['nama_kategori']; ?></span><br> -->
                                                    Stok Produk : <span id="stok_produk-<?= $p['id_produk'] ?>"><?= $p['stok_produk']; ?></span> buah
                                                    <textarea style="display: none;" id="deskripsi-produk-<?= $p['id_produk'] ?>" class="is-invisible"><?= $p['deskripsi_produk'] ?></textarea>
                                                </p>
                                            </div>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="shop-widgets">
                        <div class="single-widget widget-categories">
                            <h5 class="widget-title">KATEGORI</h5>
                            <ul class="mt-4">
                                <?php foreach ($kategori as $k) : ?>
                                    <li><a href="<?= site_url('produk/data_produk_frontend/kategori/' . $k['id_kategori']) ?>"><?= $k['nama_kategori']; ?> <span><?= $k['jumlah_produk']; ?></span></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>