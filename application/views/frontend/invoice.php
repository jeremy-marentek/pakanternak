<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('beranda'); ?>">Beranda</a></li>
                <li>Invoice</li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="page-content">
    <div class="shop-page-area bg-white ptb-30">
        <div class="container">
            <div class="container">
                <div class="col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-warma-blue.png" alt="" width="200px">
                        </div>
                        <div class="row mb-0">

                            <!-- Pembayaran -->
                            <div class="col-sm-6">
                                <div class="card-body">
                                    <?php if ($transaksi->tipe_pembayaran == 'cstore') { ?>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless mb-0" style="border-style: none;">
                                                <tbody>
                                                    <tr>
                                                        <td>Order ID</td>
                                                        <td>:&nbsp;&nbsp;<?= $transaksi->order_id; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal</td>
                                                        <td>:&nbsp;&nbsp;<?= date('d M Y'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Pembayaran</td>
                                                        <td>:&nbsp;&nbsp;
                                                            <?php if ($transaksi->status_bayar == 'settlement') { ?>
                                                                <span>Settlement</span>
                                                            <?php } else if ($transaksi->status_bayar == 'pending') { ?>
                                                                <span>Belum Bayar</span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Metode Pembayaran</td>
                                                        <td>:&nbsp;&nbsp;
                                                            <?php if ($transaksi->store == 'alfamart') { ?>
                                                                <span>Alfamart</span>
                                                            <?php } else { ?>
                                                                <span>Indomaret</span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kode Pembayaran</td>
                                                        <td>:&nbsp;&nbsp;
                                                            <?= $transaksi->kode_pembayaran; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } else { ?>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless mb-0" style="border-style: none;">
                                                <tbody>
                                                    <tr>
                                                        <td>Order ID</td>
                                                        <td>:&nbsp;&nbsp;<?= $transaksi->order_id; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal</td>
                                                        <td>:&nbsp;&nbsp;<?= date('d M Y'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Pembayaran</td>
                                                        <td>:&nbsp;&nbsp;
                                                            <?php if ($transaksi->status_bayar == 'settlement') { ?>
                                                                <span>Settlement</span>
                                                            <?php } else if ($transaksi->status_bayar == 'pending') { ?>
                                                                <span>Belum Bayar</span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Metode Pembayaran</td>
                                                        <td>:&nbsp;&nbsp;

                                                            <?php if ($transaksi->tipe_pembayaran == 'gopay') { ?>
                                                                <span>GO-PAY</span>
                                                            <?php } else if ($transaksi->tipe_pembayaran == 'bank_transfer') { ?>
                                                                <span>Bank Transfer</span>
                                                            <?php } else { ?>
                                                                <span>Kartu Kredit</span>
                                                            <?php } ?>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Tujuan Pengiriman -->
                            <div class="col-sm-6">
                                <div class="card-body">
                                    <ul class="font-weight-bold">Tujuan Pengiriman</ul>
                                    <ul><?= $transaksi->nama_pelanggan; ?></ul>
                                    <ul><?= $transaksi->alamat_pelanggan; ?> - <?= $transaksi->kota_pelanggan; ?></ul>
                                    <ul><?= $transaksi->telepon_pelanggan; ?></ul>
                                </div>
                            </div>

                            <!-- Detail Item -->
                            <div class="col-sm-12">
                                <div class="card-body border-top">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-de nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Nama Produk</th>
                                                    <th>Harga Produk</th>
                                                    <th class="text-center">Kuantitas</th>
                                                    <th class="text-center">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $total_bayar = 0;
                                                foreach ($item as $i) : ?>
                                                    <tr>
                                                        <td class="align-middle"><?= $i['nama_produk']; ?></td>
                                                        <td class="align-middle text-center"><?= $i['harga_produk']; ?></td>
                                                        <td class="align-middle text-center"><?= $i['kuantitas']; ?></td>

                                                        <?php
                                                        $harga = $i['harga_produk'];
                                                        $kuantitas = $i['kuantitas'];
                                                        $subtotal = $harga * $kuantitas;
                                                        $total_bayar = $total_bayar + $subtotal;
                                                        ?>

                                                        <td class="align-middle text-center">Rp<?= number_format($subtotal, 0, ',', '.'); ?></td>
                                                    </tr>

                                                <?php endforeach; ?>

                                                <?php
                                                $total_bayar = $total_bayar + $transaksi->jumlah_ongkir;
                                                ?>

                                                <tr>
                                                    <td class="font-weight-bold" colspan="3">Ongkos Kirim</td>
                                                    <td class="text-center font-weight-bold">Rp<?= $transaksi->jumlah_ongkir; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold" colspan="3">Total Bayar</td>
                                                    <td class="text-center font-weight-bold">Rp<?= number_format($total_bayar, 0, ',', '.'); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button -->
                    <a href="<?= site_url('pesanan/daftar_pesanan_pembeli/all'); ?>">
                        <button class="ho-button col-sm-12 mt-3">Lihat Pesanan</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>