<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Master Start Points</h1>
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
                        <li class="breadcrumb-item active">Start Points</li>
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
                            <a href="<?= base_url('master/add_start_point') ?>" class="btn btn-sm btn-success mr-2 px-3"><i class="fa fa-plus mr-1"></i>Tambah Start Point</a>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('status') ?>
                            <div class="table-responsive">
                                <table class="table table-hover border" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>ID Start Point</th>
                                            <th>Nama Venue</th>
                                            <th>Alamat</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($starts as $no => $start) : ?>
                                            <tr>
                                                <td style="width: 30px; text-align: center;"><?= $no + 1 ?></td>
                                                <td>POINT<?= $start['id_start'] ?></td>
                                                <td><?= $start['nama_start'] ?></td>
                                                <td><?= $start['keterangan_start'] ?></td>
                                                <td class="text-center">
                                                    <!-- <a href="<?= base_url('master/view_start_point/') . $start['id_start'] ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> -->
                                                    <a href="<?= base_url('master/edit_start_point/') . $start['id_start'] ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit start point"><i class="fa fa-pen"></i></a>
                                                    <a href="<?= base_url('master/delete_start_point/') . $start['id_start'] ?>" class="delete btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete start point"><i class="fa fa-trash"></i></a>
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
    $('#master-start').addClass('active');

    $("#dataTable").DataTable();
</script>