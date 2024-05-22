<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?= $title; ?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />

    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url(); ?>assets/backend/images/logo/favicon-warma-blue.png" type="image/x-icon">
    <!-- vendor css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/backend/css/style.css">
    <!-- datatables -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/backend/css/plugins/dataTables.bootstrap4.min.css">
    <!--lightbox css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/backend/css/plugins/lightbox.min.css">

</head>

<body class="background-blue">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- sidebar -->
    <?= $sidebar; ?>

    <!-- Header -->
    <?= $header; ?>

    <!-- Content -->
    <?= $content; ?>

    <!-- Required Js -->
    <script src="<?= base_url(); ?>assets/backend/js/vendor-all.min.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/plugins/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/ripple.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/pcoded.min.js"></script>

    <!-- Datatable Js -->
    <script src="<?= base_url(); ?>assets/backend/js/plugins/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/pages/data-basic-custom.js"></script>

    <!-- Form Validation Js -->
    <script src="<?= base_url(); ?>assets/backend/js/plugins/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/pages/form-validation.js"></script>

    <!-- Sweet Alert Js -->
    <script src="<?= base_url(); ?>assets/sweetalert/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/sweetalert/script_sweetalert.js"></script>

    <!-- Ekko Lightbox Js -->
    <script src="<?= base_url(); ?>assets/backend/js/plugins/lightbox.min.js"></script>

    <!-- CKEditor -->
    <script src="<?= base_url(); ?>assets/ckeditor/ckeditor.js"></script>

    <!-- Script Lightbox -->
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>

    <!-- Script preview image -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            var imageField = document.getElementById("image-field")

            reader.onload = function() {
                if (reader.readyState == 2) {
                    imageField.src = reader.result;
                }
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</body>

</html>