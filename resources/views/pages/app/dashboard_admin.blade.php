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
               
                <!-- Card Peserta Bimbel -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary text-white">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header text-center">
                                <h4>Peserta Bimbel</h4>
                                <div class="card-body text-center">
                <h3>{{ $pesertaCount }}</h3> <!-- Tampilkan jumlah di sini -->
            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

            <!-- Row Grafik Statistik -->
           
@endsection

@push('scripts')
    <!-- JS Libraries -->
   
@endpush
