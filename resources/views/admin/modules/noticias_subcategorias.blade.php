@extends('admin.master')

@section('title', 'Módulo de Noticias Subcategorías')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE NOTICIA SUBCATEGORÍAS "{{ $Noticiacategoria->noticia_categoria }}"
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item"> <a href="{{ url('/admin/noticia_categoria') }}" class="colorfont"><i class="fas fa-cubes"></i> Noticia Categorías</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$Noticiacategoria->noticia_categoria}}</li>
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
                    <label for="txtBuscarNoticiaSubCategoria" style="font-size:14px;">Noticia subcategoría: </label>
                    <input type="text" class="form-control form-control-sm" id="txtBuscarNoticiaSubCategoria" placeholder="Código o nombre de la Noticia Subcategoría...">
                </div>
            </div>
            
            @can('admin.noticias_subcategorias.crear')
            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw btn-mt" data-toggle="modal" data-target="#ModalNoticiaSubCategoria"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Noticia SubCategoría</button>
                </div>
            </div>
            @endcan
 

        </div>

        <div class="row">

            <div class="col-12 grid-margin">
                
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-cubes"></i>
                            Listado de Subcategorías
                        </h4>
                        <section class="noticias-subcategorias">
                            @if(isset($subcategoriasNoticias) && count($subcategoriasNoticias) > 0)
                        
                                    @include('admin.data.load_noticias_subcategorias_data')
                            
                            @else 
                            
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Noticia Subcategoría</th>
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
                                    <td style="font-size:14px">Editar Noticia Subcategoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Noticia Subcategoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Noticia Subcategoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Noticia Subcategoría</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

    @can('admin.subcategorias.crear')
       <!-- Modal Agregar -->
    <div class="modal fade" id="ModalNoticiaSubCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formNoticiaSubCategoria" name="formNoticiaSubCategoria">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalNoticiaSubCategoria" style="color:white !important">AGREGAR NOTICIA SUBCATEGORÍA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalNoticiaSubCategoria()">
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
                                            <label for="txtNoticiaSubCategoria"><b>Noticia Categoría:</b></label>
                                            <input type="hidden" name="hddNoticiasubcategoria_id" id="hddNoticiasubcategoria_id" value="">
                                            <input type="hidden" name="parentNoticiasub_actual" id="parentNoticiasub_actual" value="">
                                            <input type="hidden" name="slugNoticiasub_actual" id="slugNoticiasub_actual" value="">
                                            <input type="hidden" name="hddusuario" id="hddusuario" value="{{Auth::user()->usuario}}">
                                            <input type="text" class="form-control ml-2" id="txtNoticiaSubCategoria"  name="txtNoticiaSubCategoria" aria-describedby="emailHelp"
                                                placeholder="Ingrese la noticia categoría">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtDescripcionNoticiaSubCategoria"><b>Descripción:</b></label>
                                            <textarea class="form-control ml-2" name="txtDescripcionNoticiaSubCategoria" id="txtDescripcionNoticiaSubCategoria" cols="20" rows="3" placeholder="Ingrese la Descripción.."></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="chkEstadoNoticiaSubCategoria"><b>Estado:<b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoNoticiaSubCategoria" id="chkEstadoNoticiaSubCategoria" checked>  
                                                <label class="custom-control-label" for="chkEstadoNoticiaSubCategoria">Activo</label>
                                            </div>
                                        </div>
                                    
                                
                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarNoticiaSubCategoria"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarNoticiaSubCategoria" data-dismiss="modal" onclick="limpiarModalNoticiaSubCategoria()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>
    @endcan


@endsection


@section('scripts')

    <script>

        $(document).ready(function() {

            window.limpiarModalNoticiaSubCategoria = function() {
                $('#tituloModalNoticiaSubCategoria').html('AGREGAR NOTICIA SUBCATEGORÍA');
                $('#hddNoticiasubcategoria_id').val("");
                $('#txtNoticiaSubCategoria').val("");
                $('#txtDescripcionNoticiaSubCategoria').val("");
                // $('#CategoriaPadre').val("0");
                $('#chkEstadoNoticiaSubCategoria').prop('checked', true);
                $('#parentNoticiasub_actual').val("");
                $('#slugNoticiasub_actual').val("");
            }

            function loadnoticiassubcategorias(param='')
            {
                let url='';
                let get_value = <?php echo "'".Hashids::encode($Noticiacategoria->noticia_categoria_id)."'"; ?>;
                if(param!="")
                {
                    url= param;
                }
                else 
                {
                    url=$('meta[name=app-url]').attr("content")  + "/admin/noticia_categoria/subcategorias_noticias/" + get_value;
                }

                $.ajax({
                    url: url
                }).done(function (data) {
                    $('.noticias-subcategorias').html(data);
                }).fail(function () {
                    console.log("Failed to load data!");
                });
            }

            $('#txtBuscarNoticiaSubCategoria').on('keyup', function(e){
                let get_value = <?php echo "'".Hashids::encode($Noticiacategoria->noticia_categoria_id)."'"; ?>;
                url=$('meta[name=app-url]').attr("content") + "/admin/noticia_categoria/subcategorias_noticias/" + get_value;
                $.ajax({
                    url: url,
                    method:'GET',
                    data: {noticia_categoria: this.value,}
                }).done(function (data) {
                    $('.noticias-subcategorias').html(data);
                    // console.log(data);
                }).fail(function () {
                    console.log("Error al cargar los datos");
                });
            })

            $('#formNoticiaSubCategoria').submit(function(event){
                event.preventDefault();
                let hddNoticiasubcategoria_id = $('#hddNoticiasubcategoria_id').val();
                if(hddNoticiasubcategoria_id!="")
                {
                    ActualizarNoticiaSubCategoria(hddNoticiasubcategoria_id);
                }
                else 
                {
                    GuardarNoticiaSubCategoria();
                }
            });

            window.GuardarNoticiaSubCategoria = function()
            {
                $("#btnGuardarNoticiaSubCategoria").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/noticia_categoria/subcategorias_noticia";
                let data = {
                    noticia_categoria: $("#txtNoticiaSubCategoria").val(),
                    descripcion: $("#txtDescripcionNoticiaSubCategoria").val(),
                    noticiacategoriapadre: <?php echo "'".Hashids::encode($Noticiacategoria->noticia_categoria_id)."'"; ?>,
                    activo: $('#chkEstadoNoticiaSubCategoria').prop('checked'),
                    usuario:$('#hddusuario').val()
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#btnGuardarNoticiaSubCategoria").prop('disabled', false);
                        if(response.code == "200")
                        {
                                limpiarModalNoticiaSubCategoria();
                                $("#ModalNoticiaSubCategoria").modal('hide');
                                loadnoticiassubcategorias();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha registrado la Noticia Subcategoría correctamente'
                                });
                        }
                        else  if(response.code == "422")
                        {
                                let errors = response.errors;
                                if (typeof errors.noticia_categoria !== 'undefined' || typeof errors.noticia_categoria !== "") 
                                {
                                    noticiacategoriavalidation = '<li>' + errors.noticia_categoria + '</li>';
                                }
                                
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR...',
                                    html: '<ul>'+
                                            noticiacategoriavalidation  + 
                                            '</ul>'
                                });
                        }                     
                        else if(response.code=="427")
                        {
                            Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR!',
                                    text: 'La Noticia subcategoría ya Existe para esta Categoría!'
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

            window.mostrarNoticiaSubcategoria = function(noticia_subcategoria_id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/noticia_categoria/subcategorias_noticia/" + noticia_subcategoria_id;
                $("#ModalNoticiaSubCategoria").modal('show');
                $.ajax({
                    url: url,
                    method:'GET'
                }).done(function (data) {
                    // let valores = JSON.parse(data)sssss
                    console.log(data);
                    $('#tituloModalNoticiaSubCategoria').html('EDITAR SUBCATEGORÍA: ' +data['noticia_categoria']);
                    $('#hddNoticiasubcategoria_id').val(noticia_subcategoria_id);
                    $('#txtNoticiaSubCategoria').val(data['noticia_categoria']);
                    $('#txtDescripcionNoticiaSubCategoria').val(data['descripcion']);
                    $('#parentNoticiasub_actual').val(<?php echo "'".Hashids::encode($Noticiacategoria->noticia_categoria_id)."'"; ?>);
                    $('#slugNoticiasub_actual').val(data['url']);
                    if(data['estado'] == "1")
                    {
                        $('#chkEstadoNoticiaSubCategoria').prop('checked', true)
                    }
                    else 
                    {
                        $('#chkEstadoNoticiaSubCategoria').prop('checked', false)
                    }
                }).fail(function () {
                    console.log("Error al cargar los datos");
                });
            }

            window.ActualizarNoticiaSubCategoria = function (hddsubcategoria_id)
            {
                $("#btnGuardarNoticiaSubCategoria").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/noticia_categoria/subcategorias_noticia/" + hddsubcategoria_id;
                let data = {
                    noticia_categoria_id: hddsubcategoria_id,
                    noticia_categoria: $("#txtNoticiaSubCategoria").val(),
                    descripcion: $("#txtDescripcionNoticiaSubCategoria").val(),
                    activo: $('#chkEstadoNoticiaSubCategoria').prop('checked'),
                    parent_subactual: $('#parentNoticiasub_actual').val(),
                    slug_subactual: $('#slugNoticiasub_actual').val(),
                    usuario:$('#hddusuario').val()
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#btnGuardarNoticiaSubCategoria").prop('disabled', false);
                        if(response.code == "200")
                        {
                            limpiarModalNoticiaSubCategoria();
                            $("#ModalNoticiaSubCategoria").modal('hide');
                            loadnoticiassubcategorias();

                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha actualizado la Noticia Subcategoría Correctamente'
                            });
                        }
                        else if(response.code == "422")
                        {
                            let errors = response.errors;
                            if (typeof errors.rol !== 'undefined' || typeof errors.rol !== "") 
                            {
                                rolValidation = '<li>' + errors.rol + '</li>';
                            }
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                        rolValidation  + 
                                        '</ul>'
                            });
                        }
                        else if(response.code=="427")
                        {
                            Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR!',
                                    text: 'La subcategoría ya Existe para esta Categoría!'
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
                        $("#btnGuardarSubCategoria").prop('disabled', false);
        
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                });
            }

            window.eliminarNoticiaSubCategoría = function(hddsubcategoria_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de eliminar la Subcategoría de la Noticia?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Eliminar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") + "/admin/noticia_categoria/subcategorias_noticia/" + hddsubcategoria_id;
                            let data = {
                                noticia_categoria_id: hddsubcategoria_id,
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
                                        loadnoticiassubcategorias();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha eliminado la subcategría correctamente'
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

            window.desactivarNoticiaSubCategoría = function(hddsubcategoria_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de desactivar la Subcategoría?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Desactivar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") + "/admin/noticia_categoria/subcategorias_noticia/desactivar/" + hddsubcategoria_id;
                            let data = {
                                noticia_categoria_id: hddsubcategoria_id,
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
                                        loadnoticiassubcategorias();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha desactivado la SubCategoría correctamente'
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

            window.activarNoticiaSubCategoria = function(hddsubcategoria_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de activar la Subcategoría?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Activar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") + "/admin/noticia_categoria/subcategorias_noticia/activar/" + hddsubcategoria_id;
                            let data = {
                                noticia_categoria_id: hddsubcategoria_id,
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
                                        loadnoticiassubcategorias();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha activado la Subcategoría correctamente'
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