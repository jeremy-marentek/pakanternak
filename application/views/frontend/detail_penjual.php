<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('beranda'); ?>">Beranda</a></li>
                <li>Detail penjual</li>
            </ul>
        </div>
    </div>
</div>

<!-- Page Conttent -->
<main class="page-content">

    <!-- Product Details Area -->
    <div class="product-details-area bg-white ptb-30">
        <div class="container">

            <?= $this->session->userdata('message'); ?>

            <div class="row">
                <!-- Profile -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="text-center">
                                        <img src="<?= base_url('upload/foto_user/' . $penjual['foto_penjual']); ?>" alt="" class="img-fluid rounded-circle mt-2" width="100px" style="object-fit: cover;">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="mb-2 mt-2"><?= $penjual['nama_penjual']; ?></h5>
                                    <p></p>
                                    <a href="https://api.whatsapp.com/send?phone=<?= $penjual['telepon_penjual']; ?>&text=Hai,%20saya%20ingin%20bertanya%20tentang%20produk%20yang%20anda%20jual" class="btn btn-sm btn-success text-white mb-0" target="_blank">Chat penjual</a>
                                </div>
                            </div>
                            <div class="border-top" style="margin-top: 30px;">
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless mb-0" style="border-style: none;">
                                        <tbody>
                                            <tr>
                                                <!-- <td width="34%">Fakultas</td>
                                                <td>:&nbsp;&nbsp;<?= $penjual['nama_fakultas']; ?></td> -->
                                            </tr>
                                            <tr>
                                                <!-- <td width="34%">Prodi</td>
                                                <td>:&nbsp;&nbsp;<?= $penjual['nama_prodi']; ?></td> -->
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:&nbsp;&nbsp;<?= $penjual['email_penjual']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Telepon</td>
                                                <td>:&nbsp;&nbsp;<?= $penjual['telepon_penjual']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bergabung</td>
                                                <td>:&nbsp;&nbsp;<?= date('d M Y', strtotime($penjual['tanggal_daftar'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:&nbsp;&nbsp;<?= $penjual['alamat_penjual']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk -->
                <div class="col-sm-8">
                    <div class="shop-filters">
                        <div class="shop-filters-viewmode">
                            <button class="is-active" data-view="grid"><i class="ion ion-ios-keypad"></i></button>
                            <button data-view="list"><i class="ion ion-ios-list"></i></button>
                        </div>
                        <span class="shop-filters-viewitemcount">DAFTAR PRODUK</span>
                        <div class="shop-filters-sortby">
                        </div>
                    </div>
                    <div class="shop-page-products mt-30">
                        <div class="row no-gutters">

                            <?php if (!$produk) { ?>
                                <div class="col-sm-12 text-center mt-3">
                                    <img src="<?= base_url(); ?>assets/frontend/images/others/produk_empty.png" alt="" width="300px">
                                </div>
                                <div class="col-sm-12 text-center" style="margin-top: 30px;">
                                    <h2>BELUM ADA PRODUK :(</h2>
                                </div>
                            <?php } else { ?>
                                <?php foreach ($produk as $p) : ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <article class="hoproduct">
                                            <div class="hoproduct-image">
                                                <a class="hoproduct-thumb" href="<?= site_url('produk/detail_produk_frontend/' . $p['id_produk']); ?>">
                                                    <img id="foto-produk-<?= $p['id_produk'] ?>" class="hoproduct-frontimage" src="<?= base_url('upload/foto_produk/' . $p['foto_produk']); ?>" alt="product image">
                                                </a>
                                                <ul class="hoproduct-actionbox">
                                                    <!-- <li><a href="<?= site_url('keranjang/tambah_keranjang/' . $p['id_produk']); ?>"><i class="lnr lnr-cart"></i></a></li>
                                                    <li><a href="#" onclick="showDetailProduk(<?= $p['id_produk'] ?>)"><i class="lnr lnr-eye"></i></a></li> -->
                                                </ul>
                                            </div>
                                            <div class="hoproduct-content">
                                                <h5 class="hoproduct-title"><a id="nama-produk-<?= $p['id_produk'] ?>" href="<?= site_url('produk/detail_produk_frontend/' . $p['id_produk']); ?>"><?= $p['nama_produk']; ?></a></h5>
                                                <div class="hoproduct-pricebox">
                                                    <div class="pricebox">
                                                        <span class="price" id="price-produk-<?= $p['id_produk'] ?>">Rp <?= number_format($p['harga_produk'], 0, ',', '.'); ?></span>
                                                    </div>
                                                </div>
                                                <p class="hoproduct-content-description">
                                                    Kategori : <span id="nama-kategori-produk-<?= $p['id_produk'] ?>"><?= $p['nama_kategori']; ?></span><br>
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
            </div>
        </div>
    </div>
</main>