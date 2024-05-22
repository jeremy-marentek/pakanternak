<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detail penjualan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Detail penjualan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="thumbnail">
                            <div class="thumb">
                                <a href="<?= base_url('upload/foto_produk/' . $produk['foto_produk']); ?>" data-lightbox="1">
                                    <img src="<?= base_url('upload/foto_produk/' . $produk['foto_produk']); ?>" alt="" class="img-fluid" width="500px" style="object-fit: cover">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Detail Produk</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td>Nama Produk</td>
                                        <td>:&nbsp;&nbsp;<?= $produk['nama_produk']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama penjual</td>
                                        <td>:&nbsp;&nbsp;<?= $produk['nama_kategori']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Produk</td>
                                        <td>:&nbsp;&nbsp;Rp<?= number_format($produk['harga_produk'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Stok Produk</td>
                                        <td>:&nbsp;&nbsp;<?= number_format($produk['stok_produk'], 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Info penjualan</h6>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Metode Pembayaran</th>
                                        <th class="text-center">Tanggal & Waktu</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th class="text-center">Total Bayar</th>
                                        <th class="text-center">Status Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penjualan as $p) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $p['order_id']; ?></td>
                                            <td class="align-middle text-center">
                                                <?php if ($p['tipe_pembayaran'] == 'gopay') { ?>
                                                    <span>GO-PAY</span>
                                                <?php } ?>

                                                <?php if ($p['tipe_pembayaran'] == 'cstore') { ?>
                                                    <?php if ($p['store'] == 'alfamart') { ?>
                                                        <span>Alfamart</span>
                                                    <?php } else { ?>
                                                        <span>Indomaret</span>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if ($p['tipe_pembayaran'] == 'bank_transfer') { ?>
                                                    <span>Bank Transfer</span>
                                                <?php } ?>
                                            </td>
                                            <td class="align-middle text-center"><?= $p['waktu_transaksi']; ?></td>
                                            <td class="align-middle text-center"><?= $p['nama_pelanggan']; ?></td>
                                            <td class="align-middle text-center">Rp<?= number_format($p['total_bayar'], 0, ',', '.'); ?></td>
                                            <td class="align-middle text-center">
                                                <?php if ($p['status_pesanan'] == 'Belum Bayar') { ?>
                                                    <span class="badge badge-warning">Belum Bayar</span>
                                                <?php } else if ($p['status_pesanan'] == 'Diproses') { ?>
                                                    <span class="badge badge-primary">Diproses</span>
                                                <?php } else if ($p['status_pesanan'] == 'Dikirim') { ?>
                                                    <span class="badge badge-info">Dikirim</span>
                                                <?php } else if ($p['status_pesanan'] == 'Selesai') { ?>
                                                    <span class="badge badge-success">Selesai</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger">Batal</span>
                                                <?php } ?>
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