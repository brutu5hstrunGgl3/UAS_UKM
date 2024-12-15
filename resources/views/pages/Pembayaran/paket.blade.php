@extends('layouts.app')

@section('title', 'Pricing')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Paket Bimbel</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Pricing</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Harga Bimbel</h2>
                <div class="row justify-content-center -mt-10">

                    <!-- Kelas Premium -->
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing pricing-highlight">
                            <div class="pricing-title-premium">
                                Kelas Premium
                            </div>
                            <div class="pricing-padding">
                                <div class="pricing-price">
                                    <div>Rp 5.000.000</div>
                                    <div>per 3 Bulan</div>
                                </div>
                                <div class="pricing-details">
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Pembelajaran dibimbing langsung di tempat Peserta bimbel</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Mendapatkan Sertifikat </div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Materi bisa di kustomisasi</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Akses Materi dari dasar hingga mahir</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Syarat dan ketentuan berlaku</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pricing-cta">
                                <!-- Form untuk melakukan pembayaran -->
                                <form action="{{ route('form.bayar') }}" method="GET">
                                    <input type="hidden" name="paket" value="Premium">
                                    <!-- Input harga format mata uang (readonly) -->
                                    
                                    <!-- Input tersembunyi untuk mengirimkan harga murni -->
                                    <input type="hidden" name="harga"  value="5000000">
                                    <button type="submit" class="btn btn-primary">Pesan <i class="fas fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas Standar -->
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing pricing-highlight">
                            <div class="pricing-title-standar">
                                Kelas Standar
                            </div>
                            <div class="pricing-padding">
                                <div class="pricing-price">
                                    <div>Rp 500.000</div>
                                    <div>per bulan</div>
                                </div>
                                <div class="pricing-details">
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Akses Materi Pembelajaran Dasar hingga Menengah</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Mendapatkan Sertifikat</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Solusi Hemat bagi Siswa yang Ingin Cepat Siap</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Cocok untuk Belajar dengan Tujuan Tertentu</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Syarat dan ketentuan berlaku</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pricing-cta">
                                <!-- Form untuk melakukan pembayaran -->
                                <form action="{{ route('form.bayar') }}" method="GET">
                                    <input type="hidden" name="paket" value="Standard">
                                    <!-- Input harga format mata uang (readonly) -->
                                    
                                    <!-- Input tersembunyi untuk mengirimkan harga murni -->
                                    <input type="hidden" name="harga"  value="500000">
                                    <button type="submit" class="btn btn-primary-pesan">Pesan <i class="fas fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
   
@endpush
