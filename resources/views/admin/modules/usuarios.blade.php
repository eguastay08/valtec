@extends('admin.master')

@section('title', 'Módulo de Usuario')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE USUARIOS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> <i class="fas fa-users"></i> Usuarios</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-xl-12">
                <div class="form-group">
                    <h5 class="mb-3">Buscar por:</h5>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="txtBuscarUsuario" style="font-size:14px;">Usuario:</label>
                    <input type="text" class="form-control form-control-sm" id="txtBuscarUsuario" placeholder="Nombre o Apellido del Usuario...">
                </div>
            </div>

            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoUsuarioBuscar" style="font-size:14px;">Rol:</label>
                    <select name="estadoUsuarioBuscar" id="estadoUsuarioBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Rol 1</option>
                        <option value="0">Rol 2</option>
                    </select>
                </div>
            </div>

            @can('admin.usuarios.crear')
            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group mr-20-sm">
                    <a type="button" class="btn btn-sm btn-dark btn-fw"  href="{{ route('admin.usuarios.create') }}"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Usuario</a>
                </div>
            </div>
            @endcan

        </div>

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-users"></i>
                            Listado de Usuarios
                        </h4>
                        <section class="tbl-usuarios">
                            @if(isset($usuarios) && count($usuarios) > 0)
                                
                                @include('admin.data.load_usuarios_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Email</th>
                                            <th>Dirección</th>
                                            <th>Teléfono</th></th>
                                            <th>Usuario</th>
                                            <th>Foto</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="10">No se encontraron registros</td>
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
                                    <td><img src="{{ url('admin_assets/images/edit.png') }}" alt="Editar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Editar Usuario</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Usuario</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Usuario</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Usuario</td>
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

        $(window).on('hashchange',function(){
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else{
                    loadusuarios(page);
                }
            }
        });

        $(document).on('click', '.tbl-usuarios .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                // console.log(page);
                loadusuarios(page);
        });

        function loadusuarios(page)
        {
            let url='';
            let txtusuariobuscar = $('#txtBuscarUsuario').val();
            let estado = $('#estadoUsuarioBuscar').val(); 

            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/usuarios?page="+page;

            $.ajax({
                url: url,
                method:'GET',
                data: {usuario: txtusuariobuscar,estado: estado}
            }).done(function (data) {
                $('.tbl-usuarios').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }

        $('#txtBuscarUsuario').on('keyup', function(e){
            let usuario = this.value;
            let estadousuario = $('#estadoUsuarioBuscar').val();
            ajaxloadusuarios(usuario, estadousuario);
        })

        $('#estadoUsuarioBuscar').on('change', function(e){
            let usuario = $('#txtBuscarUsuario').val();
            let estadousuario = this.value;
            ajaxloadusuarios(usuario, estadousuario);
        })

        function ajaxloadusuarios(usuario, estado)
        {
            const url=$('meta[name=app-url]').attr("content") + "/admin" + "/usuarios";
            $.ajax({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method:'GET',
                data: {usuario: usuario,estado: estado}
            }).done(function (data) {
                $('.tbl-usuarios').html(data);
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }

        window.eliminarUsuario = function(user_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de eliminar el Usuario?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Eliminar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/usuarios/"  + user_id;
                        let data = {
                            user_id: user_id
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
                                    loadusuarios();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha eliminado el usuario correctamente'
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

        window.desactivarUsuario = function(user_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de desactivar el Usuario?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Desactivar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/usuarios" +  "/desactivar/" + user_id;
                            let data = {
                                user_id: user_id
                            };
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: url,
                                type: "POST",
                                data: data,
                                success: function(response) {
                                    // console.log(response);
                                    if(response.code == "200")
                                    {
                                        loadusuarios();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha desactivado el Usuario correctamente'
                                        });
                                        // document.location.reload(true)
                                    }
                                },
                                error: function(response) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ERROR...',
                                        text: 'Se ha producido un error al intentar desactivar el registro!'
                                    })
                                }
                            });
                        }
                    })
        }

        window.activarUsuario = function(user_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de activar el Usuario?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Activar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/usuarios" +  "/activar/" + user_id;
                            let data = {
                                user_id: user_id
                            };
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: url,
                                type: "POST",
                                data: data,
                                success: function(response) {
                                    // console.log(response);
                                    if(response.code == "200")
                                    {
                                        loadusuarios();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha activado el Usuario correctamente'
                                        });
    
                                    }
                                },
                                error: function(response) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ERROR...',
                                        text: 'Se ha producido un error al intentar desactivar el registro!'
                                    })
                                }
                            });
                        }
                    })
        }

    </script>


@endsection