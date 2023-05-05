@extends('admin.master')

@section('title', 'Módulo de Roles')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE ROLES
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-bezier-curve"></i> Roles</li>
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

            <div class="col-xl-7 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="txtBuscarRol" style="font-size:14px;">Rol: </label>
                    <input type="text" class="form-control form-control-sm" id="txtBuscarRol" placeholder="Rol que desea buscar...">
                </div>
            </div>

            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoRolBuscar" style="font-size:14px;">Estado:</label>
                    <select name="estadoRolBuscar" id="estadoRolBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            
        </div>

        @can('admin.roles.crear')
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 d-flex justify-content-end">

                <div class="form-group mr-20-sm">
                <a type="button" class="btn btn-sm btn-dark btn-fw"  href="{{ route('admin.roles.create') }}"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Rol</a>
                </div>

            </div>
        </div>
        @endcan

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-bezier-curve"></i>
                            Listado de Roles
                        </h4>
                        <section class="tbl-roles">
                            @if(isset($roles) && count($roles) > 0)
                                
                                @include('admin.data.load_roles_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="4">No se encontraron registros</td>
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
                                    <td style="font-size:14px">Editar Rol</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Rol</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Rol</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Rol</td>
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
                    loadroles(page);
                }
            }
        });

        $(document).on('click', '.tbl-roles .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                // console.log(page);
                loadroles(page);
        });

        function loadroles(page)
        {
            let url='';
            let rolbuscar = $('#txtBuscarRol').val();
            let estadorolbuscar = $('#estadoRolBuscar').val(); 

            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/roles?page="+page;

            $.ajax({
                url: url,
                method:'GET',
                data: {rol: rolbuscar,estado: estadorolbuscar}
            }).done(function (data) {
                $('.tbl-roles').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }

        $('#txtBuscarRol').on('keyup', function(e){
            let rol = this.value;
            let estadorol = $('#estadoRolBuscar').val();
            ajaxloadroles(rol, estadorol);
        })

        $('#estadoRolBuscar').on('change', function(e){
            let rol = $('#txtBuscarRol').val();
            let estadorol = this.value;
            ajaxloadroles(rol, estadorol);
        })

        function ajaxloadroles(rol, estado)
        {
            const url=$('meta[name=app-url]').attr("content") + "/admin" + "/roles";
            $.ajax({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method:'GET',
                data: {rol: rol,estado: estado}
            }).done(function (data) {
                $('.tbl-roles').html(data);
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }

        window.eliminarRol = function(rol_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de eliminar el Rol?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Eliminar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/roles/"  + rol_id;
                        let data = {
                            id: rol_id
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
                                    loadroles();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha eliminado el Rol correctamente'
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

        window.desactivarRol = function(rol_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de desactivar el Rol?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Desactivar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/roles" +  "/desactivar/" + rol_id;
                            let data = {
                                rol_id: rol_id
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
                                        loadroles();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha desactivado el Rol correctamente'
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

        window.activarRol = function(rol_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de activar el Rol?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Activar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/roles" +  "/activar/" + rol_id;
                            let data = {
                                rol_id: rol_id
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
                                        loadroles();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha activado el Rol correctamente'
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
