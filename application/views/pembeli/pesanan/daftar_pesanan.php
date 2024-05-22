<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Pesanan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard/penjual'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Pesanan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->session->userdata('message'); ?>

        <?php if ($this->uri->segment(3) == 'dikirim' ? 'active' : '') { ?>
            <div class="alert alert-success">Harap konfirmasi apabila barang yang dikirim telah sampai ditempat tujuan</div>
        <?php } ?>

        <!-- Main Content -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="nav nav-pills" role="tablist">
                            <a href="<?= site_url('pesanan/daftar_pesanan_pembeli/all'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'all' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_pembeli'); ?>">Daftar Pesanan</a>
                            <a href="<?= site_url('pesanan/daftar_pesanan_pembeli/belum_bayar'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'belum_bayar' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_pembeli'); ?>">Belum Bayar</a>
                            <a href="<?= site_url('pesanan/daftar_pesanan_pembeli/diproses'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'diproses' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_pembeli'); ?>">Diproses</a>
                            <a href="<?= site_url('pesanan/daftar_pesanan_pembeli/dikirim'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'dikirim' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_pembeli'); ?>">Dikirim</a>
                            <a href="<?= site_url('pesanan/daftar_pesanan_pembeli/selesai'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'selesai' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_pembeli'); ?>">Selesai</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Metode Pembayaran</th>
                                        <th class="text-center">Tanggal dan Waktu</th>
                                        <th class="text-center">Total Bayar</th>
                                        <th class="text-center">Status Pesanan</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaksi as $t) : ?>
                                        <tr>

                                            <!-- Order ID -->
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
                                            <td class="align-middle text-center"><?= $t['waktu_transaksi']; ?>
                                            </td>

                                            <!-- Total Bayar -->
                                            <td class="align-middle text-center">Rp<?= number_format($t['total_bayar'], 0, ',', '.'); ?></td>

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
                                            <td class="align-middle text-center">
                                                <a href="<?= site_url('pesanan/invoice/' . $t['order_id']); ?>" class="btn btn-sm btn-primary rounded"><i class="feather icon-file"></i> Invoice</a>
                                                <a href="<?= site_url('pesanan/detail_pesanan_pembeli/' . $t['order_id']); ?>" class="btn btn-sm btn-info rounded"><i class="feather icon-eye"></i> Detail</a>
                                                <?php if ($this->uri->segment(3) == 'dikirim' ? 'active' : '') { ?>
                                                    <a href="<?= site_url('pesanan/konfirmasi_barang/' . $t['order_id']); ?>" class="btn btn-sm btn-success rounded tombol-konfirmasi"><i class="feather icon-check-circle"></i> Konfirmasi</a>
                                                <?php } else if ($this->uri->segment(3) == 'belum_bayar' ? 'active' : '') { ?>
                                                    <a href="<?= site_url('pesanan/cancel_pesanan/' . $t['order_id']); ?>" class="btn btn-sm btn-danger rounded tombol-cancel"><i class="feather icon-x-circle"></i> Cancel</a>
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