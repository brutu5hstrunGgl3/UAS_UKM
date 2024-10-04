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
            @if(auth()->user()->rul == 'ADMIN'|| auth()->user()->rul == 'PEMATERI')
                <h1>Learning module system</h1>
                <div class="section-header-button">
                    <a href="{{ route('lecturer.create') }}"
                        class="btn btn-primary">Tambah Pemateri</a>
                </div>
            @endif
               
            </div>
          
                
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
                           
                               
                            </div>
                            <div class="card-body">
                                <div class="float-left">

                                </div>
                                <div class="float-right">
                                    <form method="GET" action=" {{route('lecturer.index')}}">
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
                                            <th>Position</th>
                                            <th>Materi</th>
                                            <th>Jadwal</th>
                                            <th>Action</th>
                                          
                                        </tr>
                                        @foreach ($lecturers as $lecturer)
                                        <!-- //isi tabel nanti  -->
                                            <tr>     
                                            <td>
                                            {{$lecturer->name}}
                                            </td>
                                            <td>
                                            {{$lecturer->position}}
                                            </td>
                                            <td><a class= "url" href= "{{$lecturer->materi}}" style="color: gray; text-decoration: none;">
                                            {{$lecturer->materi}}
                                            </a></td>
                                            <td>
                                            {{$lecturer->jadwal}}
                                            </td>
                                            <td>
                                            @if(auth()->user()->rul == 'PESERTA')
                                            <div class="d-flex justify-content-center">
                                                         <a href=""
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Absen
                                                        </a>
                                                        @endif
                                            @if(auth()->user()->rul == 'ADMIN'|| auth()->user()->rul == 'PEMATERI')
                                            <div class="d-flex justify-content-center">
                                                         <a href="{{ route('lecturer.edit', $lecturer->id) }}" 
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                        <td>
                                                        <form onclick="return confirm('are you sure ? ')"  class="d-inline" action=" {{route('lecturer.destroy', $lecturer->id)}}" method="POST"
                                                            class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                        @endif

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
