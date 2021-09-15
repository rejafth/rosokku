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
    <link rel="manifest" href="<?= base_url() ?>assets/manifest/manifest.json">
    <link rel="stylesheet" href="<?= base_url() ?>assets/addtohomescreen/addtohomescreen.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url('') ?>"><b>Admin</b>Rosokku</a>
        </div>
        <!-- /.login-logo -->
        <div class="card py-4 shadow">
            <div class="card-body login-card-body py-5">
                <?= $this->session->flashdata('status') ?>

                <p class="login-box-msg">Sign in to start your session</p>

                <form action="<?= base_url('auth/proses_login') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="<?= base_url('assets/theme/') ?>plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= base_url('assets/theme/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('assets/theme/') ?>dist/js/adminlte.min.js"></script>
        <!-- PWA -->
        <script src="<?= base_url() ?>assets/addtohomescreen/addtohomescreen.js"></script>
        <script src="<?= base_url() ?>assets/upupjs/upup.min.js"></script>

        <!-- PWA Config -->
        <script>
            UpUp.start({
                'cache_version': 'v1',
                'content-url': '<?= base_url('errors/offline') ?>',
                'service-worker-url': '/rosokku/admin-app/sw.js',
                'assets': ['/rosokku/admin-app/assets/sound/notification.mp3', '/rosokku/admin-app/assets/img/offline.svg', '/rosokku/admin-app/assets/img/logo.png', '/rosokku/admin-app/assets/theme/plugins/fontawesome-free/css/all.min.css', '/rosokku/admin-app/assets/theme/dist/css/adminlte.min.css', '/rosokku/admin-app/assets/theme/dist/css/app.css', '/rosokku/admin-app/assets/theme/plugins/bootstrap/js/bootstrap.bundle.min.js', '/rosokku/admin-app/assets/theme/dist/js/adminlte.min.js', '/rosokku/admin-app/assets/theme/plugins/jquery/jquery.min.js', '<?= base_url('dashboard') ?>']
            });

            if (
                (("standalone" in window.navigator) && !window.navigator.standalone) ||
                (!window.matchMedia('(display-mode: standalone)').matches)
            ) {
                addToHomescreen();
            }
        </script>

</body>

</html>