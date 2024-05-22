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

        <?php if ($this->uri->segment(3) == 'diproses' ? 'active' : '') { ?>
            <div class="alert alert-success">Harap segera memproses pengiriman!</div>
        <?php } ?>

        <!-- Main Content -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="nav nav-pills" role="tablist">
                            <a href="<?= site_url('pesanan/daftar_pesanan_penjual/all'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'all' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_penjual'); ?>">Daftar Pesanan</a>
                            <a href="<?= site_url('pesanan/daftar_pesanan_penjual/belum_bayar'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'belum_bayar' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_penjual'); ?>">Belum Bayar</a>
                            <a href="<?= site_url('pesanan/daftar_pesanan_penjual/diproses'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'diproses' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_penjual'); ?>">Diproses</a>
                            <a href="<?= site_url('pesanan/daftar_pesanan_penjual/dikirim'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'dikirim' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_penjual'); ?>">Dikirim</a>
                            <a href="<?= site_url('pesanan/daftar_pesanan_penjual/selesai'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'selesai' ? 'active' : ''; ?><?= active_menu('pesanan/daftar_pesanan_penjual'); ?>">Selesai</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Pesanan</h5>
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
                                            <td class="align-middle text-center"><?= $t['waktu_transaksi']; ?></td>

                                            <!-- Nama Pelanggan -->
                                            <td class="align-middle text-center"><?= $t['nama_pelanggan']; ?></td>

                                            <!-- Total Bayar -->
                                            <td class="align-middle text-center">Rp<?= number_format($t['total_bayar'], 0, ',', '.'); ?></td>


                                            <!-- Status Pembayaran -->
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

                                            <!-- Button Action -->
                                            <td class="align-middle text-center">
                                                <a href="<?= site_url('pesanan/detail_pesanan_penjual/' . $t['order_id']); ?>" class="btn btn-sm btn-info rounded"><i class="feather icon-eye"></i> Detail</a>
                                                <?php if ($this->uri->segment(3) == 'diproses' ? 'active' : '') { ?>
                                                    <?php if ($t['kota_pelanggan'] == "Kampus Universitas CIC (Bertemu di Kampus)") { ?>
                                                        <a href="<?= site_url('pesanan/input_pengiriman_noresi/' . $t['order_id']); ?>" class="btn btn-sm btn-success rounded tombol-kirim"><i class="feather icon-navigation"></i> Kirim</a>
                                                    <?php } else { ?>
                                                        <a href="<?= site_url('pesanan/input_pengiriman/' . $t['order_id']); ?>" class="btn btn-sm btn-success rounded"><i class="feather icon-navigation"></i> Kirim</a>
                                                    <?php } ?>
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