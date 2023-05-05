@extends('admin.master')

@section('title', 'Módulo de Estilos')

@section('content')

    <div class="content-wrapper">
    
        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRACIÓN DE ESTILOS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> <i class="fas fa-paint-roller"></i> Estilos</li>
                    </ol>
                </nav>
            </div>

        </div>
        
        <div class="row">

            <div class="col-12 grid-margin stretch-card">

                <div class="card">

                    <form method="POST" action="{{ url('admin/estilos') }}" enctype="multipart/form-data" id="formEstilos">

                        @csrf

                        <div class="card-body">

                            <div class="form-group row">

                                @foreach($estilos as $k => $e)

                                <h3 class="card-title col-12">{{$k}}</h3>

                                    @foreach($e as $i)

                                        <div class="col-md-4 col-sm-12 mb-3">

                                            <div style="background:#eee;border:1px solid #ddd;padding:15px 36px;overflow:hidden;">
                                                <label><b>{{$i->nombre}}:</b></label>
                                                <input type='text' class="color-picker" name="valor[{{$i->estilo_id}}][]" style="width:90%;" value="{{$i->valor!="" ? $i->valor : ''}}" />
                                            </div>

                                        </div>

                                    @endforeach

                                @endforeach

                            </div>

                        </div>

                        <div class="card-footer">

                            @can('admin.estilos.actualizar')
                                <center><button type="submit" class="btn btn-dark btn-icon-split" id="guardarEstilos"><span class="icon text-white-50"><img src="{{ url('admin_assets/images/save.png') }}" width="32px"></span><span class="text">Guardar</span></button></center>
                            @endcan

                        </div>

                    </form>

                </div>
            
            </div>


        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{ asset('admin_assets/js/formpickers.js') }}"></script>

    <script>
        @can('admin.estilos.actualizar')
            $('#guardarEstilos').click(function(event){
                event.preventDefault();
                guardarEstilos();
            });

            window.guardarEstilos = function(){

                $("#guardarEstilos").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/estilos";
                let formData = new FormData($("#formEstilos")[0]); 
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
                        $("#guardarEstilos").prop('disabled', false);
                        if(response.code == "200")
                        {   
                            Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se han guardado los estilos correctamente',
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
                        $("#guardarEstilos").prop('disabled', false);

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