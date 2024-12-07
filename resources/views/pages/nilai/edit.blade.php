@extends('layouts.app')

@section('title', 'Edit Lecturer')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Lecturer</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Lecturers</a></div>
                    <div class="breadcrumb-item">Edit Lecturer</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="" method="POST">
                       
                        <div class="card-header">
                            <h4>Edit Lecturer</h4>
                        </div>
                        <div class="card-body">
                           
                            <div class="form-group">
                                <label>Kehadiran</label>
                                <input type="text" 
                                    class="form-control @error('position') is-invalid @enderror"
                                    name="position" value="">
                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kompetensi</label>
                                <input type="text" 
                                    class="form-control @error('judul_materi') is-invalid @enderror"
                                    name="judul_materi" value="">
                                @error('judul_materi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Skill</label>
                                <input type="url" 
                                    class="form-control @error('materi') is-invalid @enderror"
                                    name="materi" value="">
                                @error('materi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                           
                            <div class="form-group">
                                <label>Status</label>
                                <input type="datetime-local" class="form-control @error('jadwal') is-invalid @enderror" 
                                    name="jadwal" value="">
                                @error('jadwal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
