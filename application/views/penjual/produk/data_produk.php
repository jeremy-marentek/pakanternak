<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Produk</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard/penjual'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Produk</a></li>
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
                        <h5>Data Produk</h5>
                        <div class="card-header-right">
                            <a href="<?= site_url('produk/tambah_produk'); ?>" class="btn waves-effect waves-light btn-primary">
                                <i class="feather icon-plus"></i>
                                &nbsp;Tambah Produk
                            </a>
                        </div>
                    </div>
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
                                        <th>Berat</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Status</th>
                                        <th width="8%">Action</th>
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
                                            <td class="align-middle text-center"><?= $p['berat_produk']; ?></td>
                                            <td class="align-middle text-center"><?= $p['stok_produk']; ?></td>
                                            <td class="align-middle text-center">
                                                <?php if ($p['status_produk'] == 1) { ?>
                                                    <a href="<?= site_url('produk/nonaktifkan_statusproduk/' . $p['id_produk']); ?>" class="badge badge-success tombol-nonaktifproduk">Aktif</a>
                                                <?php } else { ?>
                                                    <a href="<?php echo site_url('produk/aktifkan_statusproduk/' . $p['id_produk']); ?>" class="badge badge-danger tombol-aktifproduk"> Tidak Aktif</a>
                                                <?php } ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="<?= site_url('produk/detail_produk'); ?>/<?= $p['id_produk']; ?>" class="btn btn-sm btn-info rounded"><i class="feather icon-eye"></i> Detail</a>
                                                <a href="<?= site_url('produk/edit_produk'); ?>/<?= $p['id_produk']; ?>" class="btn btn-sm btn-primary rounded"><i class="feather icon-edit"></i> Edit</a>
                                                <a href="<?= site_url('produk/hapus_produk'); ?>/<?= $p['id_produk']; ?>" class="btn btn-sm btn-danger rounded tombol-hapus"><i class="feather icon-trash-2"></i> Hapus</a>
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