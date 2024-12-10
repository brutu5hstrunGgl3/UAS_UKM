<!-- resources/views/pages/Pembayaran/formbayar.blade.php -->
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
                                            <img src="{{ asset('img/payment/visa.png') }}"
                                                alt="visa">
                                            <img src="{{ asset('img/payment/mastercard.png') }}"
                                                alt="mastercard">
                                            
                                        </div>
                                        <div></div>
    
        <!-- Menambahkan ikon BRI di sebelah kiri nomor rekening -->
       
        <p>
            <h4>Metode Pembayaran: Transfer rekening BRI</h4>
        </p>
    </div>

    <div class="d-flex align-items-center">
        <!-- Menambahkan ikon Visa di sebelah kiri nomor rekening -->
       
        <p>
            <h3>Nomor Rekening: 500601035093536 (A/N Rosmayanti Tinti)</h3>
        </p>
    </div>
</div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" class="form-control" readonly>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_telp">Nomor Telepon</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ auth()->user()->phone }}" class="form-control" readonly>
                                @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" class="form-control" readonly>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="jenis_paket">Jenis Paket</label>
                                <input type="text"  name="jenis_paket" value="{{ $paket }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <!-- Tampilkan harga dengan format mata uang di input text -->
                                <input type="text" id="formatted-harga" value="{{ number_format($harga, 0, ',', '.') }}" class="form-control" readonly>
                                <!-- Hidden input untuk menyimpan harga dalam format angka -->
                                <input type="hidden" name="harga" value="{{$harga }}">
                            </div>
                            <!-- <div class="form-group">
                                <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                <input type="date" name="tanggal_pembayaran" class="form-control" required>
                            </div> -->
                            <div class="form-group">
                                <label for="struk">Bukti Struk Transfer</label>
                                <input type="file"   class="form-control @error('struk') is-invalid @enderror"name="struk" class="form-control" accept="image/*,application/pdf">
                                <small class="form-text text-muted">Unggah file bukti struk transfer (jpg, jpeg, png, pdf).</small>
                                @error('struk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                            <div class="text-md-right">
                        <div class="float-lg-left mb-lg-0 mb-3">
                            <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process
                                Pembayaran</button>
                                <a href="{{ route('pages.Pembayaran.paket') }}" class="btn btn-danger btn-icon icon-left">
    <i class="fas fa-times"></i> Cancel
</a>
                        </div>
                        <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
    // Fungsi untuk menghapus pemisah ribuan dan mengonversi menjadi angka murni saat form disubmit
    document.querySelector('form').addEventListener('submit', function(e) {
        var formattedHarga = document.getElementById('formatted-harga').value;
        var harga = document.getElementById('harga');

        // Menghapus titik (.) sebagai pemisah ribuan dan mengonversi menjadi angka murni
        var hargaNumeric = formattedHarga.replace(/[^\d]/g, '');

        // Menyimpan harga dalam bentuk angka murni ke input tersembunyi
        harga.value = hargaNumeric;
    });
</script>
@endsection
