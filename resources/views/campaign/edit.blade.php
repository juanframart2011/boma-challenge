@extends( 'layout.main' )

@section( "title", 'Editar campaña' )

@push('styles')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="{{ asset( 'plugins/src/filepond/filepond.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'plugins/src/filepond/FilePondPluginImagePreview.min.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/src/tagify/tagify.css' ) }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset( 'assets/css/light/forms/switches.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/css/light/editors/quill/quill.snow.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/css/light/tagify/custom-tagify.css' ) }}">
    <link href="{{ asset( 'plugins/css/light/filepond/custom-filepond.css' ) }}" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" type="text/css" href="{{ asset( 'assets/css/dark/forms/switches.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/css/dark/editors/quill/quill.snow.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/css/dark/tagify/custom-tagify.css' ) }}">
    <link href="{{ asset( 'plugins/css/dark/filepond/custom-filepond.css' ) }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <link rel="stylesheet" href="{{ asset( 'plugins/src/sweetalerts2/sweetalerts2.css' ) }}">
    
    <<!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" href="{{ asset( 'assets/css/light/apps/ecommerce-create.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'assets/css/dark/apps/ecommerce-create.css' ) }}">
    <!--  END CUSTOM STYLE FILE  -->
@endpush

@section( 'content' )

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">campaña</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <form action="{{ route( 'campaign.update', $campaign->id ) }}" class="row mb-4 layout-spacing layout-top-spacing" id="campaign-form" method="put">

        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de campaña" value="{{ $campaign->name }}">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label>Descripción</label>
                        <div id="description" name="description">{{ $campaign->description }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">

                        <div class="row">
                            <div class="col-md-12">
                                <label for="image">Imagen Principal</label>
                                <div class="multiple-file-upload">
                                    <input type="file" 
                                        class="filepond file-image"
                                        name="filepond"
                                        id="image"
                                        data-allow-reorder="true"
                                        data-max-file-size="3MB"
                                        data-max-files="5">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <div class="switch form-switch-custom switch-inline form-switch-primary mt-4">
                            <input class="switch-input" type="checkbox" role="switch" id="active" name="active" {{ ( $campaign->active )? 'checked': '' }}>
                            <label class="switch-label" for="active">Mostrar publicamente</label>
                        </div>
                    </div>                    
                </div>
            </div>            
        </div>

        <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="row">
                <div class="col-xxl-12 col-xl-8 col-lg-8 col-md-7 mt-xxl-0 mt-4">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row">
                            <div class="col-xxl-12 col-md-6 mb-4">
                                <label for="fecha">Fecha</label>
                                <input type="text" class="form-control" id="fecha" name="fecha" value="{{ $campaign->fecha }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-4 col-lg-4 col-md-5 mt-4">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <label for="presupuesto">Presupuesto</label>
                                <input type="number" class="form-control" name="presupuesto" id="presupuesto" value="{{ $campaign->presupuesto }}">
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-success w-100" type="submit">Editar Campaña</button>
                            </div>
                        </div>                                            
                    </div>
                </div>
            </div>
        </div>    
    </form>
@endsection

@push('scripts')
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset( 'plugins/src/editors/quill/quill.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/filepond.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginFileValidateType.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImageExifOrientation.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImagePreview.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImageCrop.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImageResize.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImageTransform.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/filepondPluginFileValidateSize.min.js' ) }}"></script>

    <script src="{{ asset( 'plugins/src/sweetalerts2/sweetalerts2.min.js' ) }}"></script>

    <script type="text/javascript">
        // **Guardar la URL de la imagen actual**
        let existingImageUrl = "{{ asset($campaign->image) }}";
    </script>

    <script src="{{ asset( 'js/campaign.js' ) }}"></script>
    <script type="text/javascript">
        
        imageField.addFile( existingImageUrl );
    </script>

    <!-- END PAGE LEVEL SCRIPTS -->
@endpush