@extends( 'layout.main' )

@section( "title", 'Crear Categoría' )

@push('styles')

    <link rel="stylesheet" href="{{ asset( 'plugins/src/sweetalerts2/sweetalerts2.css' ) }}">
@endpush

@section( 'content' )

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Categoría</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <form action="{{ route( 'category.save' ) }}" class="row mb-4 layout-spacing layout-top-spacing" id="category-form" method="post">
        
        <div class="row mb-4">
            <div class="col-sm-12">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12">
                <input type="text" class="form-control" id="code" name="code" placeholder="Código">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-sm-12">
                <textarea class="form-control" id="description" name="description" placeholder="Descripción"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection

@push('scripts')
    
    <script src="{{ asset( 'plugins/src/sweetalerts2/sweetalerts2.min.js' ) }}"></script>
    <script src="{{ asset( 'js/category.js' ) }}"></script>
@endpush