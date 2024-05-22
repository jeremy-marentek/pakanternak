<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('beranda'); ?>">Beranda</a></li>
                <li>Status Pesanan</li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="page-content">
    <div class="shop-page-area bg-white ptb-30">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <div class="text-center">
                        <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-warma-blue.png" alt="" width="200px" class="mt-3">
                        <div class="card mt-30">
                            <div class="card-body">
                                <?php if ($transaksi->tipe_pembayaran == 'cstore') { ?>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless mb-0" style="border-style: none;">
                                            <tbody>
                                                <tr>
                                                    <td>Kode Pembayaran</td>
                                                    <td>:&nbsp;&nbsp;<?= $transaksi->kode_pembayaran; ?></td>
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
                                                    <td>Tipe Pembayaran</td>
                                                    <td>:&nbsp;&nbsp;
                                                        <?php if ($transaksi->store == 'alfamart') { ?>
                                                            <span>Alfamart</span>
                                                        <?php } else { ?>
                                                            <span>Indomaret</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Total Pembayaran</td>
                                                    <td>:&nbsp;&nbsp;Rp<?= number_format($transaksi->total_bayar, 0, ',', '.'); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless mb-0" style="border-style: none;">
                                            <tbody>
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
                                                    <td>Jenis Pembayaran</td>
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
                                                <tr>
                                                    <td>Total Pembayaran</td>
                                                    <td>:&nbsp;&nbsp;Rp<?= number_format($transaksi->total_bayar, 0, ',', '.'); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
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
    </div>
</main>