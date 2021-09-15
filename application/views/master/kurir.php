<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Master Kurir</h1>
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
                        <li class="breadcrumb-item active">Kurir</li>
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
                            <a href="<?= base_url('master/add_kurir') ?>" class="btn btn-sm btn-success mr-2 px-3"><i class="fa fa-plus mr-1"></i>Tambah Kurir</a>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('status') ?>
                            <div class="table-responsive">
                                <table class="table table-hover border" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>ID Kurir</th>
                                            <th>Nama Kurir</th>
                                            <th>Phone</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($kurir as $no => $kur) : ?>
                                            <tr>
                                                <td style="width: 30px; text-align: center;"><?= $no + 1 ?></td>
                                                <td>KUR<?= $kur['id_kurir'] ?></td>
                                                <td><?= $kur['nama_kurir'] ?></td>
                                                <td><?= $kur['phone_kurir'] ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('master/view_kurir/') . $kur['id_kurir'] ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat kurir"><i class="fa fa-eye"></i></a>
                                                    <a href="<?= base_url('master/edit_kurir/') . $kur['id_kurir'] ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit kurir"><i class="fa fa-pen"></i></a>
                                                    <a href="<?= base_url('master/delete_kurir/') . $kur['id_kurir'] ?>" class="delete btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete kurir"><i class="fa fa-trash"></i></a>
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
    $('#master-kurir').addClass('active');

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