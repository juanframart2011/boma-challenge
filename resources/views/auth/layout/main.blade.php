<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield( 'title', config( 'app.name' ) ) - {{ config( 'app.name' ) }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset( 'assets/img/favicon.ico' ) }}"/>
    <link href="{{ asset( 'layouts/css/light/loader.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'layouts/css/dark/loader.css' ) }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset( 'layouts/loader.js' ) }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset( 'bootstrap/css/bootstrap.min.css' ) }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset( 'layouts/css/light/plugins.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'assets/css/light/authentication/auth-cover.css' ) }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset( 'layouts/css/dark/plugins.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'assets/css/dark/authentication/auth-cover.css' ) }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset( 'plugins/src/sweetalerts2/sweetalerts2.css' ) }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset( 'assets/css/light/components/modal.css' ) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset( 'plugins/css/light/sweetalerts2/custom-sweetalert.css' ) }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset( 'assets/css/dark/components/modal.css' ) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset( 'plugins/css/dark/sweetalerts2/custom-sweetalert.css' ) }}" rel="stylesheet" type="text/css" />


    <!-- END GLOBAL MANDATORY STYLES -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        baseUrl = "{{ config( 'app.url' ) }}";
    </script>
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>
                        
                    <div class="auth-cover">
    
                        <div class="position-relative">
    
                            <img src="{{ asset( 'img/boma-logo.png' ) }}" alt="{{ config( 'app.name' ) }}">
    
                            <h2 class="mt-5 text-white font-weight-bolder px-2">{{ config( 'app.name' ) }}</h2>
                            <p class="text-white px-2">Administrador</p>
                        </div>
                        
                    </div>

                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">
    
                            @yield( 'content' )
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset( 'plugins/src/global/vendors.min.js' ) }}"></script>
    <script src="{{ asset( 'bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    @stack('scripts')
</body>
</html>