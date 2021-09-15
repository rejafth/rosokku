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
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item">Start point</li>
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
                        <div class="card-header border-0"></div>
                        <div class="card-body">
                            <form action="<?= $action ?>" method="post" id="formStartPoint">
                                <div class="row">
                                    <div class="col-lg-6 col-md-8">
                                        <!-- ID kurir -->
                                        <input type="hidden" name="id_start" id="id_start" value="<?= (isset($start['id_start'])) ? $start['id_start'] : '' ?>">
                                        <!-- Nama venue -->
                                        <div class="form-group mb-2">
                                            <label for="nama_start" class="pl-1">Nama Tempat *</label>
                                            <input type="text" name="nama_start" id="nama_start" placeholder="Contoh : Gudang 1" class="form-control" value="<?= (isset($start['nama_start'])) ? $start['nama_start'] : '' ?>" autocomplete="off" required>
                                        </div>
                                        <!-- Alamat venue -->
                                        <div class="form-group mb-3">
                                            <label for="keterangan_start" class="pl-1">Detail Alamat *</label>
                                            <textarea name="keterangan_start" id="keterangan_start" placeholder="Alamat start point" class="form-control" required><?= (isset($start['keterangan_start'])) ? $start['keterangan_start'] : '' ?></textarea>
                                        </div>
                                        <!-- Location -->
                                        <div class="text-right">
                                            <button type="button" class="btn btn-sm btn-outline-secondary mr-2" id="manualLocation"><i class="fa fa-pen mr-2"></i>Input manual</button>
                                            <button type="button" class="btn btn-sm btn-outline-success" id="currentLocation"><i class="fa fa-map-marker-alt mr-2"></i>Current location</button>
                                        </div>
                                        <hr class="mt-2">
                                        <!-- Longitude -->
                                        <div class="form-group mb-2">
                                            <label for="longitude_start" class="pl-1">Longitude *</label>
                                            <input type="text" name="longitude_start" id="longitude_start" class="form-control text-left" value="<?= (isset($start['longitude_start'])) ? $start['longitude_start'] : '' ?>" disabled required>
                                        </div>
                                        <!-- Latitude -->
                                        <div class="form-group mb-2">
                                            <label for="latitude_start" class="pl-1">Latitude *</label>
                                            <input type="text" name="latitude_start" id="latitude_start" class="form-control text-left" value="<?= (isset($start['latitude_start'])) ? $start['latitude_start'] : '' ?>" disabled required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="mapShow" class="text-center"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right border-top">
                            <button type="submit" form="formStartPoint" class="btn btn-sm btn-outline-success"><?= $submitLabel ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<script type='text/javascript'>
    /* ACTIVATE MENU */
    $('#master-drop').addClass('menu-open');
    $('#master').addClass('active');
    $('#master-start').addClass('active');

    /* CREATE MAP IN EDIT MODE */
    <?php if (isset($start['longitude_start']) & isset($start['latitude_start'])) : ?>
        $('#mapShow').html(`
            <img src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s-l+000(${$('#longitude_start').val()},${$('#latitude_start').val()})/${$('#longitude_start').val()},${$('#latitude_start').val()},13/500x300?logo=false&access_token=pk.eyJ1IjoiaW1hbW5jIiwiYSI6ImNrZmo5ZHl3MDA4MjgycnF1Mng2OWNyazIifQ.BwzgOyXOLCqaVjGp-OEZIw" class="w-100 mt-4" alt="map">
        `);
    <?php endif; ?>

    /* METHOD GET LOCATION */
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        alert("Location found !");
        $('#mapShow').html(`
            <img src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s-l+000(${position.coords.longitude},${position.coords.latitude})/${position.coords.longitude},${position.coords.latitude},13/500x300?logo=false&access_token=pk.eyJ1IjoiaW1hbW5jIiwiYSI6ImNrZmo5ZHl3MDA4MjgycnF1Mng2OWNyazIifQ.BwzgOyXOLCqaVjGp-OEZIw" class="w-100 mt-4" alt="map">
        `);
        $('#longitude_start').val(position.coords.longitude);
        $('#latitude_start').val(position.coords.latitude);
    }

    /* EVENT WHEN MANUAL LOCATION CLICKED */
    $('#manualLocation').click(function() {
        $('#longitude_start').prop('disabled', false);
        $('#latitude_start').prop('disabled', false);
        $('#longitude_start').focus();
    });

    /* EVENT WHEN LONGITUDE TYPED */
    $('#longitude_start').keyup(function() {
        $('#mapShow').html(`
            <img src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s-l+000(${$('#longitude_start').val()},${$('#latitude_start').val()})/${$('#longitude_start').val()},${$('#latitude_start').val()},13/500x300?logo=false&access_token=pk.eyJ1IjoiaW1hbW5jIiwiYSI6ImNrZmo5ZHl3MDA4MjgycnF1Mng2OWNyazIifQ.BwzgOyXOLCqaVjGp-OEZIw" class="w-100 mt-4" alt="map">
        `);
    });

    /* EVENT WHEN LATITUDE TYPED */
    $('#latitude_start').keyup(function() {
        $('#mapShow').html(`
            <img src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s-l+000(${$('#longitude_start').val()},${$('#latitude_start').val()})/${$('#longitude_start').val()},${$('#latitude_start').val()},13/500x300?logo=false&access_token=pk.eyJ1IjoiaW1hbW5jIiwiYSI6ImNrZmo5ZHl3MDA4MjgycnF1Mng2OWNyazIifQ.BwzgOyXOLCqaVjGp-OEZIw" class="w-100 mt-4" alt="map">
        `);
    });

    /* EVENT WHEN GET CURRENT LOCATION CLICKED */
    $('#currentLocation').click(function() {
        getLocation();
    });

    /* SUBMIT START POINT */
    $('#formStartPoint').submit(function(e) {
        e.preventDefault();
        $('#longitude_start').prop('disabled', false);
        $('#latitude_start').prop('disabled', false);
        $(this).unbind().submit();
    })
</script>