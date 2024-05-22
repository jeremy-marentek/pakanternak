<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">penjual</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">penjual</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->session->userdata('message'); ?>

        <!-- Main Content -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>penjual</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="5%">Foto</th>
                                        <th>NIM</th>
                                        <th>Nama penjual</th>
                                        <th>Program Studi</th>
                                        <th>Telepon</th>
                                        <th class="text-center">Status</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($penjual as $m) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $no++; ?></td>
                                            <td class="align-middle text-center">
                                                <img src="<?= base_url('upload/foto_user/' . $m['foto_penjual']); ?>" alt="contact-img" title="contact-img" class="img-radius mr-3" height="48" width="48" style="object-fit: cover">
                                            </td>
                                            <td class="align-middle"><?= $m['nim']; ?></td>
                                            <td class="align-middle"><?= $m['nama_penjual']; ?></td>
                                            <td class="align-middle"><?= $m['nama_prodi']; ?></td>
                                            <td class="align-middle"><?= $m['telepon_penjual']; ?></td>
                                            <td class="align-middle text-center">
                                                <?php if ($m['status_aktif'] == 1) { ?>
                                                    <a href="<?= site_url('akun/nonaktifkan_statusakun_penjual/' . $m['id_penjual']); ?>" class="badge badge-success tombol-nonaktif">Aktif</a>
                                                <?php } else { ?>
                                                    <a href="<?php echo site_url('akun/aktifkan_statusakun_penjual/' . $m['id_penjual']); ?>" class="badge badge-danger tombol-aktif"> Tidak Aktif</a>
                                                <?php } ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="<?= site_url('akun/detail_akun_penjual'); ?>/<?= $m['id_penjual']; ?>" class="btn btn-sm btn-info rounded"><i class="feather icon-eye"></i> Detail</a>
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