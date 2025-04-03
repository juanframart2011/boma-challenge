@extends( 'layout.main' )

@section( "title", 'Editar Usuario' )

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
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <form action="{{ route( 'user.update', $user->id ) }}" class="row mb-4 layout-spacing layout-top-spacing" id="user-form" method="put">
        
        <div class="row mb-4">
            <div class="col-sm-12">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ $user->name }}">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-sm-12">
                <select class="form-control" id="role_id" name="role_id">
                    @foreach( $roles as $role )
                        <option {{ ( $role->id == $user->role_id )? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Editar</button>
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

    <script type="text/javascript">
        // **Guardar la URL de la imagen actual**
        let existingImageUrl = "{{ asset($user->avatar) }}";
    </script>

    <script src="{{ asset( 'js/user.js' ) }}"></script>
    <script type="text/javascript">
        
        imageField.addFile( existingImageUrl );
    </script>

    <!-- END PAGE LEVEL SCRIPTS -->
@endpush