@extends('layouts.app')

@section('title', 'LMS Sekolah Dasar Negeri')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <style>
        .course-card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .course-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .course-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .course-card-body {
            padding: 15px;
            text-align: center;
        }

        .course-title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .course-description {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .btn-learn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-learn:hover, .btn-learn:focus {
            text-decoration: none;
            background-color: #ff0000;
            color: #ffffff;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Sistem Learning Bimbel Komputer 77</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">Pelajari Materi Komputer</h2>
                <p class="section-lead">Berbagai materi pembelajaran komputer untuk menunjang kebutuhan belajar Anda.</p>

                @if(auth()->user()->rul == 'PESERTA')
                @php
                    $pembayaran = App\Models\Pembayaran::whereHas('user', function ($query) {
                        $query->where('name', auth()->user()->name);
                    })->first();
                @endphp
                <div class="row">
                    <!-- Materi Word -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="course-card">
                            <img src="{{ asset('img/word.jpg') }}" alt="Microsoft Word">
                            <div class="course-card-body">
                                <h3 class="course-title">Belajar Microsoft Word</h3>
                                <p class="course-description">Pelajari cara membuat dokumen profesional dengan Microsoft Word.</p>
                                @if($pembayaran && $pembayaran->status == 'Approved')
                                    <a href="{{ route('lecturer.index') }}" class="btn-learn">Pelajari Sekarang</a>
                                @else
                                    <a href="{{ route('pages.Pembayaran.paket') }}" class="btn-learn">Pelajari Sekarang</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Materi Excel -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="course-card">
                            <img src="img/excel.jpg" alt="Microsoft Excel">
                            <div class="course-card-body">
                                <h3 class="course-title">Belajar Microsoft Excel</h3>
                                <p class="course-description">Kuasi analisis data dan perhitungan dengan Microsoft Excel.</p>
                                @if($pembayaran && $pembayaran->status == 'Approved')
                                <a href="{{ route('lecturer.index') }}" class="btn-learn">Pelajari Sekarang</a>
                                @else
                                    <a href="{{ route('pages.Pembayaran.paket') }}" class="btn-learn">Pelajari Sekarang</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Materi PowerPoint -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="course-card">
                            <img src="img/ppt.jpg" alt="Microsoft PowerPoint">
                            <div class="course-card-body">
                                <h3 class="course-title">Belajar PowerPoint</h3>
                                <p class="course-description">Ciptakan presentasi menarik dengan Microsoft PowerPoint.</p>
                                @if($pembayaran && $pembayaran->status == 'Approved')
                                <a href="{{ route('lecturer.index') }}" class="btn-learn">Pelajari Sekarang</a>
                                @else
                                    <a href="{{ route('pages.Pembayaran.paket') }}" class="btn-learn">Pelajari Sekarang</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Materi Desain Grafis -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="course-card">
                            <img src="img/desain-grafis.jpg" alt="Desain Grafis">
                            <div class="course-card-body">
                                <h3 class="course-title">Belajar Desain Grafis</h3>
                                <p class="course-description">Pahami dasar-dasar desain grafis untuk kebutuhan kreatif Anda.</p>
                                @if($pembayaran && $pembayaran->status == 'Approved')
                                <a href="{{ route('lecturer.index') }}" class="btn-learn">Pelajari Sekarang</a>
                                @else
                                    <a href="{{ route('pages.Pembayaran.paket') }}" class="btn-learn">Pelajari Sekarang</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Materi Internet -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="course-card">
                            <img src="img/safe-browsing.jpg" alt="Penggunaan Internet">
                            <div class="course-card-body">
                                <h3 class="course-title">Penggunaan Internet</h3>
                                <p class="course-description">Pelajari cara aman dan efektif dalam menggunakan internet.</p>
                                @if($pembayaran && $pembayaran->status == 'Approved')
                                <a href="{{ route('lecturer.index') }}" class="btn-learn">Pelajari Sekarang</a>
                                @else
                                    <a href="{{ route('pages.Pembayaran.paket') }}" class="btn-learn">Pelajari Sekarang</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Materi Pemrograman -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="course-card">
                            <img src="img/pemrograman.jpg" alt="Dasar Pemrograman">
                            <div class="course-card-body">
                                <h3 class="course-title">Belajar Dasar Pemrograman</h3>
                                <p class="course-description">Mulai perjalanan coding Anda dengan memahami dasar pemrograman.</p>
                                @if($pembayaran && $pembayaran->status == 'Approved')
                                <a href="{{ route('lecturer.index') }}" class="btn-learn">Pelajari Sekarang</a>
                                @else
                                    <a href="{{ route('pages.Pembayaran.paket') }}" class="btn-learn">Pelajari Sekarang</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
@endpush
