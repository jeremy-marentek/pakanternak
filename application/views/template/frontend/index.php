<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/frontend/images/logo/favicon-warma-blue.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/frontend/images/icon.png">

    <!-- Google font (font-family: 'Roboto', sans-serif;) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">

    <!-- Plugins -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/plugins.css">
    <!-- Style Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/style.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/custom.css">

</head>

<body>
    <div id="wrapper" class="wrapper">

        <!-- Header -->
        <?= $header; ?>

        <!-- Content -->
        <?= $content; ?>

        <!-- Footer -->
        <?= $footer; ?>

        <!-- Quickview Modal -->
        

    <!-- Js Files -->

    
    <script src="<?= base_url(); ?>assets/frontend/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/plugins.js"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/main.js"></script>
    <!-- Tautan jQuery dan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Sweet Alert Js -->
    <script src="<?= base_url(); ?>assets/sweetalert/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/sweetalert/script_sweetalert.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            // Periksa apakah halaman yang sedang dibuka adalah halaman checkout
            var currentUrl = window.location.href;
            var tipeAkun = <?php echo $this->session->userdata('tipe'); ?>;
            if (currentUrl.indexOf("checkout") != -1 && tipeAkun ===2) {
                // Lakukan AJAX request untuk memeriksa keberadaan alamat utama
                $.ajax({
                    url: "<?= site_url('alamat/cekAlamatUtama') ?>",
                    type: "GET",
                    dataType: "json", // Tentukan tipe data yang diharapkan dari respons
                    success: function(response) {
                        // Tangani respons dari server
                        if (!response.alamat_utama) {
                            // Jika tidak ada alamat utama, tampilkan SweetAlert
                            Swal.fire({
                                icon: 'info',
                                title: 'Oops...',
                                text: 'Anda belum memiliki alamat!',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect ke halaman tambah alamat
                                    $('#tambahAlamatModal').modal('show');
                                }
                            });
                        }
                    }
                });
            }
        });
    </script>






   


</body>


</html>
