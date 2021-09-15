<!-- Old notif data -->
<input type="hidden" name="old_notif" id="old_notif">

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Rosokku Admin | 1.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y') ?> | <a href="<?= base_url() ?>" class="ml-1 text-success">Rosokku</a></strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/theme/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/theme/') ?>plugins/select2/js/select2.full.min.js"></script>
<!-- Inputmask -->
<script src="<?= base_url('assets/theme/') ?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- PWA -->
<script src="<?= base_url() ?>assets/addtohomescreen/addtohomescreen.js"></script>
<script src="<?= base_url() ?>assets/upupjs/upup.min.js"></script>
<!-- App -->
<script src="<?= base_url('assets/theme/') ?>dist/js/adminlte.min.js"></script>
<script src="<?= base_url('assets/theme/') ?>dist/js/app.js"></script>

<!-- App Config -->
<script>
    /* LOADER */
    if ($('.div-loader').length > 0) {
        $(document).ready(function() {
            $('.div-loader').delay(500).fadeOut('fast');
        });
    }

    /* LOAD NOTIFICATION */
    // Set start condition
    $.get('<?= base_url('notification/load_notif') ?>', function(data) {
        if (data.total == 0) {
            $('#notif-count').hide();
        } else {
            $('#notif-count').show();
        }
        $('#notif-count').text(data.total);
        $('#notif-content').html(`
            <a href="<?= base_url('pick') ?>" class="dropdown-item">
                <i class="fas fa-shipping-fast mr-2"></i> Request Pengambilan
                <span class="float-right badge badge-danger mt-1">${data.new_request}</span>
            </a>
            <a href="<?= base_url('keuangan/pencairan') ?>" class="dropdown-item">
                <i class="fa fa-money-check-alt mr-2"></i> Pencairan Saldo
                <span class="float-right badge badge-danger mt-1">${data.new_pencairan}</span>
            </a>
        `);
        $('#old_notif').val(JSON.stringify(data));
    });
    // Set audio notif
    var notifAudio = new Audio(`<?= base_url() ?>assets/sound/notification.mp3`);
    // Load notif every 2 seconds
    setInterval(() => {
        $.get('<?= base_url('notification/load_notif') ?>', function(data) {
            if (data.total == 0) {
                $('#notif-count').hide();
            } else {
                $('#notif-count').show();

                var old = JSON.parse($('#old_notif').val());

                if (data.new_request == 0) {
                    $('#request-count').hide();
                } else {
                    $('#request-count').show();
                    $('#request-count').text(data.new_request);
                }

                if (data.new_pencairan == 0) {
                    $('#pencairan-count').hide();
                } else {
                    $('#pencairan-count').show();
                    $('#pencairan-count').text(data.new_pencairan);
                }

                if (data.total > old.total) {
                    notifAudio.play();
                    $('#notif-count').text(data.total);
                    $('#notif-content').html(`
                        <a href="<?= base_url('pick') ?>" class="dropdown-item">
                            <i class="fas fa-shipping-fast mr-2"></i> Request Pengambilan
                            <span class="float-right badge badge-danger mt-1">${data.new_request}</span>
                        </a>
                        <a href="<?= base_url('keuangan/pencairan') ?>" class="dropdown-item">
                            <i class="fa fa-money-check-alt mr-2"></i> Pencairan Saldo
                            <span class="float-right badge badge-danger mt-1">${data.new_pencairan}</span>
                        </a>
                    `);
                } else if (data.total < old.total) {
                    $('#notif-count').text(data.total);
                    $('#notif-content').html(`
                        <a href="<?= base_url('pick') ?>" class="dropdown-item">
                            <i class="fas fa-shipping-fast mr-2"></i> Request Pengambilan
                            <span class="float-right badge badge-danger mt-1">${data.new_request}</span>
                        </a>
                        <a href="<?= base_url('keuangan/pencairan') ?>" class="dropdown-item">
                            <i class="fa fa-money-check-alt mr-2"></i> Pencairan Saldo
                            <span class="float-right badge badge-danger mt-1">${data.new_pencairan}</span>
                        </a>
                    `);
                }
            }
            $('#old_notif').val(JSON.stringify(data));
        });
    }, 2000);
</script>

<!-- PWA Config -->
<script>
    /* PWA */
    UpUp.start({
        'cache_version': 'v1',
        'content-url': '<?= base_url('errors/offline') ?>',
        'service-worker-url': '/rosokku/admin-app/sw.js',
        'assets': ['/rosokku/admin-app/assets/sound/notification.mp3', '/rosokku/admin-app/assets/img/offline.svg', '/rosokku/admin-app/assets/img/logo.png', '/rosokku/admin-app/assets/theme/plugins/fontawesome-free/css/all.min.css', '/rosokku/admin-app/assets/theme/dist/css/adminlte.min.css', '/rosokku/admin-app/assets/theme/dist/css/app.css', '/rosokku/admin-app/assets/theme/plugins/bootstrap/js/bootstrap.bundle.min.js', '/rosokku/admin-app/assets/theme/dist/js/adminlte.min.js', '/rosokku/admin-app/assets/theme/plugins/jquery/jquery.min.js', '<?= base_url('dashboard') ?>']
    });

    if (
        (("standalone" in window.navigator) && !window.navigator.standalone) ||
        (!window.matchMedia('(display-mode: standalone)').matches)
    ) {
        addToHomescreen();
    }
</script>

</body>

</html>