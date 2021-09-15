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
                        <li class="breadcrumb-item">Pelanggan</li>
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
                            <?= $this->session->flashdata('status') ?>
                            <form action="<?= $action ?>" method="post" id="formPelanggan">
                                <div class="row">
                                    <div class="col-lg-6 col-md-8">
                                        <!-- ID Pelanggan -->
                                        <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?= (isset($pelanggan['id_pelanggan'])) ? $pelanggan['id_pelanggan'] : '' ?>">
                                        <!-- Nama -->
                                        <div class="form-group mb-2">
                                            <label for="nama" class="pl-1">Nama *</label>
                                            <input type="text" name="nama" id="nama" placeholder="Nama" class="form-control" value="<?= (isset($pelanggan['nama_pelanggan'])) ? $pelanggan['nama_pelanggan'] : '' ?>" autocomplete="off" required>
                                        </div>
                                        <!-- Phone -->
                                        <div class="form-group mb-2">
                                            <label for="phone" class="pl-1">Phone *</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="<?= (isset($pelanggan['phone_pelanggan'])) ? $pelanggan['phone_pelanggan'] : '' ?>" data-mask="phone" placeholder="+62" required>
                                        </div>
                                        <!-- Rekening -->
                                        <div class="form-group mb-2">
                                            <label for="rekening" class="pl-1">Rekening *</label>
                                            <input type="text" name="rekening" id="rekening" class="form-control text-left" value="<?= (isset($pelanggan['rekening_pelanggan'])) ? $pelanggan['rekening_pelanggan'] : '' ?>" data-mask="rekening" maxlength="30" autocomplete="off" placeholder="No Rekening" required>
                                        </div>
                                        <!-- Bank -->
                                        <div class="form-group mb-2">
                                            <label for="bank" class="pl-1">Bank *</label>
                                            <select name="bank" id="bank" class="custom-select" required>
                                                <option value="">Pilih Bank</option>
                                                <option value="BCA">BCA</option>
                                                <option value="BNI">BNI</option>
                                                <option value="BRI">BRI</option>
                                                <option value="MANDIRI">MANDIRI</option>
                                                <option value="PANIN">PANIN</option>
                                                <option value="MAYBANK">MAYBANK</option>
                                            </select>
                                        </div>
                                        <script type='text/javascript'>
                                            $('#bank').val('<?= (isset($pelanggan['bank_pelanggan'])) ? $pelanggan['bank_pelanggan'] : '' ?>');
                                        </script>
                                        <!-- Email -->
                                        <div class="form-group mb-2">
                                            <label for="email" class="pl-1">Email</label>
                                            <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?= (isset($pelanggan['email_pelanggan'])) ? $pelanggan['email_pelanggan'] : '' ?>" required>
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group mb-2">
                                            <label for="password" class="pl-1">Password</label>
                                            <input type="password" name="password" id="password" placeholder="Password" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right border-top">
                            <button type="submit" form="formPelanggan" class="btn btn-sm btn-outline-success"><?= $submitLabel ?></button>
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
    $('#master-pelanggan').addClass('active');
</script>