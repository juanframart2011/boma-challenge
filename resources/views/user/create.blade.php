@extends( 'layout.main' )

@section( "title", 'Crear Usuario' )

@push('styles')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="{{ asset( 'plugins/src/filepond/filepond.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'plugins/src/filepond/FilePondPluginImagePreview.min.css' ) }}">
    <link href="{{ asset( 'plugins/css/light/filepond/custom-filepond.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'plugins/css/dark/filepond/custom-filepond.css' ) }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <link rel="stylesheet" href="{{ asset( 'plugins/src/sweetalerts2/sweetalerts2.css' ) }}">
@endpush

@section( 'content' )

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <form action="{{ route( 'user.save' ) }}" class="row mb-4 layout-spacing layout-top-spacing" id="user-form" method="post">
        
        <div class="row mb-4">
            <div class="col-sm-12">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12">
                <select class="form-control" id="role_id" name="role_id">
                    <option value="">Selecciona Rol</option>
                    @foreach( $roles as $role )
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-sm-12">
                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Repetir Contraseña">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection

@push('scripts')
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset( 'plugins/src/filepond/filepond.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginFileValidateType.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImageExifOrientation.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImagePreview.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImageCrop.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImageResize.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/FilePondPluginImageTransform.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/src/filepond/filepondPluginFileValidateSize.min.js' ) }}"></script>

    <script src="{{ asset( 'plugins/src/sweetalerts2/sweetalerts2.min.js' ) }}"></script>

    <script src="{{ asset( 'js/user.js' ) }}"></script>
@endpush