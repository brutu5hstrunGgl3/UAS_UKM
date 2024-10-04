@extends('layouts.app')

@section('title', ' Lms Sekolah Dasar Negri')


@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Sistem learning Bimbel komputer 77 </h1>
                <div class="section-header-breadcrumb">
                    
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"></h2>
                

                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Albums</h4>
                            </div>
                            <div class="card-body">
                                <div class="owl-carousel owl-theme slider"
                                    id="slider1">
                                    <div><img alt="image"
                                            src="img/771.jpg"></div>
                                    <div><img alt="image"
                                            src="img/772.jpg"></div>
                                    <div><img alt="image"
                                            src="img/773.jpg"></div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Berita</h4>
                            </div>
                            <div class="card-body">
                                <div class="owl-carousel owl-theme slider"
                                    id="slider2">
                                    <div><img alt="image"
                                            src="img/773.jpg">
                                        <div class="slider-caption">

                                            <!-- <div class="slider-title active"><a href =""></a>Image 1</div> -->
                                            
                                        </div>
                                    </div>
                                    <div><img alt="image"
                                            src="">
                                        <div class="slider-caption">
                                        <div class="breadcrumb-item active"><a href=""></a></div>
                                            <div class="slider-description">
                                               </div>
                                        </div>
                                    </div>
                                    <div><img alt="image"
                                            src="">
                                        <div class="slider-caption">
                                            <div class="slider-title"></div>
                                            <div class="slider-description"></div>
                                        </div>
                                    </div>
                                    
                                        </div>
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-slider.js') }}"></script>
@endpush
