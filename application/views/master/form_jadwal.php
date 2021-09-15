<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $pageLabel ?></h1>
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
                        <li class="breadcrumb-item">Jadwal</li>
                        <li class="breadcrumb-item active"><?= $pageLabel ?></li>
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
                            <form action="<?= $action ?>" method="post" id="formJadwal">
                                <div class="row">
                                    <div class="col-lg-7 col-md-8">
                                        <!-- ID jadwal -->
                                        <input type="hidden" name="id_jadwal" id="id_jadwal" value="<?= (isset($jadwal['id_jadwal'])) ? $jadwal['id_jadwal'] : '' ?>">
                                        <!-- Hari -->
                                        <div class="form-group mb-2">
                                            <label for="hari" class="pl-1">Nama hari *</label>
                                            <input type="text" name="hari" id="hari" placeholder="Senin, selasa, rabu, dst" class="form-control" value="<?= (isset($jadwal['hari'])) ? $jadwal['hari'] : '' ?>" autocomplete="off" required>
                                        </div>
                                        <!-- Jam -->
                                        <div class="form-group mb-2">
                                            <label for="start" class="pl-1">Jam operasional *</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Start</div>
                                                        </div>
                                                        <input type="time" name="start" id="start" class="form-control text-left" value="<?= (isset($jadwal['start'])) ? $jadwal['start'] : '' ?>" data-mask="currency" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">End</div>
                                                        </div>
                                                        <input type="time" name="end" id="end" class="form-control text-left" value="<?= (isset($jadwal['end'])) ? $jadwal['end'] : '' ?>" data-mask="currency" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Masa Berlaku -->
                                        <div class="form-group mb-2">
                                            <label for="start_date" class="pl-1">Masa Berlaku *</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Start Date</div>
                                                        </div>
                                                        <input type="date" name="start_date" id="start_date" class="form-control text-left" value="<?= (isset($jadwal['start_date'])) ? $jadwal['start_date'] : '' ?>" data-mask="currency" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">End Date</div>
                                                        </div>
                                                        <input type="date" name="end_date" id="end_date" class="form-control text-left" value="<?= (isset($jadwal['end_date'])) ? $jadwal['end_date'] : '' ?>" data-mask="currency" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right border-top">
                            <button type="submit" form="formJadwal" class="btn btn-sm btn-outline-success"><?= $submitLabel ?></button>
                        </div>
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
</script>