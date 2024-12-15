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
                @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
                   
                    <div class="section-header-button">
                        <a href="{{ route('lecturer.create') }}" class="btn btn-primary">Masukkan Materi Disini</a>
                    </div>
                @endif
            </div>

            @include('layouts.alert')

            

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
                                        <input type="text" class="form-control" placeholder="Search" name="judul_materi">
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
                                            <th>Judul Materi</th>
                                            <th>Link Materi</th>
                                            <th>Jadwal</th>
                                            @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
        @foreach ($lecturers as $lecturer)
            <tr>
                <td>{{ $lecturer->name }}</td>
                <td>{{ $lecturer->position }}</td>
                <td>{{ $lecturer->judul_materi }}</td>
                <td>
                    <a href="{{ $lecturer->materi }}" class="url" style="color: gray; text-decoration: none;">
                        {{ $lecturer->materi }}
                    </a>
                </td>
                <td>{{ $lecturer->jadwal }}</td>
                <td>
                    @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
                        <div class="btn-group" role="group">
                            <a href="{{ route('lecturer.edit', $lecturer->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('lecturer.destroy', $lecturer->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endif
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
