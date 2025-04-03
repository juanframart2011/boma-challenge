@extends( 'layout.main' )

@section( "title", 'Lista de Campañas' )

@push('styles')
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/src/table/datatable/datatables.css' ) }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/css/light/table/datatable/dt-global_style.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'plugins/css/dark/table/datatable/dt-global_style.css' ) }}">
    <!--  END CUSTOM STYLE FILE  -->

    <link rel="stylesheet" href="{{ asset( 'plugins/src/sweetalerts2/sweetalerts2.css' ) }}">
    
    <link href="{{ asset( 'assets/css/dark/scrollspyNav.css' ) }}" rel="stylesheet" type="text/css" />

    <style>
        #campaign-list img {
            border-radius: 18px;
        }
    </style>
@endpush

@section( 'content' )

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Campaña</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lista</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <table id="campaign-list" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th>URL</th>
                            <th>Fecha de Creación</th>                            
                            <th class="no-content text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse( $categories as $campaign )
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        @if( !empty( $campaign->image ) )
                                            <div class="avatar">
                                                <img src="{{ asset( $campaign->image ) }}" alt="{{ $campaign->name }}" class="rounded-circle" />
                                            </div>
                                        @endif

                                        <div class="d-flex flex-column">
                                            <span class="text-truncate fw-bold">{{ $campaign->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $campaign->code }}</td>
                                <td>{{ $campaign->url }}</td>
                                <td>{{ $campaign->created_at }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="z-index:2;">
                                            <a class="dropdown-item" href="{{ route( 'campaign.edit', $campaign->id ) }}">Editar</a>
                                            <a class="dropdown-item btn-delete" data-id="{{ $campaign->id }}" data-name="{{ $campaign->name }}" href="#">Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay campañas disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset( 'plugins/src/sweetalerts2/sweetalerts2.min.js' ) }}"></script>
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset( 'plugins/src/table/datatable/datatables.js' ) }}"></script>
    <script>
        productList = $('#campaign-list').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10 
        });

        $( document ).ready( function(){

            $( document ).on( "click", ".btn-delete", function( event ){
                event.preventDefault();

                var id = $( this ).data("id");
                var name = $( this ).data("name");
                var url = "{{ route( 'campaign.delete' ) }}";

                Swal.fire({
                    title: '¿Estas seguro de eliminar la categoria '+name+'?',
                    text: "¡Al eliminarlo no se podrá recuperar el registro!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: url,
                            type: 'post',
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            data: {
                                id:id
                            },
                            success: function (data) {
                                if( data.success ){

                                    Swal.fire(
                                      'Eliminado!',
                                      data.message,
                                      'success'
                                    );
                                    window.location.reload();
                                }
                            }
                        });
                    }
                })
            })
        });
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->   
@endpush