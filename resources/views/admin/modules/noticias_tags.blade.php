@extends('admin.master')

@section('title', 'Módulo de Noticias Tags')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE NOTICIAS TAG
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-hashtag"></i> Noticias Tags</li>
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
                    <label for="txtBuscarNoticiaTag" style="font-size:14px;">Noticia Tag: </label>
                    <input type="text" class="form-control form-control-sm" id="txtBuscarNoticiaTag" placeholder="Código o nombre de la Categoría para la Noticia...">
                </div>
            </div>

            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoNoticiaTagBuscar" style="font-size:14px;">Estado:</label>
                    <select name="estadoNoticiaTagBuscar" id="estadoNoticiaTagBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            
        </div>

        @can('admin.noticias_etiquetas.crear')
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 d-flex justify-content-end">

                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw" data-toggle="modal" data-target="#ModalNoticiaTag"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Noticia Tag</button>
                </div>

            </div>
        </div>
        @endcan

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-hashtag"></i>
                            Listado de Noticia Tags
                        </h4>
                        <section class="noticia_tag">
                            @if(isset($noticia_tags) && count($noticia_tags) > 0)
                                
                                @include('admin.data.load_noticias_tag_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Noticia Tag</th>
                                            <th>URL</th>                  
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="5">No se encontraron registros</td>
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
                                    <td style="font-size:14px">Editar Noticia Tag</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Noticia Tag</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Noticia Tag</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Noticia Tag</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

    <!-- Modal Agregar -->
    <div class="modal fade" id="ModalNoticiaTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formNoticiaTag" name="formNoticiaTag">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalNoticiaTag" style="color:white !important">AGREGAR NOTICIA TAG</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalNoticiaTag()">
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
                                            <label for="txtNoticiaTag"><b>Tag:</b></label>
                                            <input type="hidden" name="hddnoticia_tag_id" id="hddnoticia_tag_id" value="">
                                            <input type="hidden" name="slugnoticiatag_actual" id="slugnoticiatag_actual" value="">
                                            <input type="text" class="form-control ml-2" id="txtNoticiaTag"  name="txtNoticiaTag" aria-describedby="emailHelp"
                                                placeholder="Ingrese la Etiqueta para la Noticia">
                                        </div>

                                        <div class="form-group">
                                            <label for="chkEstadoNoticiaTag"><b>Estado:<b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoNoticiaTag" id="chkEstadoNoticiaTag" checked>  
                                                <label class="custom-control-label" for="chkEstadoNoticiaTag">Activo</label>
                                            </div>
                                        </div>
                                
                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarNoticiaTag"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarNoticiaTag" data-dismiss="modal" onclick="limpiarModalNoticiaTag()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

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
                    loadNoticiasTags(page);
                }
            }
        });

        $(document).ready(function() {

            $(document).on('click', '.noticia_tag .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadNoticiasTags(page);
            });

            function loadNoticiasTags(page)
            {
                let url='';
                let BuscarNoticiaTag = $('#txtBuscarNoticiaTag').val();
                let BuscarestadoTag = $('#estadoNoticiaTagBuscar').val(); 
                url=$('meta[name=app-url]').attr("content")  + "/admin" + "/noticia_tag?page="+page;

                $.ajax({
                    url: url,
                    method:'GET',
                    data: {noticia_tag: BuscarNoticiaTag, estado: BuscarestadoTag}
                }).done(function (data) {
                    $('.noticia_tag').html(data);
                }).fail(function () {
                    console.log("Failed to load data!");
                });
            }

            $('#txtBuscarNoticiaTag').on('keyup', function(e){
                let noticia_tag = this.value;
                let estadonoticiatag = $('#estadoNoticiaTagBuscar').val();
                ajaxloadNoticiasTags(noticia_tag, estadonoticiatag);
            });

            
            $('#estadoNoticiaTagBuscar').on('change', function(e){
                let noticia_tag2 = $('#txtBuscarNoticiaTag').val();
                let estadonoticiatag2 = this.value;
                ajaxloadNoticiasTags(noticia_tag2, estadonoticiatag2);
            })

            function ajaxloadNoticiasTags(noticia_tag, estado)
            {
                const url=$('meta[name=app-url]').attr("content") + "/admin" + "/noticia_tag";
                $.ajax({
                    headers: 
                    {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method:'GET',
                    data: {noticia_tag:noticia_tag, estado: estado}
                }).done(function (data) {
                    $('.noticia_tag').html(data);
                }).fail(function () {
                    console.log("Error al cargar los datos");
                });
            }

            $('#formNoticiaTag').submit(function(event){
                event.preventDefault();
                let hddnoticia_tag_id = $('#hddnoticia_tag_id').val();
                if(hddnoticia_tag_id!="")
                {
                    ActualizarNoticiaTag(hddnoticia_tag_id);
                }
                else 
                {
                    GuardarNoticiaTag();
                }
            });

            window.limpiarModalNoticiaTag = function() {
                $('#tituloModalNoticiaTag').html('AGREGAR TAG');
                $('#hddnoticia_tag_id').val("");
                $('#slugnoticiatag_actual').val("");
                $('#txtNoticiaTag').val("");
                $('#chkEstadoNoticiaTag').prop('checked', true);
            }

            window.GuardarNoticiaTag = function()
            {
                $("#btnGuardarNoticiaTag").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin" + "/noticia_tag";
                let data = {
                    noticia_tag: $("#txtNoticiaTag").val(),
                    activo: $('#chkEstadoNoticiaTag').prop('checked'),
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
                        $("#btnGuardarNoticiaTag").prop('disabled', false);
                        if(response.code == "200")
                        {
                            $("#ModalNoticiaTag").modal('hide');
                            limpiarModalNoticiaTag();
                            loadNoticiasTags();

                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha registrado la Etiqueta de la Noticia correctamente'
                            });
                        }
                        else  if(response.code == "422")
                        {
                                let errors = response.errors;
                                console.log(errors);
                                if (typeof errors.noticia_tag !== 'undefined' || typeof errors.noticia_tag !== "") 
                                {
                                    noticiaTagvalidation = '<li>' + errors.noticia_tag + '</li>';
                                }
                                
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR...',
                                    html: '<ul>'+
                                        noticiaTagvalidation  + 
                                            '</ul>'
                                });
                        }
                        else if(response.code=="426")
                        {
                            Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR!',
                                    text: 'La Etiqueta de la Noticia ya Existe!'
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
                    },
                    error: function(response) {
                        $("#btnGuardarNoticiaTag").prop('disabled', false);
        
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                })

            }

            window.mostrarNoticiaEtiqueta = function(noticia_tag_id)
            {
                url=$('meta[name=app-url]').attr("content") + "/admin" + "/noticia_tag/" +noticia_tag_id;
                $("#ModalNoticiaTag").modal('show');
                $.ajax({
                    url: url,
                    method:'GET'
                }).done(function (data) {
                    // let valores = JSON.parse(data)
                    // console.log(data);
                    $('#tituloModalNoticiaTag').html('EDITAR TAG: ' +data['noticia_tag'][0]['noticia_tag']);
                    $('#hddnoticia_tag_id').val(noticia_tag_id);
                    $('#txtNoticiaTag').val(data['noticia_tag'][0]['noticia_tag']);
                    $('#slugnoticiatag_actual').val(data['noticia_tag'][0]['url']);
                    if(data['noticia_tag'][0]['estado'] == "1")
                    {
                        $('#chkEstadoNoticiaTag').prop('checked', true)
                    }
                    else 
                    {
                        $('#chkEstadoNoticiaTag').prop('checked', false)
                    }
                }).fail(function () {
                    console.log("Error al cargar los datos");
                });
            }

            window.ActualizarNoticiaTag = function(noticia_tag_id)
            {
                $("#btnGuardarNoticiaTag").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticia_tag/" + noticia_tag_id;
                let data = {
                    noticia_tag_id: noticia_tag_id,
                    noticia_tag: $("#txtNoticiaTag").val(),
                    activo: $('#chkEstadoNoticiaTag').prop('checked'),
                    slug_actual: $('#slugnoticiatag_actual').val(),
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
                        $("#btnGuardarNoticiaTag").prop('disabled', false);
                        if(response.code == "200")
                        {
                            $("#ModalNoticiaTag").modal('hide');
                            limpiarModalNoticiaTag();
                            loadNoticiasTags();

                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha actualizado la Etiqueta de la Noticia correctamente'
                            });
                        }
                        else if(response.code == "422")
                        {
                            let errors = response.errors;
                            // console.log(errors);
                            if (typeof errors.tag !== 'undefined' || typeof errors.tag !== "") 
                            {
                                tagvalidation = '<li>' + errors.tag + '</li>';
                            }
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                tagvalidation  + 
                                        '</ul>'
                            });
                        }
                    },
                    error: function(response) {
                        $("#btnGuardarNoticiaTag").prop('disabled', false);
        
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                });
            }

            window.eliminarNoticiaEtiqueta = function(noticia_tag_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de eliminar la etiqueta de la Noticia?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Eliminar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") + "/admin" + "/noticia_tag/"  + noticia_tag_id;
                            let data = {
                                noticia_tag_id: noticia_tag_id,
                                usuario:<?php echo '"'.Auth::user()->usuario.'"'; ?>
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
                                        loadNoticiasTags();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha eliminado la Etiqueta de la Noticia correctamente'
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

            window.desactivarNoticiaEtiqueta = function(noticia_tag_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de desactivar la Etiqueta de la Noticia?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Desactivar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticia_tag" +  "/desactivar/" + noticia_tag_id;
                            let data = {
                                noticia_tag_id: noticia_tag_id,
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
                                    // console.log(response);
                                    if(response.code == "200")
                                    {
                                        loadNoticiasTags();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha desactivado la Etiqueta de la Noticia correctamente'
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

            window.activarNoticiaEtiqueta = function(noticia_tag_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de activar la Etiqueta de la Noticia?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Activar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticia_tag" +  "/activar/" + noticia_tag_id;
                            let data = {
                                noticia_tag_id: noticia_tag_id,
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
                                    // console.log(response);
                                    if(response.code == "200")
                                    {
                                        loadNoticiasTags();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha activado la Etiqueta de la Noticia correctamente'
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