@extends('layouts.app')

@section('title', 'General Settings')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Sistem e-learning Komputer 77</h2>
               
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif 

                        <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Upload Soal</h4>
                            </div>
                            <div class="col-md-8" id="settings-card">
                                <div class="form-group row align-items-center">
                                    <label for="learning" class="form-control-label col-sm-3 text-md-right">Judul Soal</label>
                                    <div class="col-sm-6 col-md-6">
                                        <input type="text" class="form-control @error('learning') is-invalid @enderror" name="learning" required>
                                        @error('learning')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label for="lecturer" class="form-control-label col-sm-3 text-md-right">Pengajar</label>
                                    <div class="col-sm-6 col-md-6">
                                        <input type="text" class="form-control @error('lecturer') is-invalid @enderror" name="lecturer" required>
                                        @error('lecturer')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file">Upload File Tugas:</label>
                                    <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary mt-3">Upload Tugas</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('library/codemirror/mode/javascript/javascript.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-setting-detail.js') }}"></script>
@endpush
