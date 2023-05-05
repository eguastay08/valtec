@extends('admin.master')

@section('title', 'Módulo de Suscripciones')

@section('content')

<div class="content-wrapper">

    <div class="page-header row">

        <h3 class="page-title">
           ADMINISTRADOR DE SUSCRIPCIONES
        </h3>

        <div class="template-demo mt-20">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom"">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Suscripciones</li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="row">
        
        <div class="col-12 grid-margin">

            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">
                    <i class="fas fa-paper-plane"></i>
                        Listado de Emails Suscritos
                    </h4>
                    <section class="suscripciones">
                        @if(isset($suscripciones) && count($suscripciones) > 0)
                    
                                @include('admin.data.load_suscritos_data')
                        
                        @else 
                        
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Email</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="3">No se encontraron registros</td>
                                            </tr>
                                    
                                        </tbody>
                                    </table>
                                </div>

                
                        @endif
                    </section>
                </div>

            </div>

        </div>

    </div>

    <div class="row justify-content-center">
            <div class="col-sm-5 align-self-center text-center">
                <div class="card">
                    <div class="card-body">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2">Leyenda</th>
                                </tr>
                            </thead>
                            <tbody>
                
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Suscripción</td>
                                </tr>
                             
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

</div>

@endsection

@section('scripts')

    <script>

        $(document).ready(function() {

            function loadsuscripciones(page)
            {
                let url='';
                url=$('meta[name=app-url]').attr("content")  + "/admin" + "/suscripciones?page="+page;

                $.ajax({
                    url: url,
                    method:'GET'
                }).done(function (data) {
                    $('.suscripciones').html(data);
                }).fail(function () {
                    console.log("Failed to load data!");
                });
            }

            window.eliminarSuscripcion = function(hddsuscripcion_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de eliminar la Suscripcion?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Eliminar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") + "/admin/suscripciones/" + hddsuscripcion_id;
                            let data = {
                                suscripcion_id: hddsuscripcion_id
                            };
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: url,
                                type: "DELETE",
                                data: data,
                                success: function(response) {
                                    // console.log(response);
                                    if(response.code == "200")
                                    {
                                        loadsuscripciones();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha eliminado la Suscripción correctamente'
                                        });
                                    }
                                },
                                error: function(response) {                
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ERROR...',
                                        text: 'Se ha producido un error al intentar eliminar el registro!'
                                    })
                                }
                            });
                        }
                    })
            }

        });

    </script>

@endsection
