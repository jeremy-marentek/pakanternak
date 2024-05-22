<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Slider</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Slider</a></li>
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
                        <h5>Data Slider</h5>
                        <div class="card-header-right">
                            <a href="<?= site_url('website/tambah_slider'); ?>" class="btn waves-effect waves-light btn-primary">
                                <i class="feather icon-plus"></i>
                                &nbsp;Tambah Slider
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-de nowrap">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Slider Utama</th>
                                        <th>Headline</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($slider as $s) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $s['id_slider']; ?></td>
                                            <td class="align-middle text-center">
                                                <img src="<?= base_url('upload/foto_slider/' . $s['foto_slider']); ?>" alt="contact-img" title="contact-img" class="rounded" height="60px" style="object-fit: cover">
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php if ($s['status'] == 1) { ?>
                                                    <span class="badge badge-success">Aktif</span>
                                                <?php } else { ?>
                                                    <a href="<?= site_url('website/update_status_slider'); ?>/<?= $s['id_slider']; ?>" class="badge badge-danger" onclick="return confirm('Jadikan slider utama?')"> Tidak Aktif</a>
                                                <?php } ?>
                                            </td>
                                            <td class="align-middle"><?= $s['headline2']; ?></td>
                                            <td class="align-middle text-center">
                                                <a href="<?= site_url('website/edit_slider'); ?>/<?= $s['id_slider']; ?>" class="btn btn-sm btn-primary rounded"><i class="feather icon-edit"></i> Edit</a>
                                                <a href="<?= site_url('website/hapus_slider'); ?>/<?= $s['id_slider']; ?>" class="btn btn-sm btn-danger rounded tombol-hapus"><i class="feather icon-trash-2"></i> Hapus</a>
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