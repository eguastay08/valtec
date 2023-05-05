@extends('admin.master')

@section('title', 'Módulo de Subcategorías')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE SUBCATEGORÍAS PARA "{{ $categoria->categoria }}"
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item"> <a href="{{ url('/admin/categorias') }}" class="colorfont"><i class="fas fa-cubes"></i> Categorías</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$categoria->categoria}}</li>
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
                    <label for="txtBuscarSubCategoria" style="font-size:14px;">Subcategoría: </label>
                    <input type="text" class="form-control form-control-sm" id="txtBuscarSubCategoria" placeholder="Código o nombre de la Subcategoría...">
                </div>
            </div>
            
            @can('admin.subcategorias.crear')
            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw btn-mt" data-toggle="modal" data-target="#ModalSubCategoria"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar SubCategoría</button>
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
                        <section class="subcategorias">
                            @if(isset($subcategorias) && count($subcategorias) > 0)
                        
                                    @include('admin.data.load_subcategorias_data')
                            
                            @else 
                            
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Categoría</th>
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
                                    <td style="font-size:14px">Editar Subcategoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Subcategoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Subcategoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Subcategoría</td>
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
    <div class="modal fade" id="ModalSubCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formSubCategoria" name="formSubCategoria">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalSubCategoria" style="color:white !important">AGREGAR SUBCATEGORÍA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalSubCategoria()">
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
                                            <label for="txtSubCategoria"><b>Categoría:</b></label>
                                            <input type="hidden" name="hddsubcategoria_id" id="hddsubcategoria_id" value="">
                                            <input type="hidden" name="parentsub_actual" id="parentsub_actual" value="">
                                            <input type="hidden" name="slugsub_actual" id="slugsub_actual" value="">
                                            <input type="text" class="form-control ml-2" id="txtSubCategoria"  name="txtSubCategoria" aria-describedby="emailHelp"
                                                placeholder="Ingrese la categoría">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtDescripcionSubCategoria"><b>Descripción:</b></label>
                                            <textarea class="form-control ml-2" name="txtDescripcionSubCategoria" id="txtDescripcionSubCategoria" cols="20" rows="3" placeholder="Ingrese la Descripción.."></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="chkEstadoSubCategoria"><b>Estado:<b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoSubCategoria" id="chkEstadoSubCategoria" checked>  
                                                <label class="custom-control-label" for="chkEstadoSubCategoria">Activo</label>
                                            </div>
                                        </div>
                                    
                                
                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarSubCategoria"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarSubCategoria" data-dismiss="modal" onclick="limpiarModalSubCategoria()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
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

            window.limpiarModalSubCategoria = function() {
                $('#tituloModalSubCategoria').html('AGREGAR SUBCATEGORÍA');
                $('#hddsubcategoria_id').val("");
                $('#txtSubCategoria').val("");
                $('#txtDescripcionSubCategoria').val("");
                // $('#CategoriaPadre').val("0");
                $('#chkEstadoSubCategoria').prop('checked', true);
                $('#parentsub_actual').val("");
                $('#slugsub_actual').val("");
            }

            function loadsubcategorias(param='')
            {
                let url='';
                let get_value = <?php echo "'".Hashids::encode($categoria->categoria_id)."'"; ?>;
                if(param!="")
                {
                    url= param;
                }
                else 
                {
                    url=$('meta[name=app-url]').attr("content")  + "/admin/categorias/subcategoria/" + get_value;
                }

                $.ajax({
                    url: url
                }).done(function (data) {
                    $('.subcategorias').html(data);
                }).fail(function () {
                    console.log("Failed to load data!");
                });
            }

            $('#txtBuscarSubCategoria').on('keyup', function(e){
                // console.log(this.value);
                let get_value = <?php echo "'".Hashids::encode($categoria->categoria_id)."'"; ?>;
                // console.log(get_value);
                url=$('meta[name=app-url]').attr("content") + "/admin/categorias/subcategoria/" + get_value;
                // console.log(url);
                $.ajax({
                    url: url,
                    method:'GET',
                    data: {categoria: this.value,}
                }).done(function (data) {
                    $('.subcategorias').html(data);
                    // console.log(data);
                }).fail(function () {
                    console.log("Error al cargar los datos");
                });
            })

            $('#formSubCategoria').submit(function(event){
                event.preventDefault();
                let hddsubcategoria_id = $('#hddsubcategoria_id').val();
                if(hddsubcategoria_id!="")
                {
                    ActualizarSubCategoria(hddsubcategoria_id);
                }
                else 
                {
                    GuardarSubCategoria();
                }
            });

            window.GuardarSubCategoria = function()
            {
                $("#btnGuardarSubCategoria").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/subcategoria";
                let data = {
                    categoria: $("#txtSubCategoria").val(),
                    descripcion: $("#txtDescripcionSubCategoria").val(),
                    categoriapadre: <?php echo "'".Hashids::encode($categoria->categoria_id)."'"; ?>,
                    activo: $('#chkEstadoSubCategoria').prop('checked')
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#btnGuardarSubCategoria").prop('disabled', false);
                        if(response.code == "200")
                        {
                                $("#txtSubCategoria").val("");
                                $("#txtDescripcionSubCategoria").val("");
                                $("#chkEstadoSubCategoria").prop( "checked", true );
                                $('#parentsub_actual').val("");
                                $('#slugsub_actual').val("");
                                $("#ModalSubCategoria").modal('hide');
                                loadsubcategorias();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha registrado la Subcategoría correctamente'
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
                    }
                })
            }

            window.mostrarSubcategoria = function(categoria_id)
            {
                url=$('meta[name=app-url]').attr("content") + "/admin/subcategoria/"+categoria_id;
                $("#ModalSubCategoria").modal('show');
                $.ajax({
                    url: url,
                    method:'GET'
                }).done(function (data) {
                    // let valores = JSON.parse(data)
                    //  console.log(data);
                    $('#tituloModalSubCategoria').html('EDITAR SUBCATEGORÍA: ' +data['categoria'][0]['categoria']);
                    $('#hddsubcategoria_id').val(categoria_id);
                    $('#txtSubCategoria').val(data['categoria'][0]['categoria']);
                    $('#txtDescripcionSubCategoria').val(data['categoria'][0]['descripcion']);
                    $('#parentsub_actual').val(<?php echo "'".Hashids::encode($categoria->categoria_id)."'"; ?>);
                    $('#slugsub_actual').val(data['categoria'][0]['url']);
                    if(data['categoria'][0]['estado'] == "1")
                    {
                        $('#chkEstadoSubCategoria').prop('checked', true)
                    }
                    else 
                    {
                        $('#chkEstadoSubCategoria').prop('checked', false)
                    }
                }).fail(function () {
                    console.log("Error al cargar los datos");
                });
            }

            window.ActualizarSubCategoria = function (hddsubcategoria_id)
            {
                $("#btnGuardarSubCategoria").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/subcategoria/" + hddsubcategoria_id;
                let data = {
                    categoria_id: hddsubcategoria_id,
                    categoria: $("#txtSubCategoria").val(),
                    descripcion: $("#txtDescripcionSubCategoria").val(),
                    activo: $('#chkEstadoSubCategoria').prop('checked'),
                    parent_actual: $('#parentsub_actual').val(),
                    slug_actual: $('#slugsub_actual').val()
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#btnGuardarSubCategoria").prop('disabled', false);
                        if(response.code == "200")
                        {
                            $("#txtSubCategoria").val("");
                            $("#txtDescripcionSubCategoria").val("");
                            $("#chkEstadoSubCategoria").prop( "checked", true );
                            $('#parentsub_actual').val("");
                            $('#slugsub_actual').val("");
                            $("#ModalSubCategoria").modal('hide');
                            loadsubcategorias();


                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha actualizado la Categoría correctamente'
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
                        $("#btnGuardarCategoria").prop('disabled', false);
        
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                });
            }

            window.eliminarCategoría = function(hddsubcategoria_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de eliminar la Subcategoría?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Eliminar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") + "/admin/subcategoria/" + hddsubcategoria_id;
                            let data = {
                                categoria_id: hddsubcategoria_id
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
                                        loadsubcategorias();

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

            window.desactivarCategoría = function(hddsubcategoria_id)
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
                            let url = $('meta[name=app-url]').attr("content") + "/admin/subcategoria/desactivar/" + hddsubcategoria_id;
                            let data = {
                                categoria_id: hddsubcategoria_id
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
                                        loadsubcategorias();

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

            window.activarCategoria = function(hddsubcategoria_id)
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
                            let url = $('meta[name=app-url]').attr("content") + "/admin/subcategoria/activar/" + hddsubcategoria_id;
                            let data = {
                                categoria_id: hddsubcategoria_id
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
                                        loadsubcategorias();

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