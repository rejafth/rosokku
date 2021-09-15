<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Penugasan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item">Penugasan Kurir</li>
                        <li class="breadcrumb-item active">View Penugasan</li>
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

                    <!-- Detail jadwal -->
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="pl-1 mb-4"><i class="fa fa-calendar-alt mr-3 text-success"></i>Detail Jadwal</h5>
                            <table class="table border mb-4">
                                <tr>
                                    <td class="font-weight-bold">Nama Hari</td>
                                    <td>:</td>
                                    <td><?= $hari[$jadwal['hari']] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Jemput</td>
                                    <td>:</td>
                                    <td><?= $jadwal['tanggal_ambil_formated'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Jam Kerja</td>
                                    <td>:</td>
                                    <td><?= date('H:i', strtotime($jadwal['start'])) ?> WIB <span class="px-2">-</span> <?= date('H:i', strtotime($jadwal['end'])) ?> WIB</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Kurir</td>
                                    <td>:</td>
                                    <td><?= $jadwal['nama_kurir'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>

                    <!-- Detail urutan penjemputan -->
                    <div class="card shadow mt-4">
                        <div class="card-body">
                            <h5 class="pl-1 mb-4"><i class="fa fa-th-large mr-3 text-success"></i>Urutan Penjemputan</h5>
                            <div class="table-responsive">
                                <table class="table table-hover border dataTable">
                                    <thead class="bg-success">
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>ID TRANSAKSI</th>
                                            <th>NAMA PELANGGAN</th>
                                            <th>NAMA KURIR</th>
                                            <th class="text-center">URUTAN</th>
                                            <th>BARANG</th>
                                            <th>BERAT</th>
                                            <th class="text-center">STATUS</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transaksi as $key => $trans) : ?>
                                            <tr>
                                                <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                <td>TRANS-<?= $trans['id_transaksi'] ?></td>
                                                <td><?= $trans['nama_pelanggan'] ?></td>
                                                <td><?= ($trans['nama_kurir'] !== NULL) ? $trans['nama_kurir'] : '<i>Belum dijadwalkan</i>' ?></td>
                                                <td class="text-center"><?= $trans['urutan'] ?></td>
                                                <td><?= $trans['nama_barang'] ?></td>
                                                <td><?= ($trans['berat']) ? $trans['berat'] : 'Belum ditimbang' ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($trans['status'] == 'confirmed') {
                                                        echo 'Belum dijemput';
                                                    } else if ($trans['status'] == 'otw') {
                                                        echo 'Sedang dijemput';
                                                    } else if ($trans['status'] == 'done') {
                                                        echo 'Sudah dijemput';
                                                    } else if ($trans['status'] == 'cancel') {
                                                        echo 'Di cancel';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a target="_blank" href="<?= base_url('schedule/view_maps/') . $trans['id_transaksi'] ?>" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Tampilkan lokasi"><i class="fa fa-map-marked"></i></a>
                                                    <!-- <a href="<?= base_url('schedule/edit_jadwal/') . $trans['id_transaksi'] ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= base_url('schedule/delete_jadwal/') . $trans['id_transaksi'] ?>" class="delete btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a> -->
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
    $('#schedule').addClass('active');

    $(".dataTable").DataTable();
</script>