<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola Iklan</h1>
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
                            <a href="<?= base_url('iklan/add_iklan') ?>" class="btn btn-sm btn-success mr-2 px-3"><i class="fa fa-plus mr-1"></i>Tambah Iklan</a>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('status') ?>
                            <div class="table-responsive">
                                <table class="table table-hover border" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>ID Iklan</th>
                                            <th>Label Iklan</th>
                                            <th>Gambar</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($iklan as $no => $ik) : ?>
                                            <tr>
                                                <td style="width: 30px; text-align: center;"><?= $no + 1 ?></td>
                                                <td>ADS<?= $ik['id_iklan'] ?></td>
                                                <td><?= $ik['label_iklan'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('assets/img/thumb-iklan/' . $ik['image_iklan']) ?>" data-toggle="lightbox">
                                                        <img src="<?= base_url('assets/img/thumb-iklan/' . $ik['image_iklan']) ?>" style="width: 50px;">
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= $ik['link_iklan'] ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Lihat iklan"><i class="fa fa-eye"></i></a>
                                                    <a href="<?= base_url('iklan/edit_iklan/' . $ik['id_iklan']) ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit iklan"><i class="fa fa-pen"></i></a>
                                                    <a href="<?= base_url('iklan/delete_iklan/' . $ik['id_iklan']) ?>" class="delete btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete iklan"><i class="fa fa-trash"></i></a>
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
    $('#iklan').addClass('active');

    $("#dataTable").DataTable();
</script>