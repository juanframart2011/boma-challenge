@extends( 'layout.main' )

@section( "title", 'Detalle campaña' )

@push('styles')
    
    <link href="{{ asset( 'assets/css/light/components/accordions.css' ) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset( 'assets/css/dark/components/accordions.css' ) }}" rel="stylesheet" type="text/css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/src/glightbox/glightbox.min.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/src/splide/splide.min.css' ) }}">

    <link rel="stylesheet" type="text/css" href="{{ asset( 'assets/css/light/components/tabs.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'assets/css/light/apps/ecommerce-details.css' ) }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset( 'assets/css/dark/components/tabs.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'assets/css/dark/apps/ecommerce-details.css' ) }}">
    <!--  END CUSTOM STYLE FILE  -->
@endpush

@section( 'content' )

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Campaña</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalle</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row layout-top-spacing">

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">

            <div class="widget-content widget-content-area br-8">

                <div class="row justify-content-center">
                    <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-7 col-sm-9 col-12 pe-3">
                        <!-- Swiper -->
                        <div id="main-slider" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li class="splide__slide">
                                        <a href="{{ asset( $campaign->image ) }}" class="glightbox">
                                            <img alt="ecommerce" src="{{ asset( $campaign->image ) }}">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div id="thumbnail-slider" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li class="splide__slide"><img alt="{{ $campaign->name }}" src="{{ asset( $campaign->image ) }}"></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-5 col-lg-12 col-md-12 col-12 mt-xl-0 mt-5 align-self-center">

                        <div class="campaign-details-content">
                            
                            <h3 class="campaign-title mb-0">{{ $campaign->name }}</h3>

                            <hr class="mb-4">

                            <div class="row color-swatch mb-4">
                                <div class="col-xl-3 col-lg-6 col-sm-6 align-self-center">Estatus</div>
                                <div class="col-xl-9 col-lg-6 col-sm-6">{{ ( $campaign->active )? 'Activo' : 'No Activo' }}</div>
                            </div>
                            
                            <div class="row color-swatch mb-4">
                                <div class="col-xl-3 col-lg-6 col-sm-6 align-self-center">Descripción</div>
                                <div class="col-xl-9 col-lg-6 col-sm-6">{!! $campaign->description !!}</div>
                            </div>

                            <div class="row size-selector mb-4">
                                <div class="col-xl-3 col-lg-6 col-sm-6 align-self-center">Presupuesto</div>
                                <div class="col-xl-9 col-lg-6 col-sm-6">{{ $campaign->presupuesto }}</div>
                            </div>

                            <div class="row quantity-selector mb-4">
                                <div class="col-xl-6 col-lg-6 col-sm-6 mt-sm-3">Fecha</div>
                                <div class="col-xl-6 col-lg-6 col-sm-6">{{ $campaign->fecha }}</div>
                            </div>

                            <div class="row quantity-selector mb-4">
                                <div class="col-xl-6 col-lg-6 col-sm-6 mt-sm-3">Fecha de Creación</div>
                                <div class="col-xl-6 col-lg-6 col-sm-6">{{ $campaign->created_at }}</div>
                            </div>

                            <div class="row quantity-selector mb-4">
                                <div class="col-xl-6 col-lg-6 col-sm-6 mt-sm-3">Fecha de Modificación</div>
                                <div class="col-xl-6 col-lg-6 col-sm-6">{{ $campaign->updated_at }}</div>
                            </div>

                            <hr class="mb-5 mt-4">
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{ asset( 'plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/glightbox/glightbox.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/splide/splide.min.js' ) }}"></script>
    <script src="{{ asset( 'assets/js/apps/ecommerce-details.js' ) }}"></script>  
@endpush