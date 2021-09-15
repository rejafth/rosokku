<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Master Pelanggan</h1>
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
                        <li class="breadcrumb-item active">Pelanggan</li>
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
                            <div class="table-responsive">
                                <table class="table table-hover border" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pelanggan as $no => $plg) : ?>
                                            <tr>
                                                <td style="width: 30px; text-align: center;"><?= $no + 1 ?></td>
                                                <td><?= $plg['nama_pelanggan'] ?></td>
                                                <td><?= $plg['phone_pelanggan'] ?></td>
                                                <td><?= $plg['email_pelanggan'] ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('master/view_pelanggan/' . $plg['id_pelanggan']) ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat pelanggan"><i class="fa fa-eye"></i></a>
                                                    <a href="<?= base_url('master/edit_pelanggan/' . $plg['id_pelanggan']) ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit pelanggan"><i class="fa fa-pen"></i></a>
                                                    <a href="<?= base_url('master/delete_pelanggan/' . $plg['id_pelanggan']) ?>" class="delete btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete pelanggan"><i class="fa fa-trash"></i></a>
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
    $('#master-pelanggan').addClass('active');

    $("#dataTable").DataTable();
</script>