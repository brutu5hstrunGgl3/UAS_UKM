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
                    <form action="{{ route('nilai.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="user_id" value="">
                        
                        <div class="card-header">
                            <h4>Edit Nilai Peserta</h4>
                        </div>
                        <div class="card-body">
                            <!-- Peserta Bimbel -->
                            <div class="form-group">
                                <label for="user_name">Peserta Bimbel</label>
                                <!-- Menampilkan nama peserta -->
                                <input 
                                    type="text" 
                                    name="user_name" 
                                    id="user_name" 
                                    value="{{ $user->name }}" 
                                    class="form-control" 
                                    readonly>
                                
                                <!-- Hidden input untuk user_id -->
                                <input 
                                    type="hidden" 
                                    name="user_id" 
                                    value="{{ $user->name }}">
                                
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Kehadiran -->
                            <div class="form-group">
                                <label for="kehadiran">Kehadiran</label>
                                <input 
                                    type="text" 
                                    name="kehadiran" 
                                    id="kehadiran" 
                                    placeholder="Kehadiran"
                                    class="form-control @error('kehadiran') is-invalid @enderror">
                                
                                @error('kehadiran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Kompetensi -->
                            <div class="form-group">
                                <label for="kompetensi">Kompetensi</label>
                                <input 
                                    type="text" 
                                    name="kompetensi" 
                                    id="kompetensi" 
                                   placeholder="kompetensi"
                                    class="form-control @error('kompetensi') is-invalid @enderror">
                                
                                @error('kompetensi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Skill -->
                            <div class="form-group">
                                <label for="skill">Skill</label>
                                <input 
                                    type="text" 
                                    name="skill" 
                                    id="skill" 
                                    placeholder="Kehadiran"
                                    class="form-control @error('skill') is-invalid @enderror">
                                
                                @error('skill')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input 
                                    type="text" 
                                    name="status" 
                                    id="status" 
                                    placeholder="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                
                                @error('status')
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
@endpush
