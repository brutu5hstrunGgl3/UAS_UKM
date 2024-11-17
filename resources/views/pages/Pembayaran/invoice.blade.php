@extends('layouts.app')

@section('title', 'Invoice')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Invoice</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Invoice</div>
                </div>
            </div>

            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">Order #{{ $data['order_id'] }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Billed To:</strong><br>
                                        {{ $data['name'] }} <br>
                                        {{ $data['no_telp'] }}<br>
                                        {{ $data['email'] }}<br>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <strong>Order Date:</strong><br>
                                        {{ $data['tanggal_pembayaran'] }}<br><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <h4><strong>Payment Method:</strong><br>
                                                Transfer<br>
                                                BCA: XXXXXXXX
                                            </h4>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title">Order Summary</div>
                                <p class="section-lead">All items here cannot be deleted.</p>
                                <div class="table-responsive">
                                    <table class="table-striped table-hover table-md table">
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Totals</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $data['paket'] }}</td>
                                            <td class="text-center">Rp. {{ number_format($data['harga'], 0, ',', '.') }}</td>
                                            <td class="text-center">1</td>
                                            <td class="text-right">Rp. {{ number_format($data['harga'], 0, ',', '.') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-8">
                                        <div class="section-title">Payment Method</div>
                                        <p class="section-lead">The payment method that we provide is to make it easier for
                                            you to pay invoices.</p>
                                        <div class="images">
                                            <img src="{{ asset('img/payment/visa.png') }}" alt="visa">
                                            <img src="{{ asset('img/payment/jcb.png') }}" alt="jcb">
                                            <img src="{{ asset('img/payment/mastercard.png') }}" alt="mastercard">
                                            <img src="{{ asset('img/payment/paypal.png') }}" alt="paypal">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Subtotal</div>
                                            <div class="section-lead">Rp. {{ number_format($data['harga'], 0, ',', '.') }}</div>
                                        </div>
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="section-lead">Rp. {{ number_format($data['harga'], 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- Form Upload Bukti Pembayaran -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden Input Fields -->
                        <input type="hidden" name="name" value="{{ $data['name'] }}">
                        <input type="hidden" name="no_telp" value="{{ $data['no_telp'] }}">
                        <input type="hidden" name="email" value="{{ $data['email'] }}">
                        <input type="hidden" name="paket" value="{{ $data['paket'] }}">
                        <input type="hidden" name="harga" value="{{ $data['harga'] }}">
                        <input type="hidden" name="tanggal_pembayaran" value="{{ $data['tanggal_pembayaran'] }}">

                        <div class="form-group">
                            <label for="bukti_pembayaran">Unggah Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control" required>
                        </div>

                        <div class="text-md-right">
                            <button type="submit" class="btn btn-primary">Kirim Invoice</button>
                            <button type="button" class="btn btn-danger">Cancel</button>
                            <button type="button" class="btn btn-warning">Print</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <!-- Page Specific JS File -->
@endpush
