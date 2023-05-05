@extends('admin.master')

@section('title', 'Módulo de Noticias Categorías')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE NOTICIAS CATEGORÍAS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fab fa-hacker-news-square"></i> Noticias Categorías</li>
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
                    <label for="txtBuscarNoticiaCategoria" style="font-size:14px;">Noticia Categoría: </label>
                    <input type="text" class="form-control form-control-sm" id="txtBuscarNoticiaCategoria" placeholder="Código o nombre de la Categoría para la Noticia...">
                </div>
            </div>

            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoNoticiaCategoriaBuscar" style="font-size:14px;">Estado:</label>
                    <select name="estadoNoticiaCategoriaBuscar" id="estadoNoticiaCategoriaBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            
        </div>

        @can('admin.noticias_categorias.crear')
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 d-flex justify-content-end">

                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw" data-toggle="modal" data-target="#ModalNoticiaCategoria"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Noticia Categoría</button>
                </div>

            </div>
        </div>
        @endcan

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fab fa-hacker-news-square"></i>
                            Listado de Noticias Categorías
                        </h4>
                        <section class="noticias_categoria">
                            @if(isset($noticias_categoria) && count($noticias_categoria) > 0)
                                
                                @include('admin.data.load_noticias_categorias_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Noticia Categoría</th>
                                            <th>URL</th>
                                            <th>Subcategorías</th>                         
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
                                    <td style="font-size:14px">Editar Noticia Categoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Noticia Categoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Noticia Categoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Noticia Categoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/eye.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Visualizar Subcategorías</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

    <!-- @can('admin.categorias.crear') -->
     <!-- Modal Agregar -->
     <div class="modal fade" id="ModalNoticiaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formNoticiaCategoria" name="formNoticiaCategoria">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalNoticiaCategoria" style="color:white !important">AGREGAR NOTICIA CATEGORÍA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalNoticiaCategoria()">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                    
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card mb-4">

                                    <div class="card-body">

                                        <div id="error-div"></div>
                                
                                        <div class="form-group">
                                            <label for="txtNoticiaCategoria"><b>Noticia Categoría:</b></label>
                                            <input type="hidden" name="hddNoticiaCategoria_id" id="hddNoticiaCategoria_id" value="">
                                            <input type="hidden" name="parentActual" id="parentActual" value="">
                                            <input type="hidden" name="slugActual" id="slugActual" value="">
                                            <input type="text" class="form-control ml-2" id="txtNoticiaCategoria"  name="txtNoticiaCategoria" aria-describedby="emailHelp"
                                                placeholder="Ingrese la categoría para la Noticia">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtDescripcionNoticiaCategoria"><b>Descripción:</b></label>
                                            <textarea class="form-control ml-2" name="txtDescripcionNoticiaCategoria" id="txtDescripcionNoticiaCategoria" cols="20" rows="3" placeholder="Ingrese la Descripción.."></textarea>
                                        </div>

                                        @include('admin.partials.select-noticias-categorias-padres')
                                        
                                        <div class="form-group">
                                            <label for="chkEstadoNoticiaCategoria"><b>Estado:<b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoNoticiaCategoria" id="chkEstadoNoticiaCategoria" checked>  
                                                <label class="custom-control-label" for="chkEstadoNoticiaCategoria">Activo</label>
                                            </div>
                                        </div>
                                    
                                
                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarNoticiaCategoria"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarNoticiaCategoria" data-dismiss="modal" onclick="limpiarModalNoticiaCategoria()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- @endcan -->

@endsection

@section('scripts')

    <script>

        $(window).on('hashchange',function(){
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else{
                    loadNoticiasCategorias(page);
                }
            }
        });

        $(document).ready(function() {

            
            $(document).on('click', '.noticias_categoria .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadNoticiasCategorias(page);
            });

            function loadNoticiasCategorias(page)
            {
                let url='';
                let BuscarNoticiaCategoria = $('#txtBuscarNoticiaCategoria').val();
                let BuscarestadoCategoria = $('#estadoNoticiaCategoriaBuscar').val(); 
                url=$('meta[name=app-url]').attr("content")  + "/admin" + "/noticia_categoria?page="+page;

                $.ajax({
                    url: url,
                    method:'GET',
                    data: {noticia_categoria: BuscarNoticiaCategoria, estado: BuscarestadoCategoria}
                }).done(function (data) {
                    $('.noticias_categoria').html(data);
                }).fail(function () {
                    console.log("Failed to load data!");
                });
            }

            $('#txtBuscarNoticiaCategoria').on('keyup', function(e){
                let noticia_categoria = this.value;
                let estadonoticiacategoria = $('#estadoNoticiaCategoriaBuscar').val();
                ajaxloadNoticiasCategorias(noticia_categoria, estadonoticiacategoria);
            });

            
            $('#estadoNoticiaCategoriaBuscar').on('change', function(e){
                let noticia_categoria2 = $('#txtBuscarNoticiaCategoria').val();
                let estadonoticiacategoria2 = this.value;
                ajaxloadNoticiasCategorias(noticia_categoria2, estadonoticiacategoria2);
            })

            function ajaxloadNoticiasCategorias(noticia_categoria, estado)
            {
                const url=$('meta[name=app-url]').attr("content") + "/admin" + "/noticia_categoria";
                $.ajax({
                    headers: 
                    {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method:'GET',
                    data: {noticia_categoria:noticia_categoria, estado: estado}
                }).done(function (data) {
                    $('.noticias_categoria').html(data);
                }).fail(function () {
                    console.log("Error al cargar los datos");
                });
            }

            $('#formNoticiaCategoria').submit(function(event){
                event.preventDefault();
                let hddNoticiaCategoria_id = $('#hddNoticiaCategoria_id').val();
                if(hddNoticiaCategoria_id!="")
                {
                    ActualizarNoticiaCategoria(hddNoticiaCategoria_id);
                }
                else 
                {
                    GuardarNoticiaCategoria();
                }
            });

            
            window.limpiarModalNoticiaCategoria = function() {
                $('#tituloModalNoticiaCategoria').html('AGREGAR CATEGORÍA');
                $('#hddNoticiaCategoria_id').val("");
                $('#txtNoticiaCategoria').val("");
                $('#txtDescripcionNoticiaCategoria').val("");
                $('#txtNoticiaCategoriaPadre').val("0");
                $('#chkEstadoNoticiaCategoria').prop('checked', true);
                $('#parentActual').val("");
                $('#slugActual').val("");
            }

            window.GuardarNoticiaCategoria = function()
            {
                $("#btnGuardarNoticiaCategoria").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin" + "/noticia_categoria";
                let data = {
                    noticia_categoria: $("#txtNoticiaCategoria").val(),
                    descripcion: $("#txtDescripcionNoticiaCategoria").val(),
                    noticiacategoriapadre: $('#txtNoticiaCategoriaPadre').val(),
                    activo: $('#chkEstadoNoticiaCategoria').prop('checked'),
                    usuario:<?php echo '"'.Auth::user()->usuario.'"'; ?>
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#btnGuardarNoticiaCategoria").prop('disabled', false);
                        if(response.code == "200")
                        {
                            
                                $("#ModalNoticiaCategoria").modal('hide');
                                limpiarModalNoticiaCategoria();
                                loadNoticiasCategorias();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha registrado la Categoría de la Noticia correctamente'
                                });
                        }
                        else  if(response.code == "422")
                        {
                                let errors = response.errors;
                                console.log(errors);
                                if (typeof errors.categoria !== 'undefined' || typeof errors.categoria !== "") 
                                {
                                    categoriavalidation = '<li>' + errors.categoria + '</li>';
                                }
                                
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR...',
                                    html: '<ul>'+
                                            categoriavalidation  + 
                                            '</ul>'
                                });
                        }
                        else if(response.code=="426")
                        {
                            Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR!',
                                    text: 'La Categoría de la Noticia ya Existe!'
                                });
                        }
                        else if(response.code=="427")
                        {
                            Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR!',
                                    text: 'La subcategoría ya Existe para esta Categoría de la Noticia!'
                                });
                        }
                        else 
                        {
                            Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR!',
                                    text: 'Ha ocurrido un error al intentar registrar la categoría!'
                                });
                        }
                    }
                })

            }

            window.mostrarNoticiaCategoria = function(noticia_categoria_id)
            {
                url=$('meta[name=app-url]').attr("content") + "/admin" + "/noticia_categoria/" +noticia_categoria_id;
                $("#ModalNoticiaCategoria").modal('show');
                $.ajax({
                    url: url,
                    method:'GET'
                }).done(function (data) {
                    // let valores = JSON.parse(data)
                    // console.log(data);
                    $('#tituloModalNoticiaCategoria').html('EDITAR NOTICIA CATEGORÍA: ' +data.noticia_categoria);
                    $('#hddNoticiaCategoria_id').val(noticia_categoria_id);
                    $('#txtNoticiaCategoria').val(data.noticia_categoria);
                    $('#txtDescripcionNoticiaCategoria').val(data.descripcion);
                    $('#txtNoticiaCategoriaPadre').val(data.parent_id);
                    $('#parentActual').val(data.parent_id);
                    $('#slugActual').val(data.url);
                    if(data.estado == "1")
                    {
                        $('#chkEstadoNoticiaCategoria').prop('checked', true)
                    }
                    else 
                    {
                        $('#chkEstadoNoticiaCategoria').prop('checked', false)
                    }
                }).fail(function () {
                    console.log("Error al cargar los datos");
                });
            }

            window.ActualizarNoticiaCategoria = function(noticia_categoria_id)
            {
                $("#btnGuardarNoticiaCategoria").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticia_categoria/" + noticia_categoria_id;
                let data = {
                    noticia_categoria_id: noticia_categoria_id,
                    noticia_categoria: $("#txtNoticiaCategoria").val(),
                    descripcion: $("#txtDescripcionNoticiaCategoria").val(),
                    noticiacategoriapadre: $('#txtNoticiaCategoriaPadre').val(),
                    activo: $('#chkEstadoNoticiaCategoria').prop('checked'),
                    parent_actual: $('#parentActual').val(),
                    slug_actual: $('#slugActual').val(),
                    usuario:<?php echo '"'.Auth::user()->usuario.'"'; ?>
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#btnGuardarNoticiaCategoria").prop('disabled', false);
                        if(response.code == "200")
                        {
                                limpiarModalNoticiaCategoria();
                                $("#ModalNoticiaCategoria").modal('hide');
                                loadNoticiasCategorias();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha actualizado la Categoría de la Noticia correctamente'
                                });
                        }
                        else if(response.code == "422")
                        {
                            let errors = response.errors;
                            if (typeof errors.categoria !== 'undefined' || typeof errors.categoria !== "") 
                            {
                                categoriavalidation = '<li>' + errors.categoria + '</li>';
                            }
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                categoriavalidation  + 
                                        '</ul>'
                            });
                        }
                    },
                    error: function(response) {
                        $("#btnGuardarNoticiaCategoria").prop('disabled', false);
        
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                });
            }

            window.eliminarNoticiaCategoría = function(noticia_categoria_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de eliminar la categoría de la Noticia?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Eliminar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticia_categoria/"  + noticia_categoria_id;
                            let data = {
                                noticia_categoria_id: noticia_categoria_id
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
                                        loadNoticiasCategorias();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha eliminado la categoría de la noticia correctamente'
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

            window.desactivarNoticiaCategoría = function(noticia_categoria_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de desactivar la Categoría de la Noticia?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Desactivar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticia_categoria" +  "/desactivar/" + noticia_categoria_id;
                            let data = {
                                noticia_categoria_id: noticia_categoria_id
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
                                        loadNoticiasCategorias();
                                    
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha desactivado la Categoría de la Noticia correctamente'
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

            window.activarNoticiaCategoria = function(noticia_categoria_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de activar la Categoría de la Noticia?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Activar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticia_categoria" +  "/activar/" + noticia_categoria_id;
                            let data = {
                                noticia_categoria_id: noticia_categoria_id
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
                                        loadNoticiasCategorias();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha activado la categoría de la noticia correctamente'
                                        });
                                        // document.location.reload(true)
                                    }
                                },
                                error: function(response) {                    
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ERROR...',
                                        text: 'Se ha producido un error al intentar activar el registro!'
                                    })
                                }
                            });
                        }
                    })
            }

        });



    </script>

@endsection