<?= $this->extend('template\master') ?>

<?= $this->section('page-title') ?> Dashboard <?= $this->endSection() ?>
<?= $this->section('subpage-title') ?> Home <?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Modal -->

<!-- greeting -->
<div class="modal fade" id="modalGreeting" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid text-center">
                    <h5 class="mb-5">Selamat datang, <strong><?= session()->get('username') ?></strong></h3>

                    <img src="<?= base_url() ?>assets/img/logos/logo.jpg" class="img-thumbnail">

                    <h5 class="mt-5"><strong>GEREJA SANTAPAN ROHANI INDONESIA DENPASAR</strong></h5>
                    <h3>Sistem Informasi Pengelolaan Keuangan</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- filter -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control start-date" name="start_date" max="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control end-date" name="end_date" max="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-filter">Filter</button>
            </div>
        </div>
    </div>
</div>

<!-- end modal -->

<div class="alert alert-info rounded alert-announce">
    Pilih tanggal untuk menampilkan data uang masuk dan uang keluar
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4 chart-title">Grafik Keuangan</h5>
                <div class="position-absolute card-top-buttons">
                    <button class="btn btn-header-primary btn-modal">
                        <i class="glyph-icon simple-icon-magnifier"></i> Filter Data
                    </button>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <h6 class="mb-4">Uang Masuk</h6>
                        <div class="chart-container chart">
                            <!-- <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div> -->
                            <canvas id="editsalesChart" style="display: block; height: 300px; width: 482px;" width="100%" height="375" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-5">
                        <h6 class="mb-4">Uang Keluar</h6>
                        <div class="chart-container chart">
                            <!-- <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div> -->
                            <canvas id="editsalesChartNoShadow" style="display: block; height: 300px; width: 482px;" width="602" height="375" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="assets/js/vendors/Chart.bundle.min.js"></script>
<script src="assets/js/vendors/chartjs-plugin-datalabels.js"></script>
<!-- Adapter Luxon -->
<!-- <script src="https://cdn.jsdelivr.net/npm/luxon@3"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1"></script> -->

<script>
    $(document).ready(function() {
        <?php if (session()->has('success')) : ?>
            $('#modalGreeting').modal('show');
        <?php endif ?>

        function updateChart(chart, data) {
            chart.data.labels = data.labels;
            chart.data.datasets[0].data = data.jumlah;
            chart.update();
        }

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        boxWidth: 12,
                        padding: 16
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.parsed.y;
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 30,
                        autoSkip: true,
                        maxTicksLimit: 6
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            elements: {
                point: {
                    radius: 6,
                    borderWidth: 3,
                    backgroundColor: '#ffffff',
                    borderColor: '#003366',
                    hoverRadius: 7
                },
                line: {
                    borderWidth: 3
                }
            }
        };

        const salesChart = new Chart(document.getElementById("editsalesChart"), {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Uang Masuk',
                    data: [],
                    borderColor: '#003366',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: chartOptions
        });

        const salesChartNoShadow = new Chart(document.getElementById("editsalesChartNoShadow"), {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Uang Keluar',
                    data: [],
                    borderColor: '#003311',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: chartOptions
        });



        $('body').on('click', '.btn-modal', function() {
            $('#modal').modal('show');
        })

        $('body').on('click', '.btn-filter', function(e) {
            let start_date = $('.start-date').val();
            let end_date = $('.end-date').val();

            if (start_date == '' || end_date == '') {
                e.preventDefault();
                Swal.fire('Gagal', 'Mohon untuk memilih tanggal', 'warning')
            } else {
                $.ajax({
                    type: "post",
                    url: "filter",
                    data: {
                        'start_date': start_date,
                        'end_date': end_date,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') {
                            updateChart(salesChart, response.data.uang_masuk);
                            updateChart(salesChartNoShadow, response.data.uang_keluar);
                            $('.chart-title').text('Grafik Keuangan - ' + start_date + ' s/d ' + end_date)
                            $('.alert-announce').hide()
                            $('#modal').modal('hide');
                        } else {
                            Swal.fire('Gagal', response.message, 'error');
                        }
                    }
                });
            }
        })
    });
</script>
<?= $this->endSection() ?>