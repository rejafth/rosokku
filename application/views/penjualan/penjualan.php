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
                        <li class="breadcrumb-item active">Penjualan</li>
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
                            <form action="<?= $action ?>" method="post" id="form_penjualan">
                                <div class="row">
                                    <div class="col-lg-6 col-md-8">
                                        <!-- Kategori -->
                                        <div class="form-group mb-2">
                                            <label for="id_kategori" class="pl-1">Kategori Barang *</label>
                                            <select name="id_kategori" id="id_kategori" class="custom-select" required>
                                                <option value="">Pilih kategori barang</option>
                                                <?php foreach ($kategori as $kat) : ?>
                                                    <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama'] ?></option>
                                                <?php endforeach; ?>
                                                <?php if (isset($penjualan['id_kategori'])) : ?>
                                                    <script type='text/javascript'>
                                                        $('#id_kategori').val('<?= $penjualan['id_kategori'] ?>');
                                                    </script>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <!-- Berat barang -->
                                        <div class="form-group mb-2">
                                            <label for="berat" class="pl-1">Berat barang *</label>
                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="number" name="berat" id="berat" placeholder="0" class="form-control" value="<?= (isset($penjualan['berat'])) ? $penjualan['berat'] : '1' ?>" min="1" autocomplete="off" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">KG</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Nominal Penjualan -->
                                        <div class="form-group mb-2">
                                            <label for="nominal" class="pl-1">Nominal Penjualan *</label>
                                            <div class="input-group mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">RP</div>
                                                </div>
                                                <input type="text" name="nominal" id="nominal" placeholder="0" class="form-control" data-mask="currency" value="<?= (isset($penjualan['nominal'])) ? $penjualan['nominal'] : '' ?>" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <!-- Pembeli -->
                                        <div class="form-group mb-2">
                                            <label for="pembeli" class="pl-1">Pembeli *</label>
                                            <input type="text" name="pembeli" id="pembeli" placeholder="Contoh : PT Daur Ulang Kertas Bekas" class="form-control" value="<?= (isset($penjualan['pembeli'])) ? $penjualan['pembeli'] : '' ?>" autocomplete="off" required>
                                        </div>
                                        <!-- Tanggal Penjualan -->
                                        <div class="form-group mb-2">
                                            <label for="tanggal" class="pl-1">Tanggal Penjualan *</label>
                                            <input type="date" name="tanggal" id="tanggal" placeholder="Tanggal Penjualan" class="form-control" value="<?= (isset($penjualan['tanggal'])) ? $penjualan['tanggal'] : '' ?>" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right border-top">
                            <button type="submit" form="form_penjualan" class="btn btn-sm btn-success"><?= $submitLabel ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<script type='text/javascript'>
    // Aktivasi link
    $('#penjualan').addClass('active');

    // Event kategori dan berta changed
    $('#id_kategori, #berat').change(function() {
        var berat = $('#berat').val();
        if ($('#id_kategori').val().length != 0 & $('#berat').val().length != 0) {
            $.get('<?= base_url('penjualan/get_kategori/') ?>' + $('#id_kategori').val(), function(data) {
                $('#nominal').val(data.harga * berat);
            });
        }
    });
    // Event berat keyup
    $('#berat').keyup(function(e) {
        var berat = $('#berat').val();
        if ($('#id_kategori').val().length != 0 & $('#berat').val().length != 0) {
            $.get('<?= base_url('penjualan/get_kategori/') ?>' + $('#id_kategori').val(), function(data) {
                $('#nominal').val(data.harga * berat);
            });
        }
    });
    // Event berat keydown
    $('#berat').keydown(function(e) {
        if ($('#berat').val().length == 1) {
            if (e.keyCode == 8 | e.keyCode == 46) {
                return false;
            }
        }
    });


    // Submit penjualan
    $('#form_penjualan').submit(function(e) {
        e.preventDefault();
        e.preventDefault();
        Swal.fire({
            title: 'Tambahkan penjualan ?',
            text: "Proses ini akan mengupdate jumlah stock dan menambah catatan pemasukan keuangan",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $(this).unbind().submit();
            }
        });
    })
</script>