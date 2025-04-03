@extends( 'auth.layout.main' )
@section( "title", 'Login' )
@section( 'content' )
    
     @if( !$errors->isEmpty() )

        <div class="alert alert-arrow-right alert-icon-right alert-light-primary mb-4" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
            @foreach ( $errors->all() as $error )
                <strong>{{$error}}</strong><br>
            @endforeach
        </div> 
    @endif

    <form action="{{ route( 'auth.validate-login' ) }}" class="row" method="POST">
        <div class="col-md-12 mb-3">
            
            <h2>Ingresar</h2>
            <p>Coloca tus credenciales para ingresar</p>                                    
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old( 'email' ) }}">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-4">
                <label class="form-label" for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
        </div>
        @csrf
        <div class="col-12">
            <div class="mb-4">
                <button type="submit" class="btn btn-secondary w-100">ENTRAR</button>
            </div>
        </div>
    </form>
@endsection