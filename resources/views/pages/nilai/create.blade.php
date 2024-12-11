@extends('layouts.app')

@section('title', 'Edit Nilai Peserta Bimbel')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Nilai Peserta Bimbel</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Nilai</a></div>
                    <div class="breadcrumb-item">Edit Nilai</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                <form action="{{ isset($nilai) ? route('nilai.update', $nilai->id) : route('nilai.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($nilai))
                            @method('PUT')
                        @endif

                        <input type="hidden" name="user_id" value="{{ $user->id }}"> <!-- Tetap gunakan ID peserta -->

                        <div class="card-header">
                            <h4>{{ isset($nilai) ? 'Edit Nilai Peserta' : 'Tambah Nilai Peserta' }}</h4>
                        </div>
                        <div class="card-body">
                            <!-- Peserta Bimbel -->
                            <div class="form-group">
                                <label for="user_name">Peserta Bimbel</label>
                                <input 
                                    type="text" 
                                    name="user_name" 
                                    id="user_name" 
                                    value="{{ $user->name }}" 
                                    class="form-control" 
                                    readonly>
                            </div>

                            <!-- Kehadiran -->
                            <div class="form-group">
                                <label for="kehadiran">Kehadiran</label>
                                <input 
                                    type="text" 
                                    name="kehadiran" 
                                    id="kehadiran" 
                                    placeholder="Kehadiran"
                                    class="form-control @error('kehadiran') is-invalid @enderror"
                                    value="{{ old('kehadiran', isset($nilai) ? $nilai->kehadiran : '') }}">
                            </div>

                            <!-- Kompetensi -->
                            <div class="form-group">
                                <label for="kompetensi">Kompetensi</label>
                                <input 
                                    type="text" 
                                    name="kompetensi" 
                                    id="kompetensi" 
                                    placeholder="Kompetensi"
                                    class="form-control @error('kompetensi') is-invalid @enderror"
                                    value="{{ old('kompetensi', isset($nilai) ? $nilai->kompetensi : '') }}">
                            </div>

                            <!-- Skill -->
                            <div class="form-group">
                                <label for="skill">Skill</label>
                                <input 
                                    type="text" 
                                    name="skill" 
                                    id="skill" 
                                    placeholder="Skill"
                                    class="form-control @error('skill') is-invalid @enderror"
                                    value="{{ old('skill', isset($nilai) ? $nilai->skill : '') }}">
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input 
                                    type="text" 
                                    name="status" 
                                    id="status" 
                                    placeholder="Status"
                                    class="form-control @error('status') is-invalid @enderror"
                                    value="{{ old('status', isset($nilai) ? $nilai->status : '') }}">
                            </div>

                            <!-- Upload -->
                            <div class="form-group">
                                <label for="file_nilai">Upload File Nilai</label>
                                <input 
                                    type="file" 
                                    name="file_nilai" 
                                    id="file_nilai" 
                                    class="form-control @error('file_nilai') is-invalid @enderror">

                                @error('file_nilai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">{{ isset($nilai) ? 'Update' : 'Submit' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
@endpush
