<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $pageLabel ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item">Kurir</li>
                        <li class="breadcrumb-item active"><?= $pageLabel ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="<?= $action ?>" method="post" id="formKurir">
                                <div class="row">
                                    <div class="col-lg-6 col-md-8">
                                        <!-- ID kurir -->
                                        <input type="hidden" name="id_kurir" id="id_kurir" value="<?= (isset($kurir['id_kurir'])) ? $kurir['id_kurir'] : '' ?>">
                                        <!-- Nama -->
                                        <div class="form-group mb-2">
                                            <label for="nama_kurir" class="pl-1">Nama kurir *</label>
                                            <input type="text" name="nama_kurir" id="nama_kurir" placeholder="Nama" class="form-control" value="<?= (isset($kurir['nama_kurir'])) ? $kurir['nama_kurir'] : '' ?>" autocomplete="off" required>
                                        </div>
                                        <!-- Alamat -->
                                        <div class="form-group mb-2">
                                            <label for="alamat_kurir" class="pl-1">Alamat kurir *</label>
                                            <textarea name="alamat_kurir" id="alamat_kurir" placeholder="Alamat" class="form-control" required><?= (isset($kurir['alamat_kurir'])) ? $kurir['alamat_kurir'] : '' ?></textarea>
                                        </div>
                                        <!-- Phone -->
                                        <div class="form-group mb-2">
                                            <label for="phone_kurir" class="pl-1">Phone *</label>
                                            <input type="text" name="phone_kurir" id="phone_kurir" class="form-control text-left" value="<?= (isset($kurir['phone_kurir'])) ? $kurir['phone_kurir'] : '' ?>" data-mask="phone" placeholder="+62" required>
                                        </div>
                                        <!-- Email -->
                                        <div class="form-group mb-2">
                                            <label for="email_kurir" class="pl-1">Email *</label>
                                            <input type="email" name="email_kurir" id="email_kurir" class="form-control text-left" value="<?= (isset($kurir['email_kurir'])) ? $kurir['email_kurir'] : '' ?>" data-mask="email" placeholder="Email" required>
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group mb-2">
                                            <label for="password_kurir" class="pl-1">Password *</label>
                                            <input type="password" name="password_kurir" id="password_kurir" class="form-control text-left" value="" data-mask="password" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right border-top">
                            <button type="submit" form="formKurir" class="btn btn-sm btn-outline-success"><?= $submitLabel ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<script type='text/javascript'>
    $('#master-drop').addClass('menu-open');
    $('#master').addClass('active');
    $('#master-kurir').addClass('active');
</script>