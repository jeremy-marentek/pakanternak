<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Transaksi</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Transaksi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="nav nav-pills" role="tablist">
                            <a href="<?= site_url('transaksi/data_transaksi/all'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'all' ? 'active' : ''; ?><?= active_menu('transaksi/data_transaksi'); ?>">All Transaction</a>
                            <a href="<?= site_url('transaksi/data_transaksi/settlement'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'settlement' ? 'active' : ''; ?><?= active_menu('transaksi/data_transaksi'); ?>">Settlement</a>
                            <a href="<?= site_url('transaksi/data_transaksi/pending'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'pending' ? 'active' : ''; ?><?= active_menu('transaksi/data_transaksi'); ?>">Pending</a>
                            <a href="<?= site_url('transaksi/data_transaksi/failure'); ?>" class="nav-link <?php echo $this->uri->segment(3) == 'failure' ? 'active' : ''; ?><?= active_menu('transaksi/data_transaksi'); ?>">Failure</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Data Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Metode Pembayaran</th>
                                        <th class="text-center">Tanggal & Waktu</th>
                                        <th class="text-center">Total Pembayaran</th>
                                        <th class="text-center">Status</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaksi as $t) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $t['order_id']; ?></td>
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
                                            <td class="align-middle text-center"><?= $t['waktu_transaksi']; ?></td>
                                            <td class="align-middle text-center">Rp<?= number_format($t['total_bayar'], 0, ',', '.'); ?></td>
                                            <td class="align-middle text-center">
                                                <?php if ($t['status_bayar'] == 'pending') { ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                <?php } else if ($t['status_bayar'] == 'expire') { ?>
                                                    <span class="badge badge-danger">Failure</span>
                                                <?php } else if ($t['status_bayar'] == 'settlement') { ?>
                                                    <span class="badge badge-success">Settlement</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger">Cancel</span>
                                                <?php } ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="<?= site_url('transaksi/detail_transaksi/' . $t['order_id']); ?>" class="btn btn-sm btn-info rounded"><i class="feather icon-eye"></i> Detail</a>
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