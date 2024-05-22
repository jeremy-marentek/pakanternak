<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard/penjual'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <a href="<?= site_url('penjualan/info_penjualan'); ?>">
                    <div class="card widget-statstic-card">
                        <div class="card-body">
                            <div class="card-header-left mb-3">
                                <h5 class="mb-0">Penghasilan</h5>
                            </div>
                            <i class="feather icon-award st-icon bg-c-blue txt-lite-color"></i>
                            <div class="text-left">
                                <h3 class="d-inline-block text-c-blue">Rp<?= number_format($penghasilan, 0, ',', '.'); ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a href="<?= site_url('pesanan/daftar_pesanan_penjual/all'); ?>">
                    <div class="card widget-statstic-card">
                        <div class="card-body">
                            <div class="card-header-left mb-3">
                                <h5 class="mb-0">Pesanan</h5>
                            </div>
                            <i class="feather icon-shopping-cart st-icon bg-c-green"></i>
                            <div class="text-left">
                                <h3 class="d-inline-block text-c-green"><?= $jml_pesanan; ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a href="<?= site_url('pesanan/daftar_pesanan_penjual/belum_bayar'); ?>">
                    <div class="card widget-statstic-card">
                        <div class="card-body">
                            <div class="card-header-left mb-3">
                                <h5 class="mb-0">Belum Bayar</h5>
                            </div>
                            <i class="feather icon-user st-icon bg-c-red txt-lite-color"></i>
                            <div class="text-left">
                                <h3 class="d-inline-block text-c-red"><?= $belum_bayar; ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-12 col-xl-3">
                <a href="<?= site_url('pesanan/daftar_pesanan_penjual/diproses'); ?>">
                    <div class="card widget-statstic-card">
                        <div class="card-body">
                            <div class="card-header-left mb-3">
                                <h5 class="mb-0">Produk Terjual</h5>
                            </div>
                            <i class="feather icon-shopping-cart st-icon bg-c-yellow"></i>
                            <div class="text-left">
                                <h3 class="d-inline-block text-warning"><?= $produk_terjual; ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Pesanan Masuk</h6>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Metode Pembayaran</th>
                                        <th class="text-center">Tanggal & Waktu</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th class="text-center">Total Bayar</th>
                                        <th class="text-center">Status</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaksi as $t) : ?>
                                        <tr>
                                            <!-- Order -->
                                            <td class="text-center align-middle"><?= $t['order_id']; ?></td>

                                            <!-- Metode Pembayaran -->
                                            <td class="align-middle text-center">
                                                <?php if ($t['tipe_pembayaran'] == 'gopay') { ?>
                                                    <span>GO-PAY</span>
                                                <?php } ?>

                                                <?php if ($t['tipe_pembayaran'] == 'cstore') { ?>
                                                    <?php if ($t['store'] == 'alfamart') { ?>
                                                        <span>Alfamart</span>
                                                    <?php } else { ?>
                                                        <span>Indomaret</span>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if ($t['tipe_pembayaran'] == 'bank_transfer') { ?>
                                                    <span>Bank Transfer</span>
                                                <?php } ?>
                                            </td>

                                            <!-- Waktu Transaksi -->
                                            <td class="align-middle text-center"><?= $t['waktu_transaksi']; ?></td>

                                            <!-- Nama Pelanggan -->
                                            <td class="align-middle text-center"><?= $t['nama_pelanggan']; ?></td>

                                            <!-- Total Bayar -->
                                            <td class="align-middle text-center"><?= number_format($t['total_bayar'], 0, ',', '.'); ?></td>

                                            <!-- Status Pesanan -->
                                            <td class="align-middle text-center">
                                                <?php if ($t['status_pesanan'] == 'Belum Bayar') { ?>
                                                    <span class="badge badge-warning">Belum Bayar</span>
                                                <?php } else if ($t['status_pesanan'] == 'Diproses') { ?>
                                                    <span class="badge badge-primary">Diproses</span>
                                                <?php } else if ($t['status_pesanan'] == 'Dikirim') { ?>
                                                    <span class="badge badge-info">Dikirim</span>
                                                <?php } else if ($t['status_pesanan'] == 'Selesai') { ?>
                                                    <span class="badge badge-success">Selesai</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger">Batal</span>
                                                <?php } ?>
                                            </td>

                                            <!-- Button Detail -->
                                            <td class="align-middle text-center">
                                                <a href="<?= site_url('pesanan/detail_pesanan_penjual/' . $t['order_id']); ?>" class="btn btn-sm btn-info rounded"><i class="feather icon-eye"></i> Detail</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>