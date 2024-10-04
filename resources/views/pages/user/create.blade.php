@extends('layouts.app')

@section('title', 'New User')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>e-Learning Bimbingan belajar @akupintar</h1>
                <div class="section-header-breadcrumb">
                   
                </div>
            </div>

            <div class="section-body">

                <div class="card">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>New User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror" name="position">
                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Divisi</label>
                                <input type="text" class="form-control @error('divisi') is-invalid @enderror" name="divisi">
                                @error('divisi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Roles</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="rul" value="ADMIN" class="selectgroup-input" checked="">
                                        
                                        <span class="selectgroup-button">Admin</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="rul" value="PEMATERI" class="selectgroup-input">
                                        
                                        <span class="selectgroup-button">Pemateri</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="rul" value="PESERTA" class="selectgroup-input">
                                        
                                        <span class="selectgroup-button">Peserta Kursus</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
