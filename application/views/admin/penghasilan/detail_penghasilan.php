<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detail Penghasilan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Detail Penghasilan</a></li>
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
                        <h6 class="mb-0">Detail Penghasilan</h6>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="5%">Foto</th>
                                        <th>Nama Produk</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Harga Produk</th>
                                        <th class="text-center">Terjual</th>
                                        <!-- <th class="text-center">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($penjualan as $p) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $no++; ?></td>
                                            <td class="align-middle text-center">
                                                <img src="<?= base_url('upload/foto_produk/' . $p['foto_produk']); ?>" alt="contact-img" title="contact-img" class="rounded mr-3" height="48" width="48" style="object-fit: cover">
                                            </td>

                                            <td class="align-middle">
                                                <?= $p['nama_produk']; ?>
                                            </td>

                                            <td class="align-middle text-center">
                                                <?= $p['nama_kategori']; ?>
                                            </td>

                                            <td class="text-center align-middle">Rp<?= number_format($p['harga_produk'], 0, ',', '.'); ?></td>

                                            <td class="text-center align-middle"><?= $p['terjual']; ?></td>

                                            <!-- <td class="text-center align-middle">
                                                <a href="<?= site_url('penjualan/detail_penjualan'); ?>/<?= $p['id_produk']; ?>" class="btn btn-sm btn-info rounded"><i class="feather icon-eye"></i> Detail penjualan</a>
                                            </td> -->
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