<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $titlePage ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item active"><?= $titlePage ?></li>
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
                            <form action="<?= $action ?>" method="post" id="formUser">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="hidden" name="id_user" id="id_user" value="<?= (isset($user['id_user'])) ? $user['id_user'] : '' ?>">
                                        <div class="form-group">
                                            <label for="role" class="pl-1">Role</label>
                                            <select name="role" id="role" class="custom-select" required>
                                                <option value="">Pilih role</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                            <?php if (isset($user['role'])) : ?>
                                                <script type='text/javascript'>
                                                    $('#role').val('<?= $user['role'] ?>');
                                                </script>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="pl-1">Nama</label>
                                            <input type="text" name="nama" id="nama" placeholder="Nama user" class="form-control" autocomplete="off" value="<?= (isset($user['nama'])) ? $user['nama'] : '' ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="pl-1">Email</label>
                                            <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?= (isset($user['email'])) ? $user['email'] : '' ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="pl-1">Phone</label>
                                            <input type="text" name="phone" id="phone" placeholder="+62" data-mask="phone" class="form-control" value="<?= (isset($user['phone'])) ? $user['phone'] : '' ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="pl-1">Username</label>
                                            <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="<?= (isset($user['username'])) ? $user['username'] : '' ?>" autocomplete="off" required>
                                        </div>
                                        <?php if ($this->uri->segment(2) == 'add') : ?>
                                            <div class="form-group">
                                                <label for="password" class="pl-1">Password</label>
                                                <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" form="formUser" class="btn btn-sm btn-outline-success"><?= $titlePage ?></button>
                        </div>
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