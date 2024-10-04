@extends('layouts.app')

@section('title', 'New User')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>New User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Users</a></div>
                    <div class="breadcrumb-item">New User</div>
                </div>
            </div>

            <div class="section-body">

                <div class="card">
                    <form action= "{{ route('lecturer.store') }}" method="POST">
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
                                <label>Position</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror" name="position">
                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Materi</label>
                                <input type="text" class="form-control @error('materi') is-invalid @enderror" name="materi">
                                @error('materi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jadwal</label>
                                <input type="datetime-local" class="form-control @error('jadwal') is-invalid @enderror" name="jadwal">
                                @error('jadwal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
