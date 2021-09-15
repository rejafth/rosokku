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
                        <li class="breadcrumb-item">Iklan</li>
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
                            <form action="<?= $action ?>" method="post" id="formKategori" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 order-lg-1 order-md-1 order-sm-2 order-2">
                                        <!-- ID Kategori -->
                                        <input type="hidden" name="id_iklan" id="id_iklan" value="<?= (isset($iklan['id_iklan'])) ? $iklan['id_iklan'] : '' ?>">
                                        <!-- Label -->
                                        <div class="form-group mb-2">
                                            <label for="label_iklan" class="pl-1">Label Iklan *</label>
                                            <input type="text" name="label_iklan" id="label_iklan" placeholder="Nama" class="form-control" value="<?= (isset($iklan['label_iklan'])) ? $iklan['label_iklan'] : '' ?>" autocomplete="off" required>
                                        </div>
                                        <!-- Link -->
                                        <div class="form-group mb-2">
                                            <label for="link_iklan" class="pl-1">Link Iklan *</label>
                                            <input type="text" name="link_iklan" id="link_iklan" placeholder="Link" class="form-control" value="<?= (isset($iklan['link_iklan'])) ? $iklan['link_iklan'] : '' ?>" autocomplete="off" required>
                                        </div>
                                        <!-- Target -->
                                        <div class="form-group mb-2">
                                            <label for="target_usia" class="pl-1">Target usia *</label>
                                            <select name="target_usia" id="target_usia" class="custom-select" required>
                                                <option value="all">Semua umur</option>
                                                <option value="child">Anak-anak</option>
                                                <option value="teen">Remaja</option>
                                                <option value="adult">Dewasa</option>
                                            </select>
                                            <?php if (isset($iklan['target_usia'])) : ?>
                                                <script type='text/javascript'>
                                                    $('#target_usia').val('<?= $iklan['target_usia'] ?>');
                                                </script>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 order-lg-2 order-md-2 order-sm-1 order-1">
                                        <!-- Gambar -->
                                        <div class="form-group mb-1">
                                            <label for="image_iklan" class="pl-1">Gambar iklan *</label>
                                            <input type="file" name="image_iklan" id="image_iklan" class="form-control-file d-none invisible" data-preview="#thumb-iklan" accept="image/*">
                                        </div>
                                        <!-- Show image -->
                                        <div class="mb-3">
                                            <label for="image_iklan" style="cursor: pointer;">
                                                <?php if (isset($iklan['image_iklan'])) : ?>
                                                    <img src="<?= ($iklan['image_iklan'] != NULL) ? base_url('assets/img/thumb-iklan/' . $iklan['image_iklan']) : base_url('assets/img/nophoto.png') ?>" alt="thumb-iklan" id="thumb-iklan" class="w-100">
                                                <?php else : ?>
                                                    <img src="<?= base_url('assets/img/nophoto.png') ?>" alt="thumb-iklan" id="thumb-iklan" class="w-100">
                                                <?php endif; ?>
                                            </label>
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

<!-- Script -->
<script type='text/javascript'>
    $('#iklan').addClass('active');

    function readImg(input, showTarget) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $(showTarget).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('input[type=file]').change(function() {
        readImg(this, $(this).data('preview'));
    });
</script>