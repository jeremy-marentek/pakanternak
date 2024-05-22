<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- Breadcumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Tambah Produk</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard/penjual'); ?>"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Tambah Produk</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <?= $this->session->userdata('message'); ?>

        <!-- Main Content -->
        <form action="<?= site_url('produk/tambah_produk'); ?>" method="POST" enctype="multipart/form-data">
            <div class="row">

                <!-- Foto Produk -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mt-1">Foto Produk</h5>
                        </div>
                        <div class="card-body text-center">
                            <!-- Preview Image -->
                            <img src="<?= base_url('assets/backend/images/logo/icon-foto-produk.png'); ?>" width="300px" class="img-fluid" style="object-fit: cover" id="image-field">

                            <!-- Custom Input File -->
                            <input type="file" id="foto" name="foto" style="visibility: hidden" onchange="previewImage(event)">
                            <button type="button" class="btn btn-primary col-sm-12" onclick="document.getElementById('foto').click()"><i class="feather icon-camera"></i>&nbsp;&nbsp; Upload Foto</button>
                        </div>
                    </div>
                </div>

                <!-- Detail Produk -->
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mt-1">Detail Produk</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label col-form-label-sm">Nama Produk</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Masukkan Nama Produk" value="<?= set_value('nama'); ?>">
                                    <?= form_error('nama', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label col-form-label-sm">Kategori Produk</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm" id="kategori" name="kategori">
                                        <option>Pilih Kategori</option>
                                        <?php foreach ($kategori as $k) : ?>
                                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('kategori', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label col-form-label-sm">Harga Produk</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm hour" id="harga" name="harga" placeholder="Masukkan Harga Produk" value="<?= set_value('harga'); ?>">
                                    <?= form_error('harga', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label col-form-label-sm">Stok Produk</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control form-control-sm" id="stok" name="stok" placeholder="Masukkan Stok Produk" value="<?= set_value('stok'); ?>">
                                    <?= form_error('stok', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label col-form-label-sm">Berat Produk</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control form-control-sm" id="berat" name="berat" placeholder="Masukkan Berat Produk (Satuan Gram)" value="<?= set_value('stok'); ?>">
                                    <?= form_error('berat', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-form-label col-form-label-sm">Deskripsi Produk</label>
                                <textarea class="ckeditor" name="deskripsi"></textarea>
                                <?= form_error('deskripsi', '<small class="text-danger font-weight-bold">', '</small>'); ?>
                            </div>
                            <div class="form-group row mt-4 mb-0">
                                <div class="col-sm-9">
                                    <a href="<?= site_url('produk/data_produk'); ?>" class="btn btn-secondary"><i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Kembali</a>
                                    <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>&nbsp;&nbsp;Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>