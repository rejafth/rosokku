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

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Chart JS -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>plugins/chart.js/Chart.min.css">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>plugins/sweetalert2/sweetalert2.css">
    <!-- Lightbox -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" crossorigin="anonymous">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>dist/css/adminlte.min.css">
    <!-- App Style -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/') ?>dist/css/app.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?= base_url('assets/theme/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Sweetalert 2 -->
    <script src="<?= base_url('assets/theme/') ?>plugins/sweetalert2/sweetalert2.js"></script>
    <!-- Chart JS -->
    <script src="<?= base_url('assets/theme/') ?>plugins/chart.js/Chart.min.js"></script>
    <!-- Lightbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <script src="<?= base_url('assets/theme/') ?>plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets/theme/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- Maps -->
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
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

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-success">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notif -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge" id="notif-count">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right mt-3 shadow-lg">
                        <span class="dropdown-header bg-secondary font-weight-bold text-uppercase">Notifications</span>
                        <div class="dropdown-content" id="notif-content">
                            <!-- Load automatic -->
                        </div>
                        <div class="dropdown-footer"></div>
                    </div>
                </li>
                <!-- Logout -->
                <li class="nav-item dropdown">
                    <a class="logout nav-link" href="<?= base_url('logout') ?>">
                        <i class="fa fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <?php

        $now = date('Y-m-d H:i:s');
        $antrian = $this->db->get_where('transaksi', ['status' => 'pending', "tanggal_ambil >=" => "$now"])->num_rows();
        $pencairan = $this->db->get_where('request_saldo', ['status' => 'pending'])->num_rows();
        $user = $this->db->get_where('user', ['id_user' => $_SESSION['user']])->row_array();

        ?>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-success elevation-4">
            <!-- Brand Logo -->
            <!-- <a href="<?= base_url('') ?>" class="brand-link">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-bold ml-2">Admin Rosokku</span>
            </a> -->

            <!-- Sidebar -->
            <div class="sidebar mt-0">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel py-2 d-flex">
                    <div class="image" style="margin-top: 13px;">
                        <img src="<?= base_url('assets/img/user.png') ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info w-100">
                        <span class="d-block text-white text-uppercase"><?= $user['nama'] ?></span>
                        <small class="text-warning">Administrator</small>
                        <a href="<?= base_url('settings') ?>"><i class="fa fa-cog" style="position: absolute; top:17px; right: 5px;"></i></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard') ?>" class="nav-link" id="dashboard">
                                <i class="nav-icon fas fa-tachometer-alt mr-2"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if ($_SESSION['role'] == 'Admin') : ?>
                            <li class="nav-item has-treeview" id="master-drop">
                                <a href="#" class="nav-link" id="master">
                                    <i class="nav-icon fas fa-database mr-2"></i>
                                    <p>
                                        Data Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('master/pelanggan') ?>" class="nav-link" id="master-pelanggan">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>Pelanggan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('master/kategori') ?>" class="nav-link" id="master-kategori">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>Kategori</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('master/kurir') ?>" class="nav-link" id="master-kurir">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>Kurir</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('master/jadwal') ?>" class="nav-link" id="master-jadwal">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>Jadwal</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('master/start_point') ?>" class="nav-link" id="master-start">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>Start Point</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= base_url('pick') ?>" class="nav-link" id="pick">
                                <i class="nav-icon fas fa-shipping-fast mr-2"></i>
                                <p>
                                    New Request
                                    <?php if ($antrian > 0) : ?>
                                        <span class="right badge badge-danger" id="request-count"><?= $antrian ?></span>
                                    <?php else : ?>
                                        <span class="right badge badge-danger" id="request-count"></span>
                                        <script type='text/javascript'>
                                            $('#request-count').hide();
                                        </script>
                                    <?php endif; ?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('schedule') ?>" class="nav-link" id="schedule">
                                <i class="nav-icon fas fa-calendar-alt mr-2"></i>
                                <p>
                                    Penugasan Kurir
                                </p>
                            </a>
                        </li>
                        <?php if ($_SESSION['role'] == 'Admin') : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('keuangan/pencairan') ?>" class="nav-link" id="pencairan">
                                    <i class="nav-icon fas fa-money-check-alt mr-2"></i>
                                    <p>
                                        Pencairan Saldo
                                        <?php if ($pencairan > 0) : ?>
                                            <span class="right badge badge-danger" id="pencairan-count"><?= $pencairan ?></span>
                                        <?php else : ?>
                                            <span class="right badge badge-danger" id="pencairan-count"></span>
                                            <script type='text/javascript'>
                                                $('#pencairan-count').hide();
                                            </script>
                                        <?php endif; ?>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('penjualan') ?>" class="nav-link" id="penjualan">
                                    <i class="nav-icon fa fa-cash-register mr-2"></i>
                                    <p>
                                        Penjualan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('keuangan') ?>" class="nav-link" id="keuangan">
                                    <i class="nav-icon fas fa-wallet mr-2"></i>
                                    <p>
                                        Keuangan
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('user') ?>" class="nav-link" id="user">
                                    <i class="nav-icon fas fa-users-cog mr-2"></i>
                                    <p>
                                        Kelola User
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= base_url('iklan') ?>" class="nav-link" id="iklan">
                                <i class="nav-icon fas fa-ad mr-2"></i>
                                <p>
                                    Kelola Iklan
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>