@extends('admin.master')

@section('title', 'Módulo de Categorías')

@section('content')

    <div class="content-wrapper">
        
        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE CATEGORÍAS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-cubes"></i> Categorías</li>
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
                    <label for="txtBuscarCategoria" style="font-size:14px;">Categoría: </label>
                    <input type="text" class="form-control form-control-sm" id="txtBuscarCategoria" placeholder="Código o nombre de la Categoría...">
                </div>
            </div>

            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoCategoriaBuscar" style="font-size:14px;">Estado:</label>
                    <select name="estadoCategoriaBuscar" id="estadoCategoriaBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            
        </div>
       
        <div class="row">
            <div class="col-12">

                <div class="form-group mr-20-sm boton-group">
                  
                    <a href="{{url('admin/Excel/ReporteCategoriaExcel')}}" type="button" class="btn btn-sm btn-default-export  btn-fw" target="_blank"><img src="{{ url('admin_assets/images/excel.png') }}" alt="Exportar Excel" width="25px"> Exportar Excel</a>
                    <a href="{{url('admin/pdf/ReporteCategoriaPdf')}}"  type="button" class="btn btn-sm btn-default-export  btn-fw"><img src="{{ url('admin_assets/images/pdf.png') }}" alt="Exportar PDF" width="25px"> Exportar PDF</a>    
                 
                    @can('admin.categorias.crear')
                    <button type="button" class="btn btn-sm btn-dark btn-fw" data-toggle="modal" data-target="#ModalCategoria"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Categoría</button>
                    @endcan
                </div>

            </div>
        </div>
      

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-cubes"></i>
                            Listado de Categorías
                        </h4>
                        <section class="categorias">
                            @if(isset($categorias) && count($categorias) > 0)
                                
                                @include('admin.data.load_categorias_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Categoría</th>
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
                                    <td style="font-size:14px">Editar Categoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Categoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Categoría</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Categoría</td>
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

    @can('admin.categorias.crear')
     <!-- Modal Agregar -->
     <div class="modal fade" id="ModalCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formCategoria" name="formCategoria">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalCategoria" style="color:white !important">AGREGAR CATEGORÍA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalCategoria()">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                    
                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mb-4">

                                    <div class="card-body">

                                        <div id="error-div"></div>

                                        <!-- <div class="form-group">
                                            <label for="txtCodigoCategoria"><b>Código:</b></label>
                                        
                                            <input type="text" class="form-control ml-2" id="txtCodigoCategoria"  name="txtCodigoCategoria" value="(AUTO)" disabled>
     
                                        </div> -->
                                
                                        <div class="form-group">
                                            <label for="txtCategoria"><b>Categoría:</b></label>
                                            <input type="hidden" name="hddcategoria_id" id="hddcategoria_id" value="">
                                            <input type="hidden" name="parent_actual" id="parent_actual" value="">
                                            <input type="hidden" name="slug_actual" id="slug_actual" value="">
                                            <input type="text" class="form-control ml-2" id="txtCategoria"  name="txtCategoria" aria-describedby="emailHelp"
                                                placeholder="Ingrese la categoría">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtDescripcionCategoria"><b>Descripción:</b></label>
                                            <textarea class="form-control ml-2" name="txtDescripcionCategoria" id="txtDescripcionCategoria" cols="20" rows="3" placeholder="Ingrese la Descripción.."></textarea>
                                        </div>

                                        @include('admin.partials.select-categorias-padres')
                                        
                                        <div class="form-group">
                                            <label for="chkEstadoCategoria"><b>Estado:</b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoCategoria" id="chkEstadoCategoria" checked>  
                                                <label class="custom-control-label" for="chkEstadoCategoria">Activo</label>
                                            </div>
                                        </div>
     
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="imgCategoria"><b>&nbsp;&nbsp;Imagen de la Categoría:</b></label>
                                                <input type="file" name="imgCategoria" id="imgCategoria" class="form-control">
                                                <input type="hidden" name="imgCategoriaActual" id="imgCategoriaActual" value="">
                                            </div>
                                        </div>

                                        <div  id="imgCategoria_preview" class="form-group row">
                                        </div>
                                
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarCategoria"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarCategoria" data-dismiss="modal" onclick="limpiarModalCategoria()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>
    @endcan

@endsection

@section('scripts')

<script>

    $(window).on('hashchange',function(){
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else{
                loadcategorias(page);
            }
        }
    });


    $(document).ready(function() {

        $(document).on('click', '.categorias .pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadcategorias(page);
        });

        function loadcategorias(page)
        {
            let url='';
            let categoria = $('#txtBuscarCategoria').val();
            let estado = $('#estadoCategoriaBuscar').val(); 
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/categorias?page="+page;

            $.ajax({
                url: url,
                method:'GET',
                data: {categoria: categoria, estado: estado}
            }).done(function (data) {
                $('.categorias').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }

        // function loadcategorias(param='')
        // {
        //     let url='';
        //     if(param!="")
        //     {
        //         url= param;
        //     }
        //     else 
        //     {
        //         url=$('meta[name=app-url]').attr("content")  + "/admin" + "/categorias";
        //     }

        //     $.ajax({
        //         url: url
        //     }).done(function (data) {
        //         $('.categorias').html(data);
        //     }).fail(function () {
        //         console.log("Failed to load data!");
        //     });
        // }

        $('#txtBuscarCategoria').on('keyup', function(e){
            // console.log(this.value);
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/categorias";
            let estadocategoria = $('#estadoCategoriaBuscar').val(); 
            $.ajax({
                url: url,
                method:'GET',
                data: {categoria: this.value, estado: estadocategoria}
            }).done(function (data) {
                $('.categorias').html(data);
                // console.log(data);
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        })

        $('#estadoCategoriaBuscar').on('change', function (e ){
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/categorias";
            let categoriabuscar = $('#txtBuscarCategoria').val();
            $.ajax({
                url: url,
                method:'GET',
                data: {categoria: categoriabuscar, estado: this.value}
            }).done(function (data) {
                $('.categorias').html(data);
                // console.log(data);
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        })

        $('#formCategoria').submit(function(event){
            event.preventDefault();
            let hddcategoria_id = $('#hddcategoria_id').val();
            if(hddcategoria_id!="")
            {
                ActualizarCategoria(hddcategoria_id);
            }
            else 
            {
                GuardarCategoria();
            }
        });

        window.limpiarModalCategoria = function() {
            $('#tituloModalCategoria').html('AGREGAR CATEGORÍA');
            $('#hddcategoria_id').val("");
            $('#txtCategoria').val("");
            $('#txtDescripcionCategoria').val("");
            $('#CategoriaPadre').val("0");
            $('#chkEstadoCategoria').prop('checked', true);
            $('#parent_actual').val("");
            $('#slug_actual').val("");
            $('#imgCategoria_preview').html("");
            $('#imgCategoriaActual').val("");
        }

        window.GuardarCategoria = function()
        {
            $("#btnGuardarCategoria").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin" + "/categorias";
            let bannerimg = '';

            if(document.getElementById('imgbannerCategoria')!==null)
            {
                bannerimg = $('#imgbannerCategoria').val();
            }
            
            let data = {
                categoria: $("#txtCategoria").val(),
                descripcion: $("#txtDescripcionCategoria").val(),
                categoriapadre: $('#CategoriaPadre').val(),
                activo: $('#chkEstadoCategoria').prop('checked'),
                bannerImgCategoria: bannerimg,
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
                    $("#btnGuardarCategoria").prop('disabled', false);
                    if(response.code == "200")
                    {
                           
                            $("#ModalCategoria").modal('hide');
                            limpiarModalCategoria();
                            loadcategorias();

                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha registrado la Categoría correctamente'
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
                                text: 'La categoría ya Existe!'
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

        window.mostrarCategoría = function(categoria_id)
        {
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/categorias/" +categoria_id;
            $("#ModalCategoria").modal('show');
            $('#imgCategoria_preview').html("");
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                // let valores = JSON.parse(data)
                $('#tituloModalCategoria').html('EDITAR CATEGORÍA: ' +data.categoria);
                $('#hddcategoria_id').val(categoria_id);
                $('#txtCategoria').val(data.categoria);
                $('#txtDescripcionCategoria').val(data.descripcion);
                $('#CategoriaPadre').val(data.parent_id);
                $('#parent_actual').val(data.parent_id);
                $('#slug_actual').val(data.url);
                if(data.estado == "1")
                {
                    $('#chkEstadoCategoria').prop('checked', true)
                }
                else 
                {
                    $('#chkEstadoCategoria').prop('checked', false)
                }

                if(!empty(data.img))
                {
                    $('#imgCategoriaActual').val(data.img);
                    $('#bannerImg_preview').removeAttr('hidden');
                    loadimage(data.img,'imgCategoria_preview','imgcategoria','removeCatImg',data.nombre_img, categoria_id, data.size_img,'categoria_id',0);
                }   

            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }

        window.ActualizarCategoria = function(categoria_id)
        {
            $("#btnGuardarCategoria").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/categorias/" + categoria_id;
            let imgcategoria = '';
            if(document.getElementById('imgcategoria')!==null)
            {
                imgcategoria = $('#imgcategoria').val();
            }
            let data = {
                categoria_id: categoria_id,
                categoria: $("#txtCategoria").val(),
                descripcion: $("#txtDescripcionCategoria").val(),
                categoriapadre: $('#CategoriaPadre').val(),
                activo: $('#chkEstadoCategoria').prop('checked'),
                parent_actual: $('#parent_actual').val(),
                slug_actual: $('#slug_actual').val(),
                imgcategoriaActual: $('#imgCategoriaActual').val(),
                imgcategoria: imgcategoria,
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
                    $("#btnGuardarCategoria").prop('disabled', false);
                    if(response.code == "200")
                    {
                            limpiarModalCategoria();
                            $("#ModalCategoria").modal('hide');
                            loadcategorias();

                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha actualizado la Categoría correctamente'
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
                    $("#btnGuardarCategoria").prop('disabled', false);
    
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            });
        }

        window.eliminarCategoría = function(categoria_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de eliminar la categoría?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Eliminar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/categorias/"  + categoria_id;
                        let data = {
                            categoria_id: categoria_id
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
                                    loadcategorias();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha eliminado la categoría correctamente'
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

        window.desactivarCategoría = function(categoria_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de desactivar la Categoría?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Desactivar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/categorias" +  "/desactivar/" + categoria_id;
                        let data = {
                            categoria_id: categoria_id
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
                                    loadcategorias();
                                   
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha desactivado la Categoría correctamente'
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

        window.activarCategoria = function(categoria_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de activar la Categoría?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/categorias" +  "/activar/" + categoria_id;
                        let data = {
                            categoria_id: categoria_id
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
                                    loadcategorias();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha activado la categoría correctamente'
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

        $('#imgCategoria').change(function(){
        
            let img = $('input[name="imgCategoria"]')[0].files;
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/categorias/subirImagenTmp";
            let imgBannerCategoria = new FormData();
            let id = generateString(3);
            imgBannerCategoria.append("imagen",img[0]);
            imgBannerCategoria.append("indice",1);
            $('#imgCategoria_preview').html("");
            $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: imgBannerCategoria,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        if(response.code==200)
                        {
                            let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                            let urlimage = urlraiz + response.data.url;
                            let img_id = 'imgprincipal' + id;
                            previewtmpimage_col12(urlimage, 'imgCategoria_preview',img_id, response.data.name, response.data.size, 'imgcategoria', 'removeCatImg', 'categoria_id');
                            // $('#imgProducto_preview').append("<div class='img-div col-md-3 col-6' id='imgprincipal"+id+"'>" +
                            //         "<img src='"+urlimage+"' class='img-fluid image img-thumbnail' title='"+response.data.name+"'>"+
                            //         "<div class='middle'>"+
                            //         "<button type='button' id='imagen-action-icon' value='imgprincipal"+id+"' class='btn btn-danger' name='"+response.data.name+"' temporal='1' producto_id='' image_id=''>"+
                            //             "<i class='fa fa-trash'></i>"+
                            //         "</button>"+
                            //         "</div>"+
                            //         "<input value='"+response.data.name+"|*|"+response.data.size+"|*|1' name='imgproducto' type='hidden'>" +
                            //         "</div>");
                            document.getElementById('imgCategoria').value="";
                        }
                        else  if(response.code == "422")
                        {
                            document.getElementById('imgCategoria').value="";
                            let errors = response.errors;
                            let imgvalidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    imgvalidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                imgvalidation  + 
                                        '</ul>'
                            });
                        }
                        else
                        {
                            document.getElementById('imgCategoria').value="";

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar actualizar el registro!'
                            })
                        }
                    },
                    error: function(response) {
                        document.getElementById('imgCategoria').value="";
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
            });
        })

        $('body').on('click', '#removeCatImg-icon', function(evt){
        
            let divNameImg = this.value;
            let filenameImg = $(this).attr('name');
            let temporalImg = $(this).attr('temporal');
            let categoria_id  = $(this).attr('categoria_id');


            if(temporalImg == 1)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/categorias/eliminarImagenTmp";
                deleteTempImg(divNameImg, filenameImg, temporalImg, url);
            }
            else if(temporalImg == 0)
            {
            
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/categorias/eliminarImagen";
                deleteImg(divNameImg, filenameImg, categoria_id, temporalImg, url);
                $('#sliderImgName').val("");
                loadcategorias();
            }

            evt.preventDefault();
        });

    });

</script>

@endsection