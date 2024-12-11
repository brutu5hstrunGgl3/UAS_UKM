@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Learning Module System</h1>
                @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
                    <a href="{{ route('tugas.create') }}" class="btn btn-primary">Tambah Tugas</a>
                @endif
            </div>

            @include('layouts.alert')

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Tugas</h4>
                            <div class="card-header-action">
                                <form method="GET" action="{{ route('tugas.index') }}" class="d-flex">
                                    <input type="text" class="form-control" placeholder="Search by Learning" name="learning">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Judul Tugas</th>
                                            <th>Pemateri</th>
                                            <th>File</th>
                                            <th>Tanggal Upload</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($tugas->isEmpty())
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada tugas yang ditemukan.</td>
                                            </tr>
                                        @else
                                            @foreach ($tugas as $tugasItem)
                                                <tr>
                                                    <td>{{ $tugasItem->learning }}</td>
                                                    <td>{{ $tugasItem->lecturer }}</td>
                                                    <td>
                                                       
                                                            {{ $tugasItem->file }}
                                                      
                                                    <td>{{ $tugasItem->created_at }}</td>
                                                    <td>
                                                        @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
                                                            <div class="d-flex">
                                                                <!-- <a href="{{route('tugas.edit', $tugasItem->learning) }}" class="btn btn-sm btn-info mr-1">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </a> -->
                                                                <form onsubmit="return confirm('Are you sure?');" method="POST" action="{{ route('tugas.destroy', $tugasItem->learning) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-sm btn-danger mr-1">
                                                                        <i class="fas fa-times"></i> Delete
                                                                    </button>
                                                                </form>
                                                                @endif
                                                                <a href="{{ route('tugas.download', $tugasItem->learning) }}" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-download"></i> Download
                                                                </a>
                                                            </div>
                                                       
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $tugas->withQueryString()->links() }}
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