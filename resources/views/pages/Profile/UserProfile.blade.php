@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ auth()->user()->name }}</h2>
               
                <div class="row mt-sm-4">
                    <!-- Profile Section -->
                    
                    <div class="col-12 col-md-12 col-lg-12">
    <div class="card profile-widget">
        <!-- Profile Picture -->
        <div class="profile-widget-header text-center">
            @if(auth()->user()->rul == 'ADMIN')
                <img alt="image" 
                src="{{ asset('img/avatar/school.jpg') }}" 
                class="rounded-circle profile-widget-picture mb-4">
            @endif

            @if(auth()->user()->rul == 'PESERTA')
                <img alt="image" 
                src="{{ asset('img/avatar/avatar-1.png') }}" 
                class="rounded-circle profile-widget-picture mb-4">
            @endif
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div class="card">
        <form action="{{ route('user.update', auth()->user()->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-header">
                <h4>Edit Profile</h4>
            </div>

            <div class="card-body">
                <!-- Name and Password Fields -->
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        <div class="invalid-feedback">
                            Please fill in the first name
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="invalid-feedback">
                            Please fill in the password
                        </div>
                    </div>
                </div>

                <!-- Email and Phone Fields -->
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                        <div class="invalid-feedback">
                            Please fill in the email
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <label for="password2" class="d-block">Password Confirmation</label>
                        <input id="password2" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button class="btn btn-primary" type="submit">Save Changes</button>
            </div>
        </form>
    </div>
</div>


                             
                                        </div>
                                    </div>
                                </div>

                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
@endpush
