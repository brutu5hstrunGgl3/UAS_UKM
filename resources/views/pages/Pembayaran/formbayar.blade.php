@extends('layouts.app')

@section('title', 'Form Pembayaran')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Pembayaran</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="payment-method-info">
                        <div class="images">
                            <img src="{{ asset('img/payment/visa.png') }}" alt="visa">
                            <img src="{{ asset('img/payment/mastercard.png') }}" alt="mastercard">
                        </div>
                        <p>
                            <h4>Metode Pembayaran: Transfer rekening BRI</h4>
                        </p>
                        <p>
                            <h3>Nomor Rekening: 500601035093536 (A/N Rosmayanti Tinti)</h3>
                        </p>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf <!-- Keamanan CSRF -->
                                
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ auth()->user()->name }}" readonly>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="no_telp">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" 
                                           name="no_telp" value="{{ auth()->user()->phone }}" readonly>
                                    @error('no_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ auth()->user()->email }}" readonly>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_paket">Jenis Paket</label>
                                    <input type="text" name="jenis_paket" value="{{ $paket }}" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    @php
                                        $hargaFormatted = is_numeric($harga) ? number_format((float)$harga, 0, ',', '.') : 0;
                                    @endphp
                                    <input type="text" id="formatted-harga" value="{{ $hargaFormatted }}" class="form-control" readonly>
                                    <input type="hidden" name="harga" value="{{ $harga }}">
                                </div>

                                <div class="form-group">
                                    <label for="struk">Bukti Struk Transfer</label>
                                    <input type="file" id="struk" 
                                           class="form-control @error('struk') is-invalid @enderror" 
                                           name="struk" accept="image/*,application/pdf" required>
                                    <small class="form-text text-muted">Unggah file bukti struk transfer (jpg, jpeg, png, pdf).</small>
                                    @error('struk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-md-right">
                                    <div class="float-lg-left mb-lg-0 mb-3">
                                        <button class="btn btn-primary btn-icon icon-left">
                                            <i class="fas fa-credit-card"></i> Process Pembayaran
                                        </button>
                                        <a href="{{ route('pages.Pembayaran.paket') }}" class="btn btn-danger btn-icon icon-left">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Fungsi untuk menghapus pemisah ribuan dan mengonversi menjadi angka murni saat form disubmit
    document.querySelector('form').addEventListener('submit', function(e) {
        var formattedHarga = document.getElementById('formatted-harga').value;
        var hargaInput = document.querySelector('input[name="harga"]');

        // Menghapus titik (.) sebagai pemisah ribuan dan mengonversi menjadi angka murni
        var hargaNumeric = formattedHarga.replace(/[^\d]/g, '');

        // Menyimpan harga dalam bentuk angka murni ke input tersembunyi
        hargaInput.value = hargaNumeric;
    });
</script>
@endsection
