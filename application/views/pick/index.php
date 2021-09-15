<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Request Pengambilan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Request Pengambilan</li>
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
                        <div class="card-header border-0"></div>
                        <div class="card-body">
                            <?= $this->session->flashdata('status'); ?>
                            <div class="table-responsive">
                                <table class="table table-hover border" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>ID Transaksi</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Foto</th>
                                            <th>Klasifikasi</th>
                                            <th>Tanggal Ambil</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($antrian as $key => $antri) : ?>
                                            <tr>
                                                <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                <td>TRNS-<?= $antri['id_transaksi'] ?></td>
                                                <td><?= $antri['nama_pelanggan'] ?></td>
                                                <td>
                                                    <a href="<?= $antri['foto'] ?>" data-toggle="lightbox">
                                                        <img src="<?= $antri['foto'] ?>" style="width: 50px;">
                                                    </a>
                                                </td>
                                                <td><?= ($antri['klasifikasi'] != NULL) ? $antri['klasifikasi'] : 'Klasifikasi berat belum diukur' ?></td>
                                                <td><?= $antri['tanggal_ambil'] ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('pick/proses_antrian/') . $antri['id_transaksi'] ?>" class="proses btn btn-sm btn-outline-success"><i class="fa fa-sync mr-2"></i>Proses</a>
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
    $('#pick').addClass('active');

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