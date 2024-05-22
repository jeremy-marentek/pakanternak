<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Penghasilan penjual</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Penghasilan penjual</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-sm-12">

                <!-- Filter -->
                <div class="card">
                    <div class="card-header">
                        <h5>Filter Data</h5>
                    </div>

                    <div class="card-body">
                        <form action="<?= site_url('penjualan/penghasilan_penjual'); ?>" method="GET">
                            <div class="row mx-auto">
                                <div class="col-sm-5">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Awal</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="tgl_awal" name="tgl_awal">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>penjual</h5>
                        <div class="card-header-right">
                            <form method="GET" target="_blank" action="<?php echo site_url('penjualan/print_penghasilan_penjual/') ?>">
                                <input type="hidden" name="tgl_awal" value="<?= $tgl_awal; ?>">
                                <input type="hidden" name="tgl_akhir" value="<?= $tgl_akhir; ?>">
                                <button type="submit" class="btn btn-primary">
                                    <i class="feather icon-printer"></i>&nbsp;&nbsp; Print
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center">Nama penjual</th>
                                        <th class="text-center">Program Studi</th>
                                        <th class="text-center">Telepon</th>
                                        <th class="text-center">Penghasilan</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($penghasilan) > 0) : ?>
                                        <?php
                                        $no = 1;
                                        $total_penghasilan = 0;
                                        foreach ($penghasilan as $p) : ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $no++; ?></td>
                                                <td class="align-middle text-center">
                                                    <img src="<?= base_url('upload/foto_user/' . $p['foto_penjual']); ?>" alt="contact-img" title="contact-img" class="img-radius mr-3" height="48" width="48" style="object-fit: cover">
                                                </td>
                                                <td class="align-middle"><?= $p['nim']; ?></td>
                                                <td class="align-middle text-center"><?= $p['nama_penjual']; ?></td>
                                                <td class="align-middle"><?= $p['nama_prodi']; ?></td>
                                                <td class="align-middle"><?= $p['telepon_penjual']; ?></td>

                                                <td class="align-middle text-center">Rp<?= number_format($p['total_penghasilan'], 0, ',', '.'); ?></td>
                                                <td class="align-middle text-center">
                                                    <a href="<?= site_url('penjualan/detail_penghasilan'); ?>/<?= $p['id_penjual']; ?>" class="btn btn-sm btn-info rounded"><i class="feather icon-eye"></i> Detail</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>