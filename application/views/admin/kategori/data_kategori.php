<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Kategori</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Kategori</a></li>
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
                        <h5>Data Kategori</h5>
                        <div class="card-header-right">
                            <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#tambahKategori">
                                <i class="feather icon-plus"></i>
                                &nbsp;Tambah Kategori
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <?= $this->session->userdata('kategori'); ?>
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Kategori</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kategori as $k) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $no++; ?></td>
                                            <td class="align-middle"><?= $k['nama_kategori']; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary rounded" data-toggle="modal" data-target="#editKategori<?= $k['id_kategori']; ?>"><i class="feather icon-edit"></i> Edit</button>
                                                <a href="<?= site_url('kategori/hapus_kategori'); ?>/<?= $k['id_kategori']; ?>" class="btn btn-sm btn-danger rounded tombol-hapus"><i class="feather icon-trash-2"></i> Hapus</a>
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

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Tambah Kategori</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="validation-form123" action="<?= site_url('kategori/tambah_kategori'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="floating-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kategori" name="kategori">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin: 0"><i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Kembali</button>
                    <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>&nbsp;&nbsp;Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<?php foreach ($kategori as $k) : ?>
    <div class="modal fade" id="editKategori<?= $k['id_kategori']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Edit Kategori</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="validation-form123" action="<?= site_url('kategori/edit_kategori'); ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $k['id_kategori']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan Nama Kategori" value="<?= $k['nama_kategori']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin: 0"><i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>