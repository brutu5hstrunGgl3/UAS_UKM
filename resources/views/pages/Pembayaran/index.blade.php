@extends('layouts.app')

@section('title', 'Pricing')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pricing</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Components</a></div>
                    <div class="breadcrumb-item">Pricing</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Harga Bimbel </h2>
                <div class="row justify-content-center -mt-10">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing">
                            <div class="pricing-title">
                                 Kantor
                            </div>
                            <div class="pricing-padding">
                                <div class="pricing-price">
                                    
                                    <div>Rp.5000,000</div>
                                    <div>per 3 Bulan</div>
                                </div>
                                <div class="pricing-details">
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Dapat Akun Pembelajaran</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Pembelajaran Di Tempat </div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Sertifikat</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Custom Materi</div>
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="pricing-cta">

                            <a href="{{ route('pages.Pembayaran.form_bayar', ['paket' => 'Kantor', 'harga' => 5000000]) }}">
                            Pesan <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing pricing-highlight">
                            <div class="pricing-title">
                                Private
                            </div>
                            <div class="pricing-padding">
                                <div class="pricing-price">
                                    
                                    <div>Rp.500.000</div>
                                    <div>per bulan</div>
                                </div>
                                <div class="pricing-details">
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Dapat akun bimbel</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Pembelajaran di tempat bimbel</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Sertifakat</div>
                                    </div>
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Jadwal senin-sabtu "waktu disesuaikan"</div>
                                </div>
                            </div>
                            <div class="pricing-cta">
                            <a href="{{ route('pages.Pembayaran.form_bayar', ['paket' => 'Private', 'harga' => 500000]) }}">Pesan <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
