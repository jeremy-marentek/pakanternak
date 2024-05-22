<div class="pcoded-main-container">
    <div class="pcoded-content">

        <!-- Breadcumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detail</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->session->userdata('message'); ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="nav nav-pills" role="tablist">
                            <a href="<?= site_url('akun/detail_akun_penjual'); ?>/<?= $penjual['id_penjual']; ?>" class="nav-link">Detail penjual</a>
                            <a href="#!" class="nav-link active">Daftar Produk</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="5%" class="text-center">Foto</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Tanggal Input</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($produk as $p) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $no++; ?></td>
                                            <td class="align-middle text-center">
                                                <img src="<?= base_url('upload/foto_produk/' . $p['foto_produk']); ?>" alt="contact-img" title="contact-img" class="rounded mr-3" height="48" width="48" style="object-fit: cover">
                                            </td>
                                            <td class="align-middle"><?= $p['nama_produk']; ?></td>
                                            <td class="align-middle"><?= $p['nama_kategori']; ?></td>
                                            <td class="align-middle">Rp <?= number_format($p['harga_produk'], 0, ',', '.'); ?></td>
                                            <td class="align-middle text-center"><?= $p['stok_produk']; ?></td>
                                            <td class="align-middle text-center"><?= date('d M Y H:i:s', strtotime($p['tanggal_input'])); ?></td>
                                            <td class="align-middle text-center">
                                                <?php if ($p['status_produk'] == 1) { ?>
                                                    <a href="<?= site_url('akun/nonaktifkan_status_produk/' . $p['id_produk']); ?>" class="badge badge-success tombol-nonaktifproduk">Aktif</a>
                                                <?php } else { ?>
                                                    <a href="<?php echo site_url('akun/aktifkan_status_produk/' . $p['id_produk']); ?>" class="badge badge-danger tombol-aktifproduk"> Tidak Aktif</a>
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