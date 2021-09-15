<?php if (!isset($_GET['tab'])) {
    header('Location: ' . base_url('schedule?tab=pending'));
} ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Penugasan Kurir</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Penugasan Kurir</li>
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
                            <ul class="tab nav nav-pills" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?= ($_GET['tab'] == 'pending') ? 'active' : '' ?>" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending
                                        <?php if (count($antrian) > 0) : ?>
                                            <span class="badge badge-warning ml-1"><?= count($antrian) ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?= ($_GET['tab'] == 'scheduled') ? 'active' : '' ?>" id="scheduled-tab" data-toggle="tab" href="#scheduled" role="tab" aria-controls="scheduled" aria-selected="true">Dijadwalkan
                                        <?php if (count($schedule) > 0) : ?>
                                            <span class="badge badge-warning ml-1"><?= count($schedule) ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?= ($_GET['tab'] == 'done') ? 'active' : '' ?>" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="true">Selesai
                                        <?php if (count($done) > 0) : ?>
                                            <span class="badge badge-warning ml-1"><?= count($done) ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?= ($_GET['tab'] == 'cancel') ? 'active' : '' ?>" id="cancel-tab" data-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="true">Di Cancel
                                        <?php if (count($cancel) > 0) : ?>
                                            <span class="badge badge-warning ml-1"><?= count($cancel) ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('status'); ?>
                            <div class="tab-content" id="tabTransaksi">
                                <!-- Pending -->
                                <div class="tab-pane fade <?= ($_GET['tab'] == 'pending') ? 'show active' : '' ?>" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover border dataTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px; text-align: center;">No</th>
                                                    <th>Tanggal Penjemputan</th>
                                                    <th>Jumlah Lokasi</th>
                                                    <th>Rentang Waktu</th>
                                                    <th class="text-center">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($antrian as $key => $antri) : ?>
                                                    <tr>
                                                        <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                        <td><?= $antri['tanggal_ambil_formated'] . ' | ' . $hari[$antri['hari']] ?></td>
                                                        <td class="<?= ($antri['jumlah_antrian'] > 11) ? 'text-danger' : '' ?>"><?= $antri['jumlah_antrian'] ?> Lokasi</td>
                                                        <td class="font-weight-bold <?= ($antri['rentang'] == 'Besok' | $antri['rentang'] == 'Kadaluarsa') ? 'text-danger' : 'text-success' ?>"><?= $antri['rentang'] ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= $antri['tanggal_ambil'] ?>" class="schedule-btn btn btn-sm btn-outline-secondary <?= ($antri['jumlah_antrian'] > 11) ? 'over' : '' ?>"><i class="fa fa-location-arrow"></i> Jadwalkan</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Scheduled -->
                                <div class="tab-pane fade <?= ($_GET['tab'] == 'scheduled') ? 'show active' : '' ?>" id="scheduled" role="tabpanel" aria-labelledby="scheduled-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover border dataTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px; text-align: center;">No</th>
                                                    <th>Tanggal Penjemputan</th>
                                                    <th>Jumlah Lokasi</th>
                                                    <th>Rentang Waktu</th>
                                                    <th>Nama Kurir</th>
                                                    <th class="text-center" style="width: 170px;">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($schedule as $key => $sch) : ?>
                                                    <tr>
                                                        <td class="align-middle" style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                        <td class="align-middle"><?= $sch['tanggal_ambil_formated'] . ' | ' . $hari[$sch['hari']] ?></td>
                                                        <td class="align-middle"><?= $sch['jumlah_lokasi'] ?> Lokasi</td>
                                                        <td class="align-middle font-weight-bold <?= ($sch['rentang'] == 'Besok' | $sch['rentang'] == 'Kadaluarsa') ? 'text-danger' : 'text-success' ?>"><?= $sch['rentang'] ?></td>
                                                        <td class="align-middle"><?= ($sch['nama_kurir'] !== NULL) ? $sch['nama_kurir'] : '<i>Belum dijadwalkan</i>' ?></td>
                                                        <td class="align-middle text-center">
                                                            <!-- Selesaikan -->
                                                            <a href="<?= base_url('schedule/selesaikan_tugas/') . $sch['id_rute'] ?>" class="btn btn-sm btn-outline-success mb-1 mt-1 done selesaikan_tugas" data-toggle="tooltip" data-placement="top" title="Selesaikan"><i class="fa fa-check-circle"></i></a>
                                                            <!-- Batalkan -->
                                                            <a href="<?= base_url('schedule/cancel_tugas/') . $sch['id_rute'] ?>" class="btn btn-sm btn-outline-danger mb-1 mt-1 cancel_tugas" data-toggle="tooltip" data-placement="top" title="Batalkan"><i class="fa fa-times-circle"></i></a>
                                                            <!-- Reschedule -->
                                                            <a href="#rescheduleModal<?= $sch['id_rute'] ?>" class="btn btn-sm btn-outline-primary mb-1 mt-1 reschedule" data-toggle="tooltip" data-placement="top" title="Re schedule"><i class="fa fa-calendar-alt"></i></a>
                                                            <!-- Lihat Detail -->
                                                            <a href="<?= base_url('schedule/view_jadwal/') . $sch['id_rute'] ?>" class="btn btn-sm btn-outline-info mb-1 mt-1" data-toggle="tooltip" data-placement="top" title="Lihat detail"><i class="fa fa-eye"></i></a>
                                                            <!-- Lihat Rute -->
                                                            <a href="<?= base_url('schedule/view_rute/') . $sch['id_rute'] ?>" class="btn btn-sm btn-outline-secondary mb-1 mt-1" data-toggle="tooltip" data-placement="top" title="Lihat rute"><i class="fa fa-map-marked"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Done -->
                                <div class="tab-pane fade <?= ($_GET['tab'] == 'done') ? 'show active' : '' ?>" id="done" role="tabpanel" aria-labelledby="done-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover border dataTable w-100">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px; text-align: center;">No</th>
                                                    <th>Tanggal Penjemputan</th>
                                                    <th>Jumlah Lokasi</th>
                                                    <th>Rentang Waktu</th>
                                                    <th>Nama Kurir</th>
                                                    <th class="text-center">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($done as $key => $do) : ?>
                                                    <tr>
                                                        <td class="align-middle" style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                        <td class="align-middle"><?= $do['tanggal_ambil_formated'] . ' | ' . $hari[$do['hari']] ?></td>
                                                        <td class="align-middle"><?= $do['jumlah_lokasi'] ?> Lokasi</td>
                                                        <td class="align-middle font-weight-bold <?= ($do['rentang'] == 'Besok' | $do['rentang'] == 'Kadaluarsa') ? 'text-danger' : 'text-success' ?>"><?= $do['rentang'] ?></td>
                                                        <td class="align-middle"><?= ($do['nama_kurir'] !== NULL) ? $do['nama_kurir'] : '<i>Belum dijadwalkan</i>' ?></td>
                                                        <td class="align-middle text-center">
                                                            <a href="<?= base_url('schedule/view_jadwal/') . $do['id_rute'] ?>" class="btn btn-sm btn-outline-info mb-1 mt-1" data-toggle="tooltip" data-placement="top" title="Lihat detail"><i class="fa fa-eye"></i></a>
                                                            <a href="<?= base_url('schedule/view_rute/') . $do['id_rute'] ?>" class="btn btn-sm btn-outline-secondary mb-1 mt-1" data-toggle="tooltip" data-placement="top" title="Lihat rute"><i class="fa fa-map-marked"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Cancel -->
                                <div class="tab-pane fade <?= ($_GET['tab'] == 'cancel') ? 'show active' : '' ?>" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover border dataTable w-100">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px; text-align: center;">No</th>
                                                    <th>Tanggal Penjemputan</th>
                                                    <th>Jumlah Lokasi</th>
                                                    <th>Rentang Waktu</th>
                                                    <th>Nama Kurir</th>
                                                    <th class="text-center">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($cancel as $key => $can) : ?>
                                                    <tr>
                                                        <td class="align-middle" style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                        <td class="align-middle"><?= $can['tanggal_ambil_formated'] . ' | ' . $hari[$can['hari']] ?></td>
                                                        <td class="align-middle"><?= $can['jumlah_lokasi'] ?> Lokasi</td>
                                                        <td class="align-middle font-weight-bold <?= ($can['rentang'] == 'Besok' | $can['rentang'] == 'Kadaluarsa') ? 'text-danger' : 'text-success' ?>"><?= $can['rentang'] ?></td>
                                                        <td class="align-middle"><?= ($can['nama_kurir'] !== NULL) ? $can['nama_kurir'] : '<i>Belum dijadwalkan</i>' ?></td>
                                                        <td class="align-middle text-center">
                                                            <a href="<?= base_url('schedule/view_jadwal/') . $can['id_rute'] ?>" class="btn btn-sm btn-outline-info mb-1 mt-1" data-toggle="tooltip" data-placement="top" title="Lihat detail"><i class="fa fa-eye"></i></a>
                                                            <a href="<?= base_url('schedule/view_rute/') . $can['id_rute'] ?>" class="btn btn-sm btn-outline-secondary mb-1 mt-1" data-toggle="tooltip" data-placement="top" title="Lihat rute"><i class="fa fa-map-marked"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
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

<!-- Modal Penugasan -->
<div class="modal fade" id="modalPenugasan" aria-labelledby="modalPenugasanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPenugasanLabel">Tugaskan Kurir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('schedule/proses_penjadwalan') ?>" method="post" id="formPenjadwalan">
                    <!-- Start point -->
                    <div class="form-group">
                        <label for="id_start" class="pl-1">Start Point :</label>
                        <select name="id_start" id="id_start" class="custom-select" required>
                            <option value="">Pilih titik awal penjemputan</option>
                            <?php foreach ($starts as $start) : ?>
                                <option value="<?= $start['id_start'] ?>"><?= $start['nama_start'] . ' - (' . $start['keterangan_start'] . ')' ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Jadwal -->
                    <div class="form-group">
                        <label for="tanggal_ambil" class="pl-1">Antrian jadwal :</label>
                        <select name="tanggal_ambil" id="tanggal_ambil" class="custom-select">
                            <option value="">Pilih jadwal penjemputan</option>
                            <?php foreach ($antrian as $antri) : ?>
                                <option value="<?= $antri['tanggal_ambil'] ?>"><?= $antri['hari'] . ", " . $antri['tanggal_ambil_formated'] . " (" . $antri['jumlah_antrian'] . " lokasi penjemputan)" ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Kurir -->
                    <label for="kurir" class="pl-1">Pilih Kurir : <span id="errorKurir" class="text-danger"></span></label>
                    <div class="table-responsive">
                        <table class="table table-sm border table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 70px; text-align: center;">Pilih</th>
                                    <th>ID Kurir</th>
                                    <th>Nama Kurir</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kurir as $kur) : ?>
                                    <tr>
                                        <td style="width: 70px; text-align: center;">
                                            <input type="checkbox" name="id_kurir" id="<?= $kur['id_kurir'] ?>" value="<?= $kur['id_kurir'] ?>" class="id_kurir">
                                        </td>
                                        <td>KR-<?= $kur['id_kurir'] ?></td>
                                        <td><?= $kur['nama_kurir'] ?></td>
                                        <td>
                                            <?php if ($kur['status_kurir'] == 'aktif') : ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php elseif ($kur['status_kurir'] == 'nonaktif') : ?>
                                                <span class="badge badge-secondary">Nonaktif</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" id="submitPenjadwalan" form="formPenjadwalan" class="btn btn-success">Proses</button>
            </div>
        </div>
    </div>
</div>

<?php foreach ($schedule as $key => $sch) : ?>
    <!-- Modal Reschedule -->
    <div class="modal fade" id="rescheduleModal<?= $sch['id_rute'] ?>" aria-labelledby="rescheduleModal<?= $sch['id_rute'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rescheduleModal<?= $sch['id_rute'] ?>Label">Reschedule Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('schedule/reschedule_tugas') ?>" method="post" id="formPenjadwalan">
                        <input type="hidden" name="id_rute" value="<?= $sch['id_rute'] ?>">
                        <div class="form-group">
                            <label>Tanggal ambil saat ini</label>
                            <input type="date" name="tanggal_saat_ini" class="form-control" value="<?= $sch['tanggal_ambil'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tanggal ambil Re-schedule</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check-circle mr-1"></i>
                                Re-schedule
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script type='text/javascript'>
    $('#schedule').addClass('active');

    $('#modalPenugasan').on('hidden.bs.modal', function() {
        $('#modalPenugasan select').val('');
        $('#modalPenugasan input[type=checkbox]').prop('checked', false);
    })

    $(".dataTable").DataTable();

    // Schedule button
    $('.schedule-btn').click(function(e) {
        e.preventDefault();
        if ($(this).hasClass('over')) {
            e.preventDefault();
            Swal.fire({
                title: 'Jumlah lokasi melebihi limit !',
                text: "Klik Lanjutkan, untuk tetap melakukan penjadwalan terhadap sebagian dari total lokasi sesuai limit",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $.get('<?= base_url('schedule/get_opsi_antrian/') ?>' + $(this).attr('href'), function(data) {
                        console.log(data);
                        $('#tanggal_ambil').html(`
                            <option value="${data.tanggal_ambil}" selected>${data.tanggal_ambil_formated}, ${data.hari} ===> ( ${(data.jumlah_antrian > 11) ? '2 / '+data.jumlah_antrian : data.jumlah_antrian} Lokasi )</option>
                        `);
                    });
                    $('#modalPenugasan').modal('show');
                }
            });
        } else {
            $.get('<?= base_url('schedule/get_opsi_antrian/') ?>' + $(this).attr('href'), function(data) {
                console.log(data);
                $('#tanggal_ambil').html(`
                    <option value="${data.tanggal_ambil}" selected>${data.tanggal_ambil_formated}, ${data.hari} ===> ( ${(data.jumlah_antrian > 11) ? '2 / '+data.jumlah_antrian : data.jumlah_antrian} Lokasi )</option>
                `);
            });
            $('#modalPenugasan').modal('show');
        }
    });

    // Submit Form
    $('#formPenjadwalan').submit(function(e) {
        e.preventDefault();
        var kurir = $('.id_kurir:checked');
        if (kurir.length > 0) {
            $('#errorKurir').text('');
            var kurirSelected = [];
            for (let i = 0; i < kurir.length; i++) {
                const kur = kurir[i];
                kurirSelected.push(kur.value);
            }
            var dataPenjadwalan = {
                "id_kurir": kurirSelected,
                "tanggal_ambil": $('#tanggal_ambil').val(),
                "id_start": $('#id_start').val()
            }
            // Send data using ajax
            $('#submitPenjadwalan').prop('disabled', true);
            $('#submitPenjadwalan').text('Mengirim...');
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: dataPenjadwalan,
                success: function(data) {
                    document.location.href = '<?= base_url('schedule?tab=scheduled') ?>';
                    $('#submitPenjadwalan').prop('disabled', false);
                    $('#submitPenjadwalan').text('Proses');
                }
            });
        } else {
            $('#errorKurir').text('Kurir tidak boleh kosong !');
        }
    });

    // Validasi kurir
    $('.id_kurir').change(function() {
        var kurir = $('.id_kurir:checked');
        if (kurir.length > 0) {
            $('#errorKurir').text('');
        } else {
            $('#errorKurir').text('Kurir tidak boleh kosong !');
        }
    });

    // Reshedule
    $('.reschedule').click(function(e) {
        e.preventDefault();
        $($(this).attr('href')).modal('show');
    });
</script>