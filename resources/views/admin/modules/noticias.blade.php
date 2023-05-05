@extends('admin.master')

@section('title', 'Módulo de Noticias')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE NOTICIAS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-newspaper"></i> Noticias</li>
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

            <div class="col-xl-8 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="txtTituloNoticia" style="font-size:14px;">Título: </label>
                    <input type="text" class="form-control form-control-sm" id="txtTituloNoticia" placeholder="Título de la Noticia...">
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoNoticiaBuscar" style="font-size:14px;">Estado:</label>
                    <select name="estadoNoticiaBuscar" id="estadoNoticiaBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="BuscarCategoriaNoticia" style="font-size:14px;">Categoría de la Noticia: </label>
                    <select id="BuscarCategoriaNoticia" name="BuscarCategoriaNoticia[]"class="form-control selectpicker" multiple data-live-search="true">
                        @if(isset($noticias_categorias) && count($noticias_categorias)>0)
                            @foreach ($noticias_categorias as $nc)
                                <option value="{{$nc['noticia_categoria_id']}}">{{$nc['noticia_categoria']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            
            @can('admin.noticias.crear')
            <div class="col-xl-6 col-md-6 col-sm-12 d-flex justify-content-end">

                <div class="form-group mt-20-sm mr-20-sm">
                    <a type="button" class="btn btn-sm btn-dark btn-fw"  href="{{ route('admin.noticias.create') }}"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Noticia</a>
                </div>

            </div>
            @endcan


        </div>


        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-newspaper"></i>
                            Listado de Noticias
                        </h4>
                        <section class="tbl-noticias">
                            @if(isset($noticias) && count($noticias) > 0)
                                
                                @include('admin.data.load_noticias_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Imagen</th>
                                                <th>Noticia</th>
                                                <th>Categorías</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="6">No se encontraron registros</td>
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
                                    <td style="font-size:14px">Editar Noticia</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Noticia</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Noticia</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Noticia</td>
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
                    loadnoticias(page);
                }
            }
        });
    
        $(document).on('click', '.tbl-noticias .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                // console.log(page);
                loadnoticias(page);
        });

        function loadnoticias(page)
        {
            let noticia = $('#txtTituloNoticia').val();
            let selectedcategorianoticia = [];
            for (let optioncn of document.getElementById('BuscarCategoriaNoticia').options)
            {
                if (optioncn.selected) {
                    selectedcategorianoticia.push(optioncn.value);
                }
            }
            let estadonoticia = $('#estadoNoticiaBuscar').val(); 
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/noticias?page="+page;

            $.ajax({
                url: url,
                method:'GET',
                data: {ntitulo: noticia,ncat: selectedcategorianoticia,nestado: estadonoticia}
            }).done(function (data) {
                $('.tbl-noticias').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }

        $('#txtTituloNoticia').on('keyup', function(e){
            let selectedcategorianoticia2 = [];
            for (let optioncn2 of document.getElementById('BuscarCategoriaNoticia').options)
            {
                if (optioncn2.selected) {
                    selectedcategorianoticia2.push(optioncn2.value);
                }
            }
            let noticia2 = this.value;
            let estadonoticia2 = $('#estadoNoticiaBuscar').val();
            ajaxloadnoticias(noticia2, selectedcategorianoticia2, estadonoticia2);
        });

        $('#BuscarCategoriaNoticia').on('change', function (e ){
            let selectedcategorianoticia3 = [];
            for (let optioncn3 of this.options)
            {
                if (optioncn3.selected) {
                    selectedcategorianoticia3.push(optioncn3.value);
                }
            }
            let noticia3 = $('#txtTituloNoticia').val();
            let estadonoticia3 = $('#estadoNoticiaBuscar').val();
            // console.log(selectedcategorianoticia3);
            ajaxloadnoticias(noticia3, selectedcategorianoticia3, estadonoticia3);
        });

        $('#estadoNoticiaBuscar').on('change', function(e){
            let selectedcategorianoticia4 = [];
            for (let optioncn4 of document.getElementById('BuscarCategoriaNoticia').options)
            {
                if (optioncn4.selected) {
                    selectedcategorianoticia4.push(optioncn4.value);
                }
            }
            let noticia4 = $('#txtTituloNoticia').val();
            let estadonoticia4 = this.value;
            ajaxloadnoticias(noticia4, selectedcategorianoticia4, estadonoticia4);
        });

        function ajaxloadnoticias(noticia, categoria, estado)
        {
            const url=$('meta[name=app-url]').attr("content") + "/admin" + "/noticias";
            $.ajax({
                headers: 
                {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method:'GET',
                data: {ntitulo: noticia,ncat: categoria,nestado: estado}
            }).done(function (data) {
                $('.tbl-noticias').html(data);
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }

        window.eliminarNoticia = function(noticia_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de eliminar la Noticia?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Eliminar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticias/"  + noticia_id;
                        let data = {
                            noticia_id: noticia_id
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
                                    loadnoticias();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha eliminado la noticia correctamente'
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

        window.desactivarNoticia = function(noticia_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de desactivar la Noticia?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Desactivar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticias" +  "/desactivar/" + noticia_id;
                            let data = {
                                noticia_id: noticia_id
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
                                        loadnoticias();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha desactivado la Noticia correctamente'
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

        window.activarNoticia = function(noticia_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de activar la Noticia?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Activar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticias" +  "/activar/" + noticia_id;
                            let data = {
                                noticia_id: noticia_id
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
                                        loadnoticias();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha activado la Noticia correctamente'
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