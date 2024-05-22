<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('home'); ?>">Beranda</a></li>
                <li>Tentang Warma</li>
            </ul>
        </div>
    </div>
</div>

<!-- Page Conttent -->
<main class="page-content">

    <!-- About Page Area -->
    <div class="about-area ptb-30">
        <div class="container">
            <div class="row align-items-center pb-30">
                <div class="col-lg-7">
                    <div class="about-image">
                        <img src="<?= base_url(); ?>assets/frontend/images/others/warma-ilustration.png" alt="beautiful girl">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="about-content">
                        <h2>APA ITU<span>WARMA?</span></h2>
                        <p style="text-align: justify; margin-bottom:28px"><?= $tentang_warma['tentang']; ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 blogitem2-content cr-border-top" style="margin-bottom: 15px;">
                    <h2>TUJUAN WARMA</h2>
                    <p style="text-align:justify; text-indent:0.5in; margin-bottom:22px"><?= $tentang_warma['tujuan']; ?></p>
                </div>
                <div class="col-lg-12 blogitem2-content cr-border-top mb-30">
                    <div class="row">
                        <div class="col-sm-7">
                            <h2 class="mb-3">KONTAK KAMI</h2>
                            <div class="contact-content" style="margin-top: 25px">
                                <div class="single-content">
                                    <span class="single-content-icon">
                                        <i class="lnr lnr-map-marker"></i>
                                    </span>
                                    <b>Alamat :</b><br>
                                    <?= $website['alamat']; ?>
                                </div>
                                <div class="single-content">
                                    <span class="single-content-icon">
                                        <i class="lnr lnr-envelope"></i>
                                    </span>
                                    <b>Email :</b><br>
                                    <a href="#"><?= $website['email']; ?></a>
                                </div>
                                <div class="single-content">
                                    <span class="single-content-icon">
                                        <i class="lnr lnr-phone-handset"></i>
                                    </span>
                                    <b>Telepon :</b><br>
                                    <a href="#">+<?= $website['telepon']; ?></a>
                                </div>
                                <div class="single-content">
                                    <span class="single-content-icon">
                                        <i class="ion ion-logo-instagram"></i>
                                    </span>
                                    <b>Instagram: </b><br>
                                    <?= $website['instagram']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <img src="<?= base_url(); ?>assets/frontend/images/others/contact.png" alt="beautiful girl" class="mt-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>