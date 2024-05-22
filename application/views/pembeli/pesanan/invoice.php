<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Invoice</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard/pembeli'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Invoice</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="container" id="printTable">
                <div>
                    <div class="card">
                        <div class="row invoice-contact">
                            <div class="col-md-8">
                                <div class="invoice-box row">
                                    <div class="col-sm-12">
                                        <table class="table table-responsive invoice-table table-borderless p-l-20">
                                            <tbody>
                                                <tr>
                                                    <td><a href="index.html" class="b-brand">
                                                            <img class="img-fluid" src="<?= base_url('assets/frontend/images/logo/logo-warma-blue.png'); ?>" alt="Able pro Logo" width="200px">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Wareong penjual Universitas CIC</td>
                                                </tr>
                                                <tr>
                                                    <td>Jalan Kesambi, No.202</td>
                                                </tr>
                                                <tr>
                                                    <td><a class="text-secondary" href="mailto:demo@gmail.com" target="_top">bkmcic.official@gmail.com</a></td>
                                                </tr>
                                                <tr>
                                                    <td>+6289660979061</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="card-body">
                            <div class="row invoive-info">
                                <div class="col-md-4 col-xs-12 invoice-client-info">
                                    <h6>Customer Information :</h6>
                                    <h6 class="m-0"><?= $transaksi['nama_pelanggan']; ?></h6>
                                    <p class="m-0 m-t-10"><?= $transaksi['kota_pelanggan']; ?></p>
                                    <p class="m-0">+<?= $transaksi['telepon_pelanggan']; ?></p>
                                    <p><a class="text-secondary" href="mailto:demo@gmail.com" target="_top"><?= $transaksi['email_pelanggan']; ?></a></p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <h6>Order Information :</h6>
                                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>Tanggal</th>
                                                <td>: <?= $transaksi['waktu_transaksi']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>:
                                                    <span class="label label-warning"><?= $transaksi['status_pesanan']; ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Id</th>
                                                <td>
                                                    : #<?= $transaksi['id_transaksi']; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <h6 class="m-b-20">Invoice Number <span>#<?= $transaksi['order_id']; ?></span></h6>
                                    <h6 class="text-uppercase text-primary">Total Bayar :
                                        <span>Rp<?= number_format($transaksi['total_bayar'], 0, ',', '.'); ?></span>
                                    </h6>
                                </div>
                            </div>

                            <?php for ($i = 0; $i < count($list_penjual); $i++) { ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6>penjual : <?= $list_penjual[$i]['nama_penjual']; ?></h6>
                                        <div class="table-responsive">
                                            <table class="table invoice-detail-table">
                                                <thead>
                                                    <tr class="thead-default">
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Nama Produk</th>
                                                        <th class="text-center">Harga Produk</th>
                                                        <th class="text-center">Kuantitas</th>
                                                        <th class="text-center">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total_bayar = 0;
                                                    $no = 1;
                                                    for ($k = 0; $k < count($detail_keranjang); $k++) {
                                                        if ($detail_keranjang[$k]['id_penjual'] == $list_penjual[$i]['id_penjual']) { ?>
                                                            <tr>
                                                                <td class="text-center"><?= $no++; ?></td>
                                                                <td class="text-center"><?= $detail_keranjang[$k]['nama_produk']; ?></td>
                                                                <td class="text-center">Rp<?= number_format($detail_keranjang[$k]['harga_produk'], 0, ',', '.'); ?></td>
                                                                <td class="text-center"><?= $detail_keranjang[$k]['kuantitas']; ?></td>

                                                                <?php
                                                                $harga_produk = $detail_keranjang[$k]['harga_produk'];
                                                                $kuantitas = $detail_keranjang[$k]['kuantitas'];
                                                                $subtotal = $harga_produk * $kuantitas;
                                                                $total_bayar = $total_bayar + $subtotal;
                                                                ?>

                                                                <td class="text-center">Rp<?= number_format($subtotal, 0, ',', '.'); ?></td>
                                                            </tr>

                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php
                                                    $total_bayar = $total_bayar + $ongkir['ongkir'];
                                                    ?>

                                                    <tr>
                                                        <td class="font-weight-bold" colspan="4">Ongkos Kirim</td>
                                                        <td class="text-center font-weight-bold">Rp<?= number_format($detail_keranjang[$i]['ongkir'], 0, ',', '.'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold" colspan="4">Total</td>
                                                        <td class="text-center font-weight-bold">Rp<?= number_format($total_bayar, 0, ',', '.'); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <br>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h6>Keterangan :</h6>
                                    <p>Invoice ini digunakan sebagai barang bukti kepada penjual ataupun pihak waroeng penjual setelah melakukan pemesanan. Kami juga mengirimkan invoice ini ke email anda agar lebih memudahkan melihat invoice.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>