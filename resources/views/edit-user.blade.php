<link href="{{ asset('admin_assets/vendors/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet">
@extends('template')

@section('content')

    <div class="container-xxl container-fluid">

        @isset($bannerPago)
           <div class="row mb-4">

                @foreach($bannerPago as $bp)

                    
                    <div class="col-md-{{$bp['columnas']}} col-12">

                        <a href="{{ !empty($bp['link']) ? $bp['link']:''}}" {{$bp['link']!="" ? $bp['link'] : ''}} class="as-banner-row">

                    <img id="banner-{{$bp['banner_id']}}" class="img-fluid banner-main bradius" data-src="{{asset($bp['banner'])}}" src="{{asset($bp['banner'])}}" style="width: 100%;">

                    @if($bp['banner__estilo_id'] == 2)
                        <img id="banner-super-{{$bp['banner_id']}}" class="img-fluid banner-hoover bradius" data-src="{{asset($bp['banner_superpuesto'])}}" src="{{asset($bp['banner_superpuesto'])}}" style="width: 100%;">
                    @endif

                    </a>

                    </div>

                @endforeach

           </div>
        @endisset
  
        <div class="row">

            <div class="col-12 pb-10 mb-20">
                <h3 class="mt-4 text-center">FORMULARIO DE ACTUALIZACIÓN DE USUARIO</h3>
                <hr>
            </div>
        </div>
        <div class="content-wrapper">
<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <form method="POST" action="{{ url('profile/upd') }}" enctype="multipart/form-data" id="formUsuario">

                @csrf
                
                <div class="card-body">

                    <h3 class="card-title">Datos del Usuario</h3>

                    <div class="form-group row">

                        <div class="col-md-6 col-sm-12">
                            <input type="hidden" name="hddusuario_id" id="hddusuario_id" value="{{ isset($usuario) ? $usuario->user_id : '' }}">
                            <label for="nombreUsuario"><b><span style="color:#AB0505;">(*)</span> Nombres:</b></label>
                            <input type="text" class="form-control ml-2" id="nombreUsuario"  name="nombreUsuario" placeholder="Ingrese el Nombre del Usuario.." value="{{ isset($usuario) ? $usuario->nombres : '' }}">
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="apellidoUsuario"><b><span style="color:#AB0505;">(*)</span> Apellidos:</b></label>
                            <input type="text" class="form-control ml-2" id="apellidoUsuario"  name="apellidoUsuario" placeholder="Ingrese el Apellido del USuarios.." value="{{ isset($usuario) ? $usuario->apellidos : '' }}">
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-12 col-sm-12">
                            <label  for="emailUsuario"><b><span style="color:#AB0505;">(*)</span> Email:</b></label>
                            <input readonly type="text" class="form-control ml-2" id="emailUsuario"  name="emailUsuario" placeholder="Ingrese el Email del Usuario.." value="{{ isset($usuario) ? $usuario->email : '' }}">
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="direccionUsuario"><b>Direccion:</b></label>
                            <input type="text" class="form-control ml-2" id="direccionUsuario"  name="direccionUsuario" placeholder="Ingrese la dirección del USuarios.." value="{{ isset($usuario) ? $usuario->direccion : '' }}">
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-6 col-sm-12">
                            <label for="telefonoUsuario"><b>Teléfono:</b></label>
                            <input type="text" class="form-control ml-2" id="telefonoUsuario"  name="telefonoUsuario" placeholder="Ingrese el Teléfono del Usuario.." value="{{ isset($usuario) ? $usuario->telefono : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-6 col-sm-12">
                            <label for="contraseniaUsuario"><b><span style="color:#AB0505;">(*)</span> Contraseña:</b></label>
                            <input type="password" class="form-control ml-2" id="contraseniaUsuario"  name="contraseniaUsuario" placeholder="Ingrese la Contraseña del Usuario.." 
                            @isset($usuario)
                                data-toggle="tooltip" data-placement="top" title="Ingrese la nueva contraseña si desea modificarla, caso contrario dejarla en blanco"
                            @endisset
                            >
                            <input type="hidden" name="contaseniaUsuarioActual" id="contaseniaUsuarioActual" value="{{ isset($usuario) ? $usuario->password : '' }}">
                            <small class="text-muted  ml-2"><span style="color:#AB0505;">Las contraseñas no deben contener espacios en blanco</span></small>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="confirmarContraseniaUsuario"><b><span style="color:#AB0505;">(*)</span> Confirmar Contraseña:</b></label>
                            <input type="password" class="form-control ml-2" id="confirmarContraseniaUsuario"  name="confirmarContraseniaUsuario" placeholder="Ingrese el Usuario.."
                            @isset($usuario)
                                data-toggle="tooltip" data-placement="top" title="confirme la contraseña si desea modificarla, caso contrario dejarla en blanco"
                            @endisset
                            >
                            <small class="text-muted  ml-2"><span style="color:#AB0505;">Las contraseñas no deben contener espacios en blanco</span></small>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <div class="form-group">

                        <p class="help-block font-weight-bold"><span style="color:#AB0505;">Nota: (*) Campos Obligatorios</span></p> 
                        <a class="btn btn-danger btn-icon-split" href="{{ url('/') }}"> <span class="icon text-white-50"><img src="{{ url('admin_assets/images/cancel.png') }}" width="24px"></span><span class="text">Cancelar</span></a>
                        <button type="submit" class="btn btn-dark btn-icon-split" id="guardarUsuario"><span class="icon text-white-50"><img src="{{ url('admin_assets/images/save.png') }}" width="24px"></span><span class="text">Guardar</span></button> 
                                            
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>


</div>

    </div>

@endsection
@section('scripts')

    <script>
        $('#guardarUsuario').click(function(event){
            event.preventDefault();
            actualizarUsuario();
        });

        window.actualizarUsuario = function()
        {
            $("#guardarUsuario").prop('disabled', true);
            let url = "{{route('profile.update')}}";
            let FormDataUsuarioEditar = new FormData($("#formUsuario")[0]); 
            FormDataUsuarioEditar.append('_method', 'PUT');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                enctype: 'multipart/form-data',
                data: FormDataUsuarioEditar,
                processData: false,  
                contentType: false,  
                success: function(response) {
                    $("#guardarUsuario").prop('disabled', false);
                    if(response.code == "200")
                    {   
                            Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado el Usuario correctamente',
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
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let usuarioValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    usuarioValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                usuarioValidation  + 
                                        '</ul>'
                            });
                    }
                    else if(response.code=="423")
                    {
                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'La contraseña debe tener un mínimo de 6 carácteres'
                            });
                    }
                    else if(response.code=="424")
                    {
                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'Las Contraseñas no coinciden!'
                            });
                    }
                },
                error: function(response) {
                    $("#guardarUsuario").prop('disabled', false);

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar guardar el registro!'
                    })
                }
            });
        }

    </script>
  <script src="{{ asset('admin_assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>

@endsection