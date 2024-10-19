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
                @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
                    <h1>Learning Module System</h1>
                    <div class="section-header-button">
                        <a href="{{ route('lecturer.create') }}" class="btn btn-primary">Tambah Pemateri</a>
                    </div>
                @endif
            </div>

            @include('layouts.alert')

            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <!-- Nav Pills can be added here if needed -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Optionally you can add something in the card header -->
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                                <!-- Left-side content, if necessary -->
                            </div>
                            <div class="float-right">
                                <form method="GET" action="{{ route('lecturer.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="name">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Materi</th>
                                            <th>Jadwal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lecturers as $lecturer)
                                            <tr>
                                                <td>{{ $lecturer->name }}</td>
                                                <td>{{ $lecturer->position }}</td>
                                                <td>
                                                    <a href="{{ $lecturer->materi }}" class="url" style="color: gray; text-decoration: none;">
                                                        {{ $lecturer->materi }}
                                                    </a>
                                                </td>
                                                <td>{{ $lecturer->jadwal }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        @if(auth()->user()->rul == 'PESERTA')
                                                            <a href="" class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i> Absen
                                                            </a>
                                                        @endif

                                                        @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
                                                            <a href="{{ route('lecturer.edit', $lecturer->id) }}" class="btn btn-sm btn-info btn-icon mr-2">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <form action="{{ route('lecturer.destroy', $lecturer->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon">
                                                                    <i class="fas fa-times"></i> Delete
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="float-right">
                                {{ $lecturers->withQueryString()->links() }}
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
