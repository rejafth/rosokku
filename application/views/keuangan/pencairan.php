<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pencairan Saldo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Pencairan Saldo</li>
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
                            <?= $this->session->flashdata('status'); ?>
                            <div class="table-responsive">
                                <table class="table table-hover border" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Nominal</th>
                                            <th>Rekening</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($request as $key => $req) : ?>
                                            <tr>
                                                <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                <td><?= $req['tanggal_formated'] ?></td>
                                                <td><?= $req['nama_pelanggan'] ?></td>
                                                <td>Rp. <?= number_format($req['saldo']) ?></td>
                                                <td>(<?= $req['bank_pelanggan'] ?>) <?= $req['rekening_pelanggan'] ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('keuangan/pencairan_saldo/') . $req['id_request_saldo'] ?>" class="pencairan btn btn-sm btn-outline-success">Proses</a>
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
<!-- /.content-wrapper -->

<script type='text/javascript'>
    $('#pencairan').addClass('active');

    $("#dataTable").DataTable();
    // $('#example2').DataTable({
    //     "paging": true,
    //     "lengthChange": false,
    //     "searching": false,
    //     "ordering": true,
    //     "info": true,
    //     "autoWidth": false,
    // });
</script>