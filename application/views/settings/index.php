<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pengaturan Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Pengaturan Akun</li>
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
                            <ul class="tab nav nav-pills d-flex position-relative" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-edit-profile-tab" data-toggle="pill" href="#pills-edit-profile" role="tab" aria-controls="pills-edit-profile" aria-selected="true">Edit Profile </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-ubah-password-tab" data-toggle="pill" href="#pills-ubah-password" role="tab" aria-controls="pills-ubah-password" aria-selected="false">Ganti Password </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('status') ?>
                            <div class="container">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab">
                                        <div class="container" id="edit-profile">
                                            <form action="<?= base_url('settings/edit_profile') ?>" method="post" id="form-edit-profile">
                                                <input type="hidden" name="id_user" id="id_user" value="<?= $user['id_user'] ?>">
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="<?= ($user['nama'] != NULL) ? $user['nama'] : '' ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?= ($user['username'] != NULL) ? $user['username'] : '' ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= ($user['email'] != NULL) ? $user['email'] : '' ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="+62" value="<?= ($user['phone'] != NULL) ? $user['phone'] : '' ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-secondary w-100 mt-2">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-ubah-password" role="tabpanel" aria-labelledby="pills-ubah-password-tab">
                                        <div class="container" id="ubah-password">
                                            <form action="<?= base_url('settings/edit_password/' . $_SESSION['user']) ?>" method="post" id="form-ubah-password">
                                                <div class="form-group">
                                                    <label for="password_old">Password Saat Ini</label>
                                                    <input type="password" name="password_old" id="password_old" class="form-control" placeholder="Password Saat Ini" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password Baru</label>
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password Baru" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password_confirm">Konfirmasi Password</label>
                                                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Konfirmasi Password" required>
                                                </div>
                                                <button type="submit" class="btn btn-secondary w-100 mt-2">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
    /* UBAH PASSWORD */
    $('#form-ubah-password').submit(function(e) {
        e.preventDefault();
        if ($('#password').val() == $('#password_confirm').val()) {
            $('#password_confirm').removeClass('is-invalid');
            $('#form-ubah-password').unbind().submit();
        } else {
            $('#password_confirm').addClass('is-invalid');
        }
    });
</script>