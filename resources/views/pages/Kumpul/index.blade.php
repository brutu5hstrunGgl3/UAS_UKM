@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Learning module system</h1>
                <div class="section-header-button">
                   
                </div>
                <div class="section-header-breadcrumb">
                   
                </div>
            </div>
            <div class="section-body">
                
            @include('layouts.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <ul class="nav nav-pills">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                           
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">

                                </div>
                                <div class="float-right">
                                    <form method="GET" action="{{ route('kumpul.index') }}" class="d-flex">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                placeholder="Search" name="name">
                                                
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Name</th>
                                            <th>Paket</th>
                                            <th>File Tugas</th>
                                            <th>Kelas</th>
                                            <th>Tanggal Upload</th>
                                            <th>Action</th>
                                           
                                           
                                        </tr>
                                        @foreach ($kumpul_tugas as $tugas)
                                            <tr>
                                            <td>
                                            {{ $tugas->name }}
                                            </td>
                                            <td>
                                            {{ $tugas->jenis_paket }}
                                            </td>
                                            <td>
                                            {{ $tugas->file }}
                                            </td>
                                            <td>
                                            {{ $tugas->kelas }}
                                            </td>
                                            <td>
                                            {{ $tugas->tanggal_upload }}
                                            </td>
                                            
                                            <td>
                                  <a href="{{ route('kumpul.download', $tugas->id) }}" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-download"></i> Download
                                                                </a>
                                                        <form onclick="return confirm('are you sure ? ')"  class="d-inline" action="  {{ route('kumpul.destroy', $tugas->id) }}" method="POST"
                                                            class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>

                                                        </form>
                                                        <!-- Modal Konfirmasi Penghapusan -->

                                                        <!-- ====== -->
                                                    </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="float-right">
                               
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
