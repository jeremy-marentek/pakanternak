<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detail Transaksi</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard/pembeli'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Detail Transaksi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">

            <!-- Detail Transaksi -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Detail Transaksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0 mt-0">
                                <tbody>
                                    <tr>
                                        <td>Order ID</td>
                                        <td>:&nbsp;&nbsp; <?= $transaksi['order_id']; ?></td>
                                    </tr>
                                    <?php if ($transaksi['tipe_pembayaran'] == 'cstore') { ?>
                                        <tr>
                                            <td>Kode Pembayaran</td>
                                            <td>:&nbsp;&nbsp; <?= $transaksi['kode_pembayaran']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>Metode Pembayaran</td>
                                        <td>:&nbsp;&nbsp;
                                            <!-- Jika lewat GOPAY -->
                                            <?php if ($transaksi['tipe_pembayaran'] == 'gopay') { ?>
                                                <span>GO-PAY</span>
                                            <?php } ?>

                                            <!-- Lewat CSTORE -->
                                            <?php if ($transaksi['tipe_pembayaran'] == 'cstore') { ?>
                                                <?php if ($transaksi['store'] == 'alfamart') { ?>
                                                    <span>Alfamart</span>
                                                <?php } else { ?>
                                                    <span>Indomaret</span>
                                                <?php } ?>
                                            <?php } ?>

                                            <!-- Lewat Bank Transfer -->
                                            <?php if ($transaksi['tipe_pembayaran'] == 'bank_transfer') { ?>
                                                <span>Bank Transfer - <?= $transaksi['nama_bank']; ?></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php if ($transaksi['tipe_pembayaran'] == 'bank_transfer') { ?>
                                        <tr>
                                            <td>Virtual Account</td>
                                            <td>:&nbsp;&nbsp; <?= $transaksi['va_number']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>Total Pembayaran</td>
                                        <td>:&nbsp;&nbsp; Rp<?= number_format($transaksi['total_bayar'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Pemesanan</td>
                                        <td>:&nbsp;&nbsp; <?= $transaksi['waktu_transaksi']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status Pembayaran</td>
                                        <td>:&nbsp;&nbsp;
                                            <?php if ($transaksi['status_bayar'] == 'pending') { ?>
                                                <span class="badge badge-warning">Pending</span>
                                            <?php } else if ($transaksi['status_bayar'] == 'expire') { ?>
                                                <span class="badge badge-danger">Failure</span>
                                            <?php } else if ($transaksi['status_bayar'] == 'settlement') { ?>
                                                <span class="badge badge-success">Settlement</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Cancel</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Customer Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0 wrapper">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:&nbsp;&nbsp; <?= $transaksi['nama_pelanggan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        <td>:&nbsp;&nbsp; <?= $transaksi['telepon_pelanggan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:&nbsp;&nbsp; <?= $transaksi['email_pelanggan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi</td>
                                        <td>:&nbsp;&nbsp; <?= $transaksi['kota_pelanggan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:&nbsp;&nbsp; <?= $transaksi['alamat_pelanggan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status Pesanan</td>
                                        <td>:&nbsp;&nbsp;
                                            <?php if ($transaksi['status_pesanan'] == 'Belum Bayar') { ?>
                                                <span class="badge badge-warning">Belum Bayar</span>
                                            <?php } else if ($transaksi['status_pesanan'] == 'Diproses') { ?>
                                                <span class="badge badge-primary">Diproses</span>
                                            <?php } else if ($transaksi['status_pesanan'] == 'Dikirim') { ?>
                                                <span class="badge badge-info">Dikirim</span>
                                            <?php } else if ($transaksi['status_pesanan'] == 'Selesai') { ?>
                                                <span class="badge badge-success">Selesai</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Batal</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <?php for ($i = 0; $i < count($list_penjual); $i++) { ?>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">penjual : <?= $list_penjual[$i]['nama_penjual']; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-de nowrap">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Produk</th>
                                            <th class="text-center">Harga Produk</th>
                                            <th class="text-center">Kuantitas</th>
                                            <th class="text-center">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_belanja = 0;
                                        $no = 1;
                                        for ($k = 0; $k < count($detail_keranjang); $k++) {
                                            if ($detail_keranjang[$k]['id_penjual'] == $list_penjual[$i]['id_penjual']) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td class="text-left"><?= $detail_keranjang[$k]['nama_produk']; ?></td>
                                                    <td class="text-center">Rp<?= number_format($detail_keranjang[$k]['harga_produk'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?= $detail_keranjang[$k]['kuantitas']; ?></td>

                                                    <?php
                                                    $harga_produk = $detail_keranjang[$k]['harga_produk'];
                                                    $kuantitas = $detail_keranjang[$k]['kuantitas'];
                                                    $subtotal = $harga_produk * $kuantitas;
                                                    $total_belanja = $total_belanja + $subtotal;
                                                    ?>

                                                    <td class="text-center">Rp<?= number_format($subtotal, 0, ',', '.'); ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php  } ?>
                                        <tr>
                                            <td class="font-weight-bold" colspan="4">Ongkos Kirim</td>
                                            <td class="text-center font-weight-bold">Rp<?= number_format($detail_keranjang[$i]['ongkir'], 0, ',', '.'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>