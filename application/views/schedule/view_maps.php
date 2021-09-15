<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Lokasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item">Penjadwalan</li>
                        <li class="breadcrumb-item active">View Lokasi</li>
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
                    <div class="card">
                        <div class="card-body">
                            <div id='map' style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<script type='text/javascript'>
    $('#schedule').addClass('active');

    // Draw map
    mapboxgl.accessToken = 'pk.eyJ1IjoiaW1hbW5jIiwiYSI6ImNrZmo5ZHl3MDA4MjgycnF1Mng2OWNyazIifQ.BwzgOyXOLCqaVjGp-OEZIw';
    var map = new mapboxgl.Map({
        container: 'map',
        center: [<?= $transaksi['longitude_transaksi'] ?>, <?= $transaksi['latitude_transaksi'] ?>],
        zoom: 13,
        style: 'mapbox://styles/mapbox/streets-v11',
    });
    var marker = new mapboxgl.Marker()
        .setLngLat([<?= $transaksi['longitude_transaksi'] ?>, <?= $transaksi['latitude_transaksi'] ?>])
        .addTo(map);
</script>