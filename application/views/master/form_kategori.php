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
                        <li class="breadcrumb-item">Kategori</li>
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
                            <form action="<?= $action ?>" method="post" id="formKategori">
                                <div class="row">
                                    <div class="col-lg-6 col-md-8">
                                        <!-- ID Kategori -->
                                        <input type="hidden" name="id_kategori" id="id_kategori" value="<?= (isset($kategori['id_kategori'])) ? $kategori['id_kategori'] : '' ?>">
                                        <!-- Nama -->
                                        <div class="form-group mb-2">
                                            <label for="nama" class="pl-1">Nama kategori *</label>
                                            <input type="text" name="nama" id="nama" placeholder="Nama" class="form-control" value="<?= (isset($kategori['nama'])) ? $kategori['nama'] : '' ?>" autocomplete="off" required>
                                        </div>
                                        <!-- Harga -->
                                        <div class="form-group mb-2">
                                            <label for="harga" class="pl-1">Harga Per Kilogram*</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="text" name="harga" id="harga" class="form-control text-left" value="<?= (isset($kategori['harga'])) ? $kategori['harga'] : '' ?>" data-mask="currency" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right border-top">
                            <button type="submit" form="formKategori" class="btn btn-sm btn-outline-success"><?= $submitLabel ?></button>
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
    $('#master-kategori').addClass('active');
</script>