@extends('layouts.app')

@section('title', 'Dashboard Admin dan Pemateri')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Admin dan Pemateri</h1>
            </div>

            <!-- Row Pertama -->
            <div class="row">
                <!-- Card Aktivitas Terbaru -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aktivitas Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="50"
                                        src="{{ asset('img/avatar/avatar-1.png') }}">
                                    <div class="media-body">
                                        <div class="float-right text-primary">10 min</div>
                                        <div class="media-title">John Doe</div>
                                        <span class="text-small text-muted">Mendaftar di kelas Matematika.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="50"
                                        src="{{ asset('img/avatar/avatar-2.png') }}">
                                    <div class="media-body">
                                        <div class="float-right text-primary">20 min</div>
                                        <div class="media-title">Jane Smith</div>
                                        <span class="text-small text-muted">Mengunggah tugas Biologi.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="50"
                                        src="{{ asset('img/avatar/avatar-3.png') }}">
                                    <div class="media-body">
                                        <div class="float-right text-primary">30 min</div>
                                        <div class="media-title">Alex Johnson</div>
                                        <span class="text-small text-muted">Menyelesaikan ujian Kimia.</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Card Jadwal -->
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jadwal Hari Ini</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Matematika - Kelas A</span>
                                    <span class="badge badge-primary badge-pill">08:00 - 09:30</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Fisika - Kelas B</span>
                                    <span class="badge badge-primary badge-pill">10:00 - 11:30</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Kimia - Kelas A</span>
                                    <span class="badge badge-primary badge-pill">13:00 - 14:30</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Biologi - Kelas C</span>
                                    <span class="badge badge-primary badge-pill">15:00 - 16:30</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Card Peserta Bimbel -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary text-white">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header text-center">
                                <h4>Peserta Bimbel</h4>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="mb-4 font-weight-bold text-dark">1,245</h3>
                                <div class="text-left px-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted">Jumlah Peserta Premium</span>
                                        <span class="badge badge-success px-3 py-2">645</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Jumlah Peserta Standar</span>
                                        <span class="badge badge-secondary px-3 py-2">600</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

            <!-- Row Grafik Statistik -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik Pendaftaran - Tahun 2024</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="registrationChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script>
        // Grafik Statistik Pendaftaran
        var ctx = document.getElementById("registrationChart").getContext("2d");
        var registrationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                datasets: [{
                    label: 'Pendaftaran',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    borderColor: '#63ed7a',
                    backgroundColor: 'rgba(99, 237, 122, 0.5)',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#63ed7a',
                    pointRadius: 5,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'top'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endpush
