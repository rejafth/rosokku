<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item">User</li>
                        <li class="breadcrumb-item active">View</li>
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
                        <div class="card-header text-right">
                            <a href="<?= base_url('user/resetPassword/' . $this->uri->segment(3)) ?>" class="reset btn btn-sm btn-warning"><i class="fa fa-key mr-1"></i>Reset Password</a>
                            <a href="<?= base_url('user/edit/' . $this->uri->segment(3)) ?>" class="btn btn-sm btn-secondary"><i class="fa fa-edit mr-1"></i>Edit</a>
                            <a href="<?= base_url('user/delete/' . $this->uri->segment(3)) ?>" class="delete btn btn-sm btn-danger"><i class="fa fa-trash mr-1"></i>Delete</a>
                        </div>
                        <div class="card-body">
                            <table class="table border">
                                <tr>
                                    <td class="font-weight-bold">Nama</td>
                                    <td>:</td>
                                    <td><?= $user['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Username</td>
                                    <td>:</td>
                                    <td><?= $user['username'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Phone</td>
                                    <td>:</td>
                                    <td><?= $user['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td>:</td>
                                    <td><?= $user['email'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Role</td>
                                    <td>:</td>
                                    <td><?= $user['role'] ?></td>
                                </tr>
                            </table>
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
</script>