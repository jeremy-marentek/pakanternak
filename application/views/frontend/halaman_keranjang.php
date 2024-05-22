<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('beranda'); ?>">Beranda</a></li>
                <li>Keranjang</li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="page-content">
    <!-- <form action="" method="POST"> -->
    <div class="cart-page-area ptb-30 bg-white">
        <div class="container">
            <?= $this->session->userdata('message'); ?>
            <div class="dt-responsive table-responsive">
                <table id="keranjang" class="table table-de nowrap">
                    <thead>
                        <tr>
                            <th width="3%">No</th>
                            <th width="10%" class="text-center">Foto</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Nama penjual</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center" width="15%">Kuantitas</th>
                            <th class="text-center">Subtotal</th>
                            <th width="8%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $total_bayar = 0;
                        $no = 1;
                        ?>

                        <?php foreach ($keranjang as $k) : ?>
                            <tr>
                                <!-- Nomor -->
                                <td class="align-middle"><?= $no++; ?></td>

                                <!-- Foto Produk -->
                                <td class="align-middle text-center">
                                    <img src="<?= base_url('upload/foto_produk/' . $k['foto_produk']); ?>" alt="contact-img" title="contact-img" class="rounded" height="70" width="70" style="object-fit: cover">
                                </td>

                                <!-- Nama Produk -->
                                <td class="align-middle text-center"><?= $k['nama_produk']; ?></td>

                                <!-- Nama penjual -->
                                <td class="align-middle text-center"><?= $k['nama_penjual']; ?></td>

                                <!-- Harga Produk -->
                                <td class="align-middle text-center">Rp<?= number_format($k['harga_produk'], 0, ',', '.'); ?></td>

                                <!-- Kuantitas -->
                                <td class="align-middle text-center">
                                    <form method="POST" action="<?= site_url('keranjang/update_kuantitas/' . $k['id_detail']) ?>" id="detail-keranjang-<?= $k['id_detail'] ?>">
                                        <input type="hidden" name="id_produk" value="<?= $k['id_produk']; ?>">
                                        <input onchange="updateKuantitas(<?= $k['id_detail'] ?>)" type="number" class="text-center" name="kuantitas" value="<?= $k['kuantitas']; ?>" min="1" step="1" class="c-input-text qty text">
                                    </form>
                                </td>

                                <!-- Subtotal -->
                                <td class="align-middle text-center">

                                    <!-- Hitung Subtotal dan Total Belanja -->
                                    <?php
                                    $harga_produk = $k['harga_produk'];
                                    $kuantitas = $k['kuantitas'];
                                    $subtotal = $harga_produk * $kuantitas;
                                    $total_bayar = $total_bayar + $subtotal;
                                    ?>
                                    <span id="subtotal" name="subtotal">Rp<?= number_format($subtotal, 0, ',', '.'); ?></span>
                                </td>

                                <!-- Hapus Produk -->
                                <td class="align-middle text-center">
                                    <a href="<?= site_url('keranjang/hapus_produk/' . $k['id_detail']); ?>" class="btn btn-sm btn-secondary rounded text-white" onclick="return confirm('Apakah produk ingin dihapus?')"><i class="lnr lnr-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="cart-content">
                <div class="row justify-content-between">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="cart-content-left">
                            <div class="ho-buttongroup">
                                <a href="<?= site_url('produk/data_produk_frontend'); ?>" class="ho-button ho-button-sm">
                                    <span>Lanjutkan Belanja</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="cart-content-right">
                            <!-- <h4>TOTAL BELANJA</h4>
                            <h1 class="text-primary" id="total">Rp<?= number_format($total_bayar, 0, ',', '.'); ?></h1> -->
                            <a href="<?= site_url('checkout'); ?>">
                                <button class="ho-button">
                                    <span>Checkout</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </form> -->
</main>