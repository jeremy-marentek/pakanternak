<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Konfirmasi Pengiriman</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard/penjual'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Konfirmasi Pengiriman</a></li>
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
                        <h6 class="mb-0">Konfirmasi Pengiriman</h6>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('pesanan/input_pengiriman/' . $transaksi['order_id']); ?>" method="POST">
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-sm">Jasa Pengiriman</label>
                                <div class="col-sm-5">
                                    <select class="form-control form-control-sm" id="jasa" name="jasa">
                                        <option>Pilih Jasa Pengiriman</option>
                                        <option value="JNE">JNE</option>
                                        <option value="J&T">J&T</option>
                                        <option value="Grab Express">Grab Express</option>
                                        <option value="Go-Send">Go-Send</option>
                                        <option value="Jasa Pribadi">Jasa Pribadi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-sm">Nomor Resi</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control form-control-sm" id="no_resi" name="no_resi" placeholder="Nomor Resi (Optional)">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-5">
                                    <a href="<?= site_url('pesanan/daftar_pesanan_penjual/diproses'); ?>" class="btn btn-secondary"><i class="feather icon-rotate-ccw"></i>&nbsp;&nbsp;Kembali</a>
                                    <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>&nbsp;Konfirmasi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>