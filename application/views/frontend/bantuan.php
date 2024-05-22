<!-- Breadcrumb Area -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="ho-breadcrumb">
            <ul>
                <li><a href="<?= site_url('beranda'); ?>">Beranda</a></li>
                <li>Bantuan</li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="page-content">

    <!-- Content Bantuan -->
    <div class="checkout-area bg-white ptb-30">
        <div class="container">

            <div class="row mb-30">
                <div class="col-lg-4">


                </div>
                <div class="col-sm-4 text-center">
                    <img src="<?= base_url(); ?>assets/frontend/images/others/contact.png" alt="beautiful girl" class="mt-3">
                    <h3 class="mt-4 ml-5">MASIH BINGUNG?</h3>
                    <a href="https://api.whatsapp.com/send?phone=<?= $website['telepon']; ?>" target="_blank">
                        <button class="ho-button ml-5"><i class="ion ion-logo-whatsapp"></i>&nbsp;&nbsp;Hubungi Kami</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>