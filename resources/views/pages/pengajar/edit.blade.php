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
                    <form action="{{ route('lecturer.update', $lecturer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Lecturer</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $lecturer->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" 
                                    class="form-control @error('position') is-invalid @enderror"
                                    name="position" value="{{ $lecturer->position }}">
                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Judul_Materi</label>
                                <input type="text" 
                                    class="form-control @error('judul_materi') is-invalid @enderror"
                                    name="judul_materi" value="{{ $lecturer->judul_materi }}">
                                @error('judul_materi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Materi</label>
                                <input type="url" 
                                    class="form-control @error('materi') is-invalid @enderror"
                                    name="materi" value="{{ $lecturer->materi }}">
                                @error('materi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                           
                            <div class="form-group">
                                <label>Jadwal</label>
                                <input type="datetime-local" class="form-control @error('jadwal') is-invalid @enderror" 
                                    name="jadwal" value="{{ $lecturer->jadwal }}">
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
