<?= $this->extend('template\master') ?>

<?= $this->section('page-title') ?> Dashboard <?= $this->endSection() ?>
<?= $this->section('subpage-title') ?> Home <?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    /* Custom CSS untuk responsivitas dan animasi */
    .chart-container {
        position: relative;
        margin: auto;
        width: 100%;
        min-height: 400px;
        padding: 20px 10px;
        transition: all 0.3s ease;
    }

    .chart-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 2rem;
    }

    .chart-title {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }

    .chart-title:after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 3px;
        background: linear-gradient(45deg, #003366, #0066cc);
        transition: width 0.3s ease;
    }

    .card:hover .chart-title:after {
        width: 100%;
    }

    .btn-header-primary {
        background: linear-gradient(45deg, #003366, #0066cc);
        border: none;
        border-radius: 25px;
        color: white;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 51, 102, 0.3);
    }

    .btn-header-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 51, 102, 0.4);
        color: white;
    }

    .chart-section {
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .chart-section:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }

    .chart-section:hover:before {
        left: 100%;
    }

    .section-title {
        color: #34495e;
        font-weight: 600;
        margin-bottom: 1rem;
        position: relative;
    }

    .alert-announce {
        background: linear-gradient(45deg, #17a2b8, #20c997);
        border: none;
        color: white;
        border-radius: 10px;
        animation: slideInDown 0.5s ease-out;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chart-container canvas {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Responsive breakpoints */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }

        .chart-container {
            margin-bottom: 2rem;
        }

        .btn-header-primary {
            font-size: 14px;
            padding: 8px 16px;
        }
    }

    @media (max-width: 576px) {
        .chart-title {
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 1rem;
        }
    }

    /* Loading animation */
    .chart-loading {
        display: none;
        text-align: center;
        padding: 2rem;
        color: #6c757d;
    }

    .spinner {
        display: inline-block;
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #003366;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Modal improvements */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(45deg, #003366, #0066cc);
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .btn-primary {
        background: linear-gradient(45deg, #003366, #0066cc);
        border: none;
        border-radius: 25px;
    }

    .btn-secondary {
        border-radius: 25px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Filter Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="glyph-icon simple-icon-magnifier mr-2"></i>
                    Filter Data
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="start_date">
                            <i class="glyph-icon simple-icon-calendar mr-2"></i>
                            Tanggal Mulai
                        </label>
                        <input type="date" class="form-control start-date" name="start_date" max="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">
                            <i class="glyph-icon simple-icon-calendar mr-2"></i>
                            Tanggal Akhir
                        </label>
                        <input type="date" class="form-control end-date" name="end_date" max="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="glyph-icon simple-icon-close mr-2"></i>Batal
                </button>
                <button type="submit" class="btn btn-primary btn-filter">
                    <i class="glyph-icon simple-icon-magnifier mr-2"></i>Filter
                </button>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-info rounded alert-announce">
    <i class="glyph-icon simple-icon-info mr-2"></i>
    Pilih tanggal untuk menampilkan data uang masuk dan uang keluar
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4 chart-title">
                    <i class="glyph-icon simple-icon-chart mr-2"></i>
                    Grafik Keuangan
                </h5>
                <div class="position-absolute card-top-buttons" style="top: 1.5rem; right: 1.5rem;">
                    <button class="btn btn-header-primary btn-modal">
                        <i class="glyph-icon simple-icon-magnifier mr-2"></i> Filter Data
                    </button>
                </div>

                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="chart-section">
                            <h6 class="section-title">
                                <i class="glyph-icon simple-icon-arrow-up-circle text-success mr-2"></i>
                                Uang Masuk
                            </h6>
                            <div class="chart-container">
                                <div class="chart-loading">
                                    <div class="spinner"></div>
                                    <p class="mt-2">Memuat data...</p>
                                </div>
                                <canvas id="editsalesChart" height="400" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="chart-section">
                            <h6 class="section-title">
                                <i class="glyph-icon simple-icon-arrow-down-circle text-danger mr-2"></i>
                                Uang Keluar
                            </h6>
                            <div class="chart-container">
                                <div class="chart-loading">
                                    <div class="spinner"></div>
                                    <p class="mt-2">Memuat data...</p>
                                </div>
                                <canvas id="editsalesChartNoShadow" height="400" class="chartjs-render-monitor"></canvas>
                            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        // Konfigurasi Toastr
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Tampilkan greeting dengan Toastr
        <?php if (session()->has('success')) : ?>
            setTimeout(function() {
                toastr.success('Selamat datang, <strong><?= session()->get('username') ?></strong>!<br>Sistem Informasi Pengelolaan Keuangan<br>GEREJA SANTAPAN ROHANI INDONESIA DENPASAR', 'Login Berhasil', {
                    allowHtml: true,
                    timeOut: 8000
                });
            }, 500);
        <?php endif ?>

        function showLoading(chart) {
            $(chart.canvas).siblings('.chart-loading').show();
            $(chart.canvas).hide();
        }

        function hideLoading(chart) {
            $(chart.canvas).siblings('.chart-loading').hide();
            $(chart.canvas).show();
        }

        function updateChart(chart, data) {
            showLoading(chart);

            setTimeout(() => {
                chart.data.labels = data.labels;
                chart.data.datasets[0].data = data.jumlah;
                chart.update('active');
                hideLoading(chart);
            }, 800);
        }

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#003366',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: true,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            let value = context.parsed.y;
                            return context.dataset.label + ': Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    display: true,
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 0,
                        autoSkip: true,
                        maxTicksLimit: 10,
                        font: {
                            size: 12
                        },
                        padding: 10
                    }
                },
                y: {
                    display: true,
                    beginAtZero: true,
                    position: 'left',
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            // Format angka menjadi lebih ringkas
                            if (value >= 1000000) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                            } else if (value >= 1000) {
                                return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                            }
                            return 'Rp ' + value.toLocaleString('id-ID');
                        },
                        font: {
                            size: 11
                        },
                        padding: 15,
                        maxTicksLimit: 8
                    }
                }
            },
            elements: {
                point: {
                    radius: 5,
                    hoverRadius: 8,
                    borderWidth: 2,
                    backgroundColor: '#ffffff',
                    hoverBorderWidth: 3
                },
                line: {
                    borderWidth: 3,
                    tension: 0.4
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            },
            hover: {
                animationDuration: 300
            }
        };

        const salesChart = new Chart(document.getElementById("editsalesChart"), {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Uang Masuk',
                    data: [],
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    pointBackgroundColor: '#28a745',
                    pointBorderColor: '#ffffff',
                    fill: true
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
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    pointBackgroundColor: '#dc3545',
                    pointBorderColor: '#ffffff',
                    fill: true
                }]
            },
            options: chartOptions
        });

        // Event handlers
        $('body').on('click', '.btn-modal', function() {
            $('#modal').modal('show');
        });

        $('body').on('click', '.btn-filter', function(e) {
            let start_date = $('.start-date').val();
            let end_date = $('.end-date').val();

            if (start_date == '' || end_date == '') {
                e.preventDefault();
                toastr.warning('Mohon untuk memilih tanggal mulai dan tanggal akhir', 'Perhatian!');
            } else if (new Date(start_date) > new Date(end_date)) {
                e.preventDefault();
                toastr.error('Tanggal mulai tidak boleh lebih besar dari tanggal akhir', 'Error!');
            } else {
                // Tampilkan loading
                toastr.info('Sedang memproses data...', 'Mohon Tunggu');

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

                            $('.chart-title').html('<i class="glyph-icon simple-icon-chart mr-2"></i>Grafik Keuangan - ' + start_date + ' s/d ' + end_date);
                            $('.alert-announce').fadeOut();
                            $('#modal').modal('hide');

                            toastr.success('Data berhasil difilter!', 'Berhasil');
                        } else {
                            toastr.error(response.message, 'Gagal!');
                        }
                    },
                    error: function() {
                        toastr.error('Terjadi kesalahan pada server', 'Error!');
                    }
                });
            }
        });

        // Inisialisasi chart dengan animasi
        setTimeout(() => {
            hideLoading(salesChart);
            hideLoading(salesChartNoShadow);
        }, 1000);
    });
</script>
<?= $this->endSection() ?>