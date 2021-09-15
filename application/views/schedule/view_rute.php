<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Rute</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item">Penugasan Kurir</li>
                        <li class="breadcrumb-item active">View Rute</li>
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

<!-- Style Map Marker Start -->
<style>
    .marker {
        background-image: url('<?= base_url('assets/img/start.png') ?>');
        background-size: cover;
        width: 50px;
        height: 50px;
        cursor: pointer;
    }
</style>

<script type='text/javascript'>
    $('#schedule').addClass('active');

    /* DRAW MAP */
    mapboxgl.accessToken = 'pk.eyJ1IjoiaW1hbW5jIiwiYSI6ImNrZmo5ZHl3MDA4MjgycnF1Mng2OWNyazIifQ.BwzgOyXOLCqaVjGp-OEZIw';
    var map = new mapboxgl.Map({
        container: 'map',
        center: [<?= $center[0] ?>, <?= $center[1] ?>],
        zoom: 14,
        style: 'mapbox://styles/mapbox/streets-v11',
    });

    /* CREATE MARKER */
    <?php foreach ($transaksi as $trans) : ?>
        var popup = new mapboxgl.Popup({
                closeButton: false,
                closeOnClick: false
            })
            .setLngLat([<?= $trans['longitude_transaksi'] ?>, <?= $trans['latitude_transaksi'] ?>])
            .setHTML("<strong><?= $trans['nama_pelanggan'] ?> | <span class='badge badge-success'>Urutan <?= $trans['urutan'] ?></span></strong>")
            .setMaxWidth("300px")
            .addTo(map);
    <?php endforeach; ?>

    /* CREATE START MARKER */
    var el = document.createElement('div');
    el.className = 'marker';
    var marker = new mapboxgl.Marker(el)
        .setLngLat([<?= $center[0] ?>, <?= $center[1] ?>])
        .addTo(map);

    map.on('load', function() {
        // Create GeoJSON source
        map.addSource('route', {
            'type': 'geojson',
            'data': {
                'type': 'Feature',
                'properties': {},
                "geometry": <?= $rute ?>
            }
        });
        // Add layer Line
        map.addLayer({
            'id': 'route',
            'type': 'line',
            'source': 'route',
            'layout': {
                'line-join': 'round',
                'line-cap': 'round'
            },
            'paint': {
                'line-color': '#888',
                'line-width': 4
            }
        }, 'waterway-label');
        // Add layer direction
        map.addLayer({
                id: 'routearrows',
                type: 'symbol',
                source: 'route',
                layout: {
                    'symbol-placement': 'line',
                    'text-field': '▶',
                    'text-size': [
                        'interpolate',
                        ['linear'],
                        ['zoom'],
                        12,
                        24,
                        22,
                        60
                    ],
                    'symbol-spacing': [
                        'interpolate',
                        ['linear'],
                        ['zoom'],
                        12,
                        30,
                        22,
                        160
                    ],
                    'text-keep-upright': false
                },
                paint: {
                    'text-color': '#888',
                    'text-halo-color': 'hsl(55, 11%, 96%)',
                    'text-halo-width': 5
                }
            },
            'waterway-label'
        );
    });
</script>