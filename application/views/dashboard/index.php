<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
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

                            <div class="row">
                                <!-- Chart 1 -->
                                <div class="col-lg-12">
                                    <div class="card shadow-none border">
                                        <div class="card-header border-0">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="card-title text-dark">Laporan keuangan</h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="position-relative mb-4">
                                                <canvas id="chart1" height="200"></canvas>
                                            </div>

                                            <div class="d-flex flex-row justify-content-end">
                                                <span class="mr-2">
                                                    <i class="fas fa-square text-success"></i> Income
                                                </span>
                                                <span>
                                                    <i class="fas fa-square text-gray"></i> Outcome
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Chart 2 -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="card shadow-none border">
                                        <div class="card-header border-bottom-0">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="card-title text-dark">Stock Barang</h3>
                                                <!-- <a href="javascript:void(0);" class="btn btn-sm btn-outline-success">View Report</a> -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="pieChart" style="height:200px;"></canvas>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>

                                <!-- Chart 3 -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="card shadow-none border">
                                        <div class="card-header border-bottom-0">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="card-title text-dark">Frekuensi Kurir</h3>
                                                <!-- <a href="javascript:void(0);" class="btn btn-sm btn-outline-success">View Report</a> -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover border" id="dataTable">
                                                    <thead class="bg-success">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th class="text-center">Frekuensi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($kurir as $key => $kur) : ?>
                                                            <tr>
                                                                <td><?= $key + 1 ?></td>
                                                                <td><?= $kur['nama_kurir'] ?></td>
                                                                <td class="text-center"><?= $kur['frekuensi'] ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<script type='text/javascript'>
    $('#dashboard').addClass('active');

    /* DataTable */
    $('#dataTable').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
    });

    /* CONFIGURASI CHART */
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }
    var mode = 'index'
    var intersect = true

    /* CHART 1 */
    var $salesChart = $('#chart1')
    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
            labels: [<?= $keuangan['bulan'] ?>],
            datasets: [{
                    backgroundColor: '#28a745',
                    borderColor: '#28a745',
                    data: [<?= $keuangan['income'] ?>]
                },
                {
                    backgroundColor: '#ced4da',
                    borderColor: '#ced4da',
                    data: [<?= $keuangan['outcome'] ?>]
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            if (value >= 1000) {
                                value /= 1000
                                value += 'k'
                            }
                            return value
                        }
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    });

    /* CHART 3 */
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
        labels: [<?= $stock['label'] ?>],
        datasets: [{
            data: [<?= $stock['value'] ?>],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
        }]
    }
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    });
</script>