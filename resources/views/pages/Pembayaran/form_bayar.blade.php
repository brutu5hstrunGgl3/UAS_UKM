@extends('layouts.app')

@section('title', 'Form Pembayaran')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pembayaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Paket</a></div>
                </div>
            </div>

            <form action="{{ route('invoice.preview') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pembelian Paket Bimbel</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pemesan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Telepon /WhatsApp</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp') }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Paket</label>
                                    <div class="col-sm-12 col-md-7">
                                    <input type="hidden" name="paket" value="{{ $paket }}">
                                        <input type="text" class="form-control" name="paket" value="{{ $paket }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                               
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga</label>
                                    <div class="col-sm-12 col-md-7">
                                    <input type="hidden" name="harga" value="{{ $harga }}">
                                        <input type="text" class="form-control" name="harga" value="Rp. {{ number_format($harga, 0, ',', '.') }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Pembayaran</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="datetime-local" class="form-control" name="tanggal_pembayaran">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Proses</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
@endpush
