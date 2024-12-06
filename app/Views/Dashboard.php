<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Selamat Datang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Halaman Utama</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Welcome message box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $title ?></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <h4>Selamat Datang di Halaman Admin Buku Tamu Desnet</h4>
                <p>Anda dapat mengelola semua data kunjungan dan menampilkan statistik dari aktivitas yang dilakukan oleh para pengunjung.</p>
            </div>
        </div>
        <!-- PIE CHART KUNJUNGAN PER BULAN -->
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Kunjungan Berdasarkan Bulan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Dropdown untuk memilih tahun -->
                        <div class="form-group">
                        </div>
                        <canvas id="pieChartKunjunganBulan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->


        <!-- PIE CHART -->
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Divisi Paling Sering Mendapat Kunjungan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChartDivisi" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- PIE CHART -->
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> Rating Kunjungan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChartRating" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- jQuery -->
<script src="/adminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/adminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminLTE/dist/js/adminlte.min.js"></script>


<!-- Page specific script -->
<script>
    // Script untuk chart rating kunjungan
    $(function() {
        // Data dari controller untuk chart pertama
        var pieChartLabelsRating = <?= $labels1; ?>;
        var pieChartDataRating = <?= $data1; ?>;

        // Modifikasi label untuk menambahkan 'kali kunjungan' di belakang
        for (var i = 0; i < pieChartDataRating.length; i++) {
            pieChartLabelsRating[i] += ' = ' + pieChartDataRating[i] + ' kali ';
        }
        // Setup pie chart pertama
        var pieChartCanvasRating = $('#pieChartRating').get(0).getContext('2d');
        var pieData1 = {
            labels: pieChartLabelsRating,
            datasets: [{
                data: pieChartDataRating,
                backgroundColor: ['#fff75e', '#ffe94e', '#ffda3d',
                    '#fdb833', '#fda43f'
                ],
            }]
        };
        var pieOptions1 = {
            maintainAspectRatio: false,
            responsive: true,
        };

        // Buat pie chart pertama
        new Chart(pieChartCanvasRating, {
            type: 'pie',
            data: pieData1,
            options: pieOptions1
        });
    });

    // Script untuk chart divisi paling sering mendapat kunjungan
    $(function() {
        // Data dari controller untuk chart kedua
        var pieChartLabelsDivisi = <?= $labels2; ?>;
        var pieChartDataDivisi = <?= $data2; ?>;

        // Tambahkan 'kali kunjungan' ke setiap label
        for (var i = 0; i < pieChartDataDivisi.length; i++) {
            pieChartLabelsDivisi[i] += ' (' + pieChartDataDivisi[i] + ' kali kunjungan)';
        }

        // Setup pie chart kedua
        var pieChartCanvasDivisi = $('#pieChartDivisi').get(0).getContext('2d');
        var pieData2 = {
            labels: pieChartLabelsDivisi,
            datasets: [{
                data: pieChartDataDivisi,
                backgroundColor: ['#f94144', '#f3722c', '#f8961e', '#f9844a', '#f9c74f', '#90be6d',
                    '#43aa8b', '#4d908e', '#577590', '#277da1', '#024CAA', '#091057', '#1E3E62'
                ],
            }]
        };
        var pieOptions2 = {
            maintainAspectRatio: false,
            responsive: true,
        };

        // Buat pie chart kedua
        new Chart(pieChartCanvasDivisi, {
            type: 'pie',
            data: pieData2,
            options: pieOptions2
        });
    });

    $(function() {
        // Data dari controller untuk chart kunjungan berdasarkan bulan
        var pieChartLabelsKunjunganBulan = <?= $labels3; ?>; // Data labels untuk bulan
        var pieChartDataKunjunganBulan = <?= $data3; ?>; // Data kunjungan per bulan

        // Setup pie chart kunjungan berdasarkan bulan
        var pieChartCanvasKunjunganBulan = $('#pieChartKunjunganBulan').get(0).getContext('2d');
        var pieOptions3 = {
            maintainAspectRatio: false,
            responsive: true,
        };

        var pieChartKunjunganBulan = new Chart(pieChartCanvasKunjunganBulan, {
            type: 'pie',
            data: {
                labels: pieChartLabelsKunjunganBulan,
                datasets: [{
                    data: pieChartDataKunjunganBulan,
                    backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#4bc0c0', '#f44336', '#2196F3', '#9C27B0', '#FF9800', '#FFEB3B'],
                }]
            },
            options: pieOptions3
        });

    });
</script>