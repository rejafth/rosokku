<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="theme-color" content="#28a745">
    <meta name="google" content="notranslate">
    <meta name="description" content="Rosokku admin adalah sistem pengelolaan transaksi dan penugasan kurir dari rosokku.com">

    <title><?= $title ?></title>

    <!-- PWA link -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/logo.png" type="image/png">
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/img/logo.png">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>dist/css/adminlte.min.css">
    <!-- App Style -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>dist/css/app.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?= base_url('assets/theme/') ?>plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

    <!-- Loader -->
    <div class="div-loader text-center">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="container-fluid text-center">
        <div class="offline">
            <img src="<?= base_url() ?>assets/img/offline.svg" class="w-50">
            <h4 class="text-gray-800 mt-4">Anda sedang offline</h4>
            <p class="text-gray-500 mb-0">Pastikan anda terhubung ke internet !</p>
        </div>
    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/theme/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- App -->
    <script src="<?= base_url('assets/theme/') ?>dist/js/adminlte.min.js"></script>
    <script>
        /* LOADER */
        if ($('.div-loader').length > 0) {
            $(document).ready(function() {
                $('.div-loader').delay(1500).fadeOut('fast');
            });
        }
    </script>
</body>

</html>