@extends('admin.master')

@section('title', 'Mantemiento Rol')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
            {{ isset($rol) ? 'FORMULARIO DE ACTUALIZACIÓN DE ROL' : 'FORMULARIO DE REGISTRO DE ROL' }}
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/roles') }}" class="colorfont"> <i class="fas fa-bezier-curve"></i> Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ isset($rol) ? 'Actualización de Rol':'Registro de Rol' }}</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-12 grid-margin stretch-card">

                <div class="card">

                    <form method="POST" action="{{ url('admin/roles') }}" id="formRol">

                        @csrf

                        <div class="card-body">

                            <h3 class="card-title">Datos del Rol</h3>

                            <div class="form-group row">
          
                                <div class="col-md-8 col-sm-12">
                                    <label for="nombreRol"><b><span style="color:#AB0505;">(*)</span> Rol:</b></label>
                                    <input type="text" class="form-control ml-2" id="nombreRol"  name="nombreRol" placeholder="Ingrese el Nombre del Rol.." value="{{ isset($rol) ? $rol->name : '' }}">
                                    <input type="hidden" name="hddrole_id" id="hddrole_id" value="{{ isset($rol) ? $rol->id : '' }}">
                                </div>
                                
                                <div class="col-md-4 col-sm-12 mt-2">
                                    <label for="chkEstadoRol"><b>Estado:</b></label>
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input type="checkbox" class="custom-control-input" name="chkEstadoRol" id="chkEstadoRol" {{isset($rol) && $rol->estado == 1 ? 'checked':''}}>  
                                        <label class="custom-control-label" for="chkEstadoRol">Activo</label>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">

                                <h5 class="text-muted col-md-8 col-sm-12">Listado de Permisos</h5>
                                <br /><br />
                                <div class="col-md-4 col-sm-12">
                                    <label for="chkselect_all">
                                        <input type="checkbox" class="mr-1" name="chkselect_all" id="chkselect_all">
                                        Seleccionar todos los Permisos
                                    </label>
                                </div>

                                @php($i=1)                 
                                @foreach($permissions as $permission)

                                    <div class="col-md-4 col-sm-6">

                                        <!-- <label>
                                            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                                            {{$permission->name}}
                                        </label> -->
                                        <label for="chkpermisos">
                                            <input type="checkbox" value="{{$permission->id}}" class="mr-1 check-per" name="chkpermisos[]" id="chkpermiso{{$i}}"  {{isset($permissions_rol) && in_array($permission->id, $permissions_rol)? 'checked' : ''}}>
                                            {{$permission->descripcion}}
                                        </label>

                                    </div>

                                    @php($i++)

                                @endforeach

                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="form-group">

                                <p class="help-block font-weight-bold"><span style="color:#AB0505;">Nota: (*) Campos Obligatorios</span></p> 
                                <a class="btn btn-danger btn-icon-split" href="{{ url('/admin/roles') }}"> <span class="icon text-white-50"><img src="{{ url('admin_assets/images/cancel.png') }}" width="24px"></span><span class="text">Cancelar</span></a>
                                <button type="submit" class="btn btn-dark btn-icon-split" id="guardarRol"><span class="icon text-white-50"><img src="{{ url('admin_assets/images/save.png') }}" width="24px"></span><span class="text">Guardar</span></button> 
                                                    
                            </div>
                        </div>
    
                    </form>

                </div>


            </div>
    
        </div>


    </div>

@endsection

@section('scripts')
    <script>

        // $('#chkselect_all').click(function ()
        // {
        //    $('.check-per').attr('checked',this.checked);
        // });

        // $('.check-per').click(function(){
        //     if($(".check-per").lenght == $(".check-per:checked").lenght)
        //     {
        //         $("#chkselect_all").attr("checked","checked");
        //     }
        //     else 
        //     {
        //         $('#chkselect_all').removeAttr("checked");
        //     }
        // })

        $('#chkselect_all').click(function ()
        {
            if (this.checked) {
                $(".check-per").each(function() {
                    this.checked=true;
                });
            } else {
                $(".check-per").each(function() {
                    this.checked=false;
                });
            }
        });

        $(".check-per").click(function () {
            if ($(this).is(":checked")) {
                var isAllChecked = 0;

                $(".check-per").each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $("#chkselect_all").prop("checked", true);
                }     
            }
            else {
                $("#chkselect_all").prop("checked", false);
            }
        });

        $('#guardarRol').click(function(event){
            event.preventDefault();
            let hddrole_id = $('#hddrole_id').val();
            if(hddrole_id!="")
            {
                actualizarRol(hddrole_id);
            }
            else 
            {
                guardarRol();
            }
        });

        window.guardarRol = function()
        {
            $("#guardarRol").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/roles";
            let formData = new FormData($("#formRol")[0]); 
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
                    $("#guardarRol").prop('disabled', false);
                    if(response.code == "200")
                    {   
                            Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha registrado el Rol correctamente',
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
                            let rolValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    rolValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                    rolValidation  + 
                                        '</ul>'
                            });
                    }
                },
                error: function(response) {
                    $("#guardarRol").prop('disabled', false);

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar guardar el registro!'
                    })
                }
            });
        }

        window.actualizarRol = function(hddrole_id)
        {
            $("#guardarRol").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/roles/" + hddrole_id;
            let formDataEditar = new FormData($("#formRol")[0]); 
            formDataEditar.append('_method', 'PUT');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                enctype: 'multipart/form-data',
                data: formDataEditar,
                processData: false,  
                contentType: false,  
                success: function(response) {
                    $("#guardarRol").prop('disabled', false);
                    if(response.code == "200")
                    {   
                            Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado el Rol correctamente',
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
                            let rolValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    rolValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                    rolValidation  + 
                                        '</ul>'
                            });
                    }
                },
                error: function(response) {
                    $("#guardarRol").prop('disabled', false);

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar guardar el registro!'
                    })
                }
            });
        }


    </script>
@endsection