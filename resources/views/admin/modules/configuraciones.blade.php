@extends('admin.master')

@section('title', 'Módulo de Configuraciones')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRACIÓN DE CONFIGURACIONES
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> <i class="fas fa-cog"></i> Configuraciones</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-12 grid-margin stretch-card">

                <div class="card">

                    <form method="POST" action="{{ url('admin/configuraciones') }}" enctype="multipart/form-data" id="formConfiguraciones">

                        @csrf

                        <div class="card-body">

                            <div class="form-group row">

                                <h3 class="card-title col-12">Configuración</h3>

                                @foreach($configuraciones as $c)

                                    <div class="col-md-4 col-sm-12 mb-3">

                                        <div class="form-group" style="background:#eee;border:1px solid #ddd;padding:15px 36px;overflow:hidden;">
                                            <label><b>{{$c->nombre}}:</b></label>
                                            <input type='text' class="form-control" name="valor[]" style="width:90%;" value="{{$c->valor!="" ? $c->valor : ''}}" />
                                            <input type="hidden" name="configuracion_id[]" value="{{$c->configuracion_id}}">
                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                        <div class="card-footer">

                            @can('admin.configuracion.actualizar')
                                <center><button type="submit" class="btn btn-dark btn-icon-split" id="guardarConfiguraciones"><span class="icon text-white-50"><img src="{{ url('admin_assets/images/save.png') }}" width="32px"></span><span class="text">Guardar</span></button></center>
                            @endcan

                        </div>

                    </form>

                </div>

            </div>
        
        </div>

    </div>

@endsection


@section('scripts')

    <script>
        @can('admin.configuracion.actualizar')
            $('#guardarConfiguraciones').click(function(event){
                event.preventDefault();
                guardarConfiguracion();
            });

            window.guardarConfiguracion = function(){

                $("#guardarConfiguraciones").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/configuraciones";
                let formData = new FormData($("#formConfiguraciones")[0]); 
                formData.append('usuario',<?php echo '"'.Auth::user()->usuario.'"'; ?>)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        $("#guardarConfiguraciones").prop('disabled', false);
                        if(response.code == "200")
                        {   
                            Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha guardado la Configuración correctamente',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = response.url;
                                }
                            });
                        }
                        else 
                        {
                            Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar guardar el registro!'
                        })
                        }
                    },
                    error: function(response) {
                        $("#guardarConfiguraciones").prop('disabled', false);

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar guardar el registro!'
                        })
                    }
                });
            }
        @endcan

    </script>


@endsection