<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Keuangan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Keuangan</li>
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
                <div class="col-12 mb-4">
                    <?= $this->session->flashdata('status') ?>
                    <!-- TAB -->
                    <ul class="nav nav-tabs" id="keuanganTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pemasukan-tab" data-toggle="tab" href="#pemasukan" role="tab" aria-controls="pemasukan" aria-selected="true">Pemasukan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pengeluaran-tab" data-toggle="tab" href="#pengeluaran" role="tab" aria-controls="pengeluaran" aria-selected="false">Pengeluaran</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="keuanganTabContent">
                        <!-- Pemasukan -->
                        <div class="tab-pane fade show active" id="pemasukan" role="tabpanel" aria-labelledby="pemasukan-tab">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h5 class="m-0">
                                        <strong>Total :</strong> Rp. <?= number_format($sum_pemasukan) ?>
                                        <button class="btn btn-sm btn-outline-success float-right" id="tambahPemasukan">
                                            <i class="fa fa-plus mr-1"></i>
                                            Tambah Data
                                        </button>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover border" id="dataTable1">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px; text-align: center;">No</th>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Nominal</th>
                                                    <th>Jenis</th>
                                                    <th class="text-center">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pemasukan as $key => $in) : ?>
                                                    <tr>
                                                        <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                        <td><?= $in['tanggal'] ?></td>
                                                        <td><?= $in['keterangan'] ?></td>
                                                        <td>Rp. <?= number_format($in['nominal']) ?>,-</td>
                                                        <td><?= $in['kategori'] ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('keuangan/get_keuangan/') . $in['id_keuangan'] ?>" class="editIncome btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                                                            <a href="<?= base_url('keuangan/delete_keuangan/') . $in['id_keuangan'] ?>" class="delete btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                        </div>
                        <!-- Pengeluaran -->
                        <div class="tab-pane fade" id="pengeluaran" role="tabpanel" aria-labelledby="pengeluaran-tab">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h5 class="m-0">
                                        <strong>Total :</strong> Rp. <?= number_format($sum_pengeluaran) ?>
                                        <button class="btn btn-sm btn-outline-success float-right" id="tambahPengeluaran">
                                            <i class="fa fa-plus mr-1"></i>
                                            Tambah Data
                                        </button>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover border" id="dataTable2">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px; text-align: center;">No</th>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Nominal</th>
                                                    <th>Jenis</th>
                                                    <th class="text-center">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pengeluaran as $key => $out) : ?>
                                                    <tr>
                                                        <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                        <td><?= $out['tanggal'] ?></td>
                                                        <td><?= $out['keterangan'] ?></td>
                                                        <td>Rp. <?= number_format($out['nominal']) ?>,-</td>
                                                        <td><?= $out['kategori'] ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('keuangan/get_keuangan/') . $out['id_keuangan'] ?>" class="editOutcome btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                                                            <a href="<?= base_url('keuangan/delete_keuangan/') . $out['id_keuangan'] ?>" class="delete btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->


<!-- Modal Tambah Keuangan -->
<div class="modal fade" id="modalKeuangan" tabindex="-1" aria-labelledby="modalKeuanganLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKeuanganLabel">Form Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formKeuangan">
                    <input type="hidden" name="id_keuangan" id="id_keuangan" value="">
                    <input type="hidden" name="tipe" id="tipe" value="">
                    <input type="hidden" name="kategori" id="kategori" value="">
                    <!-- Keterangan -->
                    <div class="form-group">
                        <label for="keterangan" class="pl-1">Keterangan :</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan">
                    </div>
                    <!-- Nominal -->
                    <div class="form-group">
                        <label for="nominal" class="pl-1">Nominal :</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" name="nominal" id="nominal" class="form-control text-left" data-mask="currency" autocomplete="off" required>
                        </div>
                    </div>
                    <!-- Tanggal -->
                    <div class="form-group">
                        <label for="tanggal" class="pl-1">Tanggal :</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" form="formKeuangan" class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>
</div>


<script type='text/javascript'>
    $('#keuangan').addClass('active');

    $("#dataTable1").DataTable();
    $("#dataTable2").DataTable();

    $('#tambahPemasukan').click(function() {
        $('#formKeuangan input').val('');
        $('#formKeuangan').attr('action', '<?= base_url('keuangan/add_keuangan') ?>');
        $('#tipe').val('in');
        $('#kategori').val('other');
        $('#modalKeuangan h5').text('Tambah Pemasukan');
        $('#opsi_pemasukan').show();
        $('#modalKeuangan').modal('show');
    });
    $('.editIncome').click(function(e) {
        e.preventDefault();
        $('#formKeuangan').attr('action', '<?= base_url('keuangan/edit_keuangan') ?>');
        $('#modalKeuangan h5').text('Edit Pemasukan');
        $('#opsi_pemasukan').show();
        $.get($(this).attr('href'), function(data) {
            $('#tipe').val('in');
            $('#kategori').val(data.kategori);
            $('#id_keuangan').val(data.id_keuangan);
            $('#keterangan').val(data.keterangan);
            $('#nominal').val(data.nominal);
            $('#tanggal').val(data.tanggal);
        });
        $('#modalKeuangan').modal('show');
    });


    $('#tambahPengeluaran').click(function() {
        $('#formKeuangan input').val('');
        $('#formKeuangan').attr('action', '<?= base_url('keuangan/add_keuangan') ?>');
        $('#tipe').val('out');
        $('#opsi_pemasukan').hide();
        $('#modalKeuangan h5').text('Tambah Pengeluaran');
        $('#modalKeuangan').modal('show');
    });
    $('.editOutcome').click(function(e) {
        e.preventDefault();
        $('#formKeuangan').attr('action', '<?= base_url('keuangan/edit_keuangan') ?>');
        $('#modalKeuangan h5').text('Edit Pengeluaran');
        $('#opsi_pemasukan').hide();
        $.get($(this).attr('href'), function(data) {
            $('#tipe').val('out');
            $('#kategori').val(data.kategori);
            $('#id_keuangan').val(data.id_keuangan);
            $('#keterangan').val(data.keterangan);
            $('#nominal').val(data.nominal);
            $('#tanggal').val(data.tanggal);
        });
        $('#modalKeuangan').modal('show');
    });
</script>