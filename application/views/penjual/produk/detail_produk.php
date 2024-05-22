<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- Breadcumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detail Produk</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard/penjual'); ?>"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Detail Produk</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <?= $this->session->userdata('message'); ?>

        <!-- Main Content -->
        <div class="row">

            <!-- Detail Produk -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-1">Detail Produk</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td width="33%">Nama Produk</td>
                                        <td>:&nbsp;&nbsp;<?= $produk['nama_produk']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>:&nbsp;&nbsp;<?= $produk['nama_kategori']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Produk</td>
                                        <td>:&nbsp;&nbsp;Rp<?= number_format($produk['harga_produk'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Input</td>
                                        <td>:&nbsp;&nbsp;<?= $produk['tanggal_input']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Stok Produk</td>
                                        <td>:&nbsp;&nbsp;<?= $produk['stok_produk']; ?> Buah</td>
                                    </tr>
                                    <tr>
                                        <td>Berat Produk</td>
                                        <td>:&nbsp;&nbsp;<?= $produk['berat_produk']; ?> gram</td>
                                    </tr>
                                    <tr>
                                        <td>Status Produk</td>
                                        <td>:&nbsp;&nbsp;
                                            <?php if ($produk['status_produk'] == 1) { ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Tidak Aktif</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <table class="table table-de mb-0">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Deskripsi Produk</td>
                                    </tr>
                                    <tr>
                                        <td class="text-wrap"><br><?= $produk['deskripsi_produk']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto Produk -->
            <div class="col-sm-4">
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
                <a href="<?= site_url('produk/data_produk'); ?>" class="btn btn-primary col-sm-12"><i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Kembali</a>
            </div>
        </div>
    </div>
</div>