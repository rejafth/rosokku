<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola user</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Kelola user</li>
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
                            <a href="<?= base_url('user/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus mr-1"></i> Tambah User</a>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('status'); ?>
                            <div class="table-responsive">
                                <table class="table table-hover border" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>Nama User</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th class="text-center">Role</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user as $key => $usr) : ?>
                                            <tr>
                                                <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                <td><?= $usr['nama'] ?></td>
                                                <td><?= $usr['username'] ?></td>
                                                <td><?= $usr['email'] ?></td>
                                                <td><?= $usr['phone'] ?></td>
                                                <td><?= $usr['role'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('user/resetPassword/') . $usr['id_user'] ?>" class="reset btn btn-sm btn-warning"><i class="fa fa-key"></i></a>
                                                    <a href="<?= base_url('user/view/') . $usr['id_user'] ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                    <a href="<?= base_url('user/edit/') . $usr['id_user'] ?>" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= base_url('user/delete/') . $usr['id_user'] ?>" class="delete btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
    $('#user').addClass('active');
    $("#dataTable").DataTable();
</script>