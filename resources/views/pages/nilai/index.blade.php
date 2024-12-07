@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Learning Module System</h1>
                <div class="section-header-breadcrumb">
                    <!-- Breadcrumb jika diperlukan -->
                </div>
            </div>
            <div class="section-body">
                @include('layouts.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <ul class="nav nav-pills">
                                <!-- Jika ada menu di sini, tambahkan item menu -->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Import File Nilai</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data" class="d-flex flex-column align-items-start mb-2">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="file" class="sr-only">Upload File Tugas Anda:</label>
                                        <input type="file" id="file" name="file" class="form-control-file" accept=".xls,.xlsx" required>
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex">
        <button type="submit" class="btn btn-primary btn-icon icon-left">
            <i class="fas fa-upload"></i> Upload File Nilai 
        </button>
        <a href="{{ route('dashboard') }}" class="btn btn-danger btn-icon icon-left ml-2">
            <i class="fas fa-times"></i> Cancel
        </a>
    </div>
</a>
                                </form>
                            </div>

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div></div> <!-- Untuk menjaga keseimbangan, bisa diisi jika ada konten lain di kiri -->
                                    <form method="GET" action="{{ route('nilai.index') }}" class="ml-auto">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Kehadiran</th>
                                                <th>Kompetensi</th>
                                                <th>Skill</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->kehadiran }}</td>
                                                    <td>{{ $user->kompetensi }}</td>
                                                    <td>{{ $user->skill }}</td>
                                                    <td>{{ $user->status }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-download"></i> Download
                                                            </a>
                                                            <a href="{{ route('nilai.edit', $user->id) }}" class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <form onclick="return confirm('Are you sure?')" class="d-inline" action="{{ route('nilai.destroy', $user->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                    <i class="fas fa-times"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="float-right">
                                        {{ $users->withQueryString()->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
