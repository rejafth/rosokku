<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Master Jadwal</h1>
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
                        <li class="breadcrumb-item active">Jadwal</li>
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
                        <div class="card-header">
                            <a href="<?= base_url('master/add_jadwal') ?>" class="btn btn-sm btn-success mr-2 px-3"><i class="fa fa-plus mr-1"></i>Tambah Jadwal</a>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('status') ?>
                            <div class="table-responsive">
                                <table class="table table-hover border" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>ID Jadwal</th>
                                            <th>Nama Hari</th>
                                            <th>Masa Berlaku</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jadwal as $no => $jad) : ?>
                                            <tr>
                                                <td style="width: 30px; text-align: center;"><?= $no + 1 ?></td>
                                                <td>JAD<?= $jad['id_jadwal'] ?></td>
                                                <td><?= $jad['hari'] ?></td>
                                                <td><?= $jad['start_date'] ?> sd <?= $jad['end_date'] ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('master/view_jadwal/') . $jad['id_jadwal'] ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat jadwal"><i class="fa fa-eye"></i></a>
                                                    <a href="<?= base_url('master/edit_jadwal/') . $jad['id_jadwal'] ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit jadwal"><i class="fa fa-pen"></i></a>
                                                    <a href="<?= base_url('master/delete_jadwal/') . $jad['id_jadwal'] ?>" class="delete btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete jadwal"><i class="fa fa-trash"></i></a>
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
    $('#master-drop').addClass('menu-open');
    $('#master').addClass('active');
    $('#master-jadwal').addClass('active');

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