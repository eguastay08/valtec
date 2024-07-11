@extends('admin.master')

@section('title', 'Módulo de Etiquetas')

@section('content')

    <div class="content-wrapper">
        
        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE ETIQUETAS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-tags"></i> Etiquetas</li>
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
                    <label for="txtBuscarTag" style="font-size:14px;">Etiqueta: </label>
                    <input type="text" class="form-control form-control-sm" id="txtBuscarTag" placeholder="Código o nombre de la Categoría...">
                </div>
            </div>

            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoTagBuscar" style="font-size:14px;">Estado:</label>
                    <select name="estadoTagBuscar" id="estadoTagBuscar" class="form-control">
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

                    <a href="{{url('admin/Excel/ReporteTagExcel')}}" type="button" class="btn btn-sm btn-default-export btn-fw" target="_blank"><img src="{{ url('admin_assets/images/excel.png') }}" alt="Exportar Excel" width="25px"> Exportar Excel</a>
                    <a href="{{url('admin/pdf/ReporteTagPdf')}}"  type="button" class="btn btn-sm btn-default-export btn-fw"><img src="{{ url('admin_assets/images/pdf.png') }}" alt="Exportar PDF" width="25px"> Exportar PDF</a>
                
                    @can('admin.tags.crear')
            
                        <a type="button" class="btn btn-sm btn-dark btn-fw" data-toggle="modal" data-target="#ModalTag"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Etiqueta</a>
                  
                    @endcan
                    
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-tags"></i>
                            Listado de Etiquetas
                        </h4>
                        <section class="tags">
                            @if(isset($tags) && count($tags) > 0)
                                
                                @include('admin.data.load_etiquetas_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Etiqueta</th>
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
                                    <td style="font-size:14px">Editar Etiqueta</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Etiqueta</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Etiqueta</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Etiqueta</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

    @can('admin.tags.crear')
     <!-- Modal Agregar -->
     <div class="modal fade" id="ModalTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formTag" name="formTag">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalTag" style="color:white !important">AGREGAR ETIQUETA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalTag()">
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
                                            <label for="txtCategoria"><b>Etiqueta:</b></label>
                                            <input type="hidden" name="hddetiqueta_id" id="hddetiqueta_id" value="">
                                            <input type="hidden" name="slugtag_actual" id="slugtag_actual" value="">
                                            <input type="text" class="form-control ml-2" id="txtEtiqueta"  name="txtEtiqueta" aria-describedby="emailHelp"
                                                placeholder="Ingrese la Etiqueta">
                                        </div>

                                        <div class="form-group">
                                            <label for="chkEstadoTag"><b>Estado:</b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoTag" id="chkEstadoTag" checked>  
                                                <label class="custom-control-label" for="chkEstadoTag">Activo</label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="imgEtiqueta"><b>&nbsp;&nbsp;Imagen de la Etiqueta:</b></label>
                                                <input type="file" name="imgEtiqueta" id="imgEtiqueta" class="form-control">
                                                <input type="hidden" name="imgEtiquetaActual" id="imgEtiquetaActual" value="">
                                            </div>
                                        </div>

                                        <div  id="imgEtiqueta_preview" class="form-group row">
                                        </div>
                                
                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarTag"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarTag" data-dismiss="modal" onclick="limpiarModalTag()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
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

        function loadtags(param='')
        {
            let url='';
            if(param!="")
            {
                url= param;
            }
            else 
            {
                url=$('meta[name=app-url]').attr("content")  + "/admin" + "/tags";
            }

            $.ajax({
                url: url
            }).done(function (data) {
                $('.tags').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }


        $('#txtBuscarTag').on('keyup', function(e){
            // console.log(this.value);
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/tags";
            let estadotag = $('#estadoTagBuscar').val(); 
            $.ajax({
                url: url,
                method:'GET',
                data: {tag: this.value, estado: estadotag}
            }).done(function (data) {
                $('.tags').html(data);
                // console.log(data);
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        })

        $('#estadoTagBuscar').on('change', function (e ){
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/categorias";
            let tagbuscar = $('#txtBuscarTag').val();
            $.ajax({
                url: url,
                method:'GET',
                data: {tag: tagbuscar, estado: this.value}
            }).done(function (data) {
                $('.tags').html(data);
                // console.log(data);
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        })

        $('#imgEtiqueta').change(function(){
        
            let img = $('input[name="imgEtiqueta"]')[0].files;
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/tags/subirImagenTmp";
            let imgBannerEtiqueta = new FormData();
            let id = generateString(3);
            imgBannerEtiqueta.append("imagen",img[0]);
            imgBannerEtiqueta.append("indice",1);
            $('#imgEtiqueta_preview').html("");
            $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: imgBannerEtiqueta,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        if(response.code==200)
                        {
                            let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                            let urlimage = urlraiz + response.data.url;
                            let img_id = 'imgprincipal' + id;
                            previewtmpimage_col12(urlimage, 'imgEtiqueta_preview',img_id, response.data.name, response.data.size, 'imgetiqueta', 'removeEtiquetaImg', 'tag_id');
                            document.getElementById('imgEtiqueta').value="";
                        }
                        else  if(response.code == "422")
                        {
                            document.getElementById('imgEtiqueta').value="";
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
                            document.getElementById('imgEtiqueta').value="";

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar actualizar el registro!'
                            })
                        }
                    },
                    error: function(response) {
                        document.getElementById('imgEtiqueta').value="";
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
            });
        })

        $('#formTag').submit(function(event){
            event.preventDefault();
            let hddetiqueta_id = $('#hddetiqueta_id').val();
            if(hddetiqueta_id!="")
            {
                ActualizarTag(hddetiqueta_id);
            }
            else 
            {
                GuardarTag();
            }
        });

        window.limpiarModalTag = function() {
            $('#tituloModalTag').html('AGREGAR ETIQUETA');
            $('#hddetiqueta_id').val("");
            $('#txtEtiqueta').val("");
            $('#chkEstadoTag').prop('checked', true);
            $('#slugtag_actual').val("");
            $('#imgEtiqueta').val("");
            $('#imgEtiquetaActual').val("");
            $('#imgEtiqueta_preview').html("");
        }

        window.GuardarTag = function()
        {
            $("#btnGuardarTag").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin" + "/tags";
            let imgEtiqueta = '';
            if(document.getElementById('imgetiqueta')!==null)
            {
                imgEtiqueta = $('#imgetiqueta').val();
            }
            let data = {
                tag: $("#txtEtiqueta").val(),
                estado: $('#chkEstadoTag').prop('checked'),
                imgEtiqueta: imgEtiqueta,
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
                    $("#btnGuardarTag").prop('disabled', false);
                    if(response.code == "200")
                    {
                           
                            $("#ModalTag").modal('hide');
                            limpiarModalTag();
                            loadtags();

                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha registrado la Etiqueta correctamente'
                            });
                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
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
                    // else if(response.code=="426")
                    // {
                    //     Swal.fire({
                    //             icon: 'error',
                    //             title: 'ERROR!',
                    //             text: 'La Etiqueta ya Existe!'
                    //         });
                    // }
                    else 
                    {
                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'Ha ocurrido un error al intentar registrar la Etiqueta!'
                            });
                    }
                }
            })

        }

        window.mostrarEtiqueta = function(etiqueta_id)
        {
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/tags/" +etiqueta_id;
            $("#ModalTag").modal('show');
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                // let valores = JSON.parse(data)
                $('#imgEtiqueta_preview').html("");
                $('#tituloModalTag').html('EDITAR ETIQUETA: ' +data['tag'][0]['tag']);
                $('#hddetiqueta_id').val(etiqueta_id);
                $('#txtEtiqueta').val(data['tag'][0]['tag']);
                $('#slugtag_actual').val(data['tag'][0]['url']);
                if(data['tag'][0]['estado'] == "1")
                {
                    $('#chkEstadoTag').prop('checked', true)
                }
                else 
                {
                    $('#chkEstadoTag').prop('checked', false)
                }
                if(!empty(data['tag'][0]['img']))
                {
                  
                    $('#imgEtiquetaActual').val(data['tag'][0]['img']);
                    // $('#imgEtiqueta_preview').removeAttr('hidden');
                    loadimage(data['tag'][0]['img'],'imgEtiqueta_preview','imgetiqueta','removeEtiquetaImg',data['tag'][0]['nombre_img'], etiqueta_id, data['tag'][0]['size_img'],'etiqueta_id',0);
                }   
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }

        window.ActualizarTag = function(etiqueta_id)
        {
            $("#btnGuardarTag").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/tags/" + etiqueta_id;
            let imgEtiqueta = '';
            if(document.getElementById('imgetiqueta')!==null)
            {
                imgEtiqueta = $('#imgetiqueta').val();
            }
            let data = {
                tag_id: etiqueta_id,
                tag: $("#txtEtiqueta").val(),
                estado: $('#chkEstadoTag').prop('checked'),
                slug_actual: $('#slugtag_actual').val(),
                imgEtiqueta: imgEtiqueta,
                imgEtiquetaActual: $('#imgEtiquetaActual').val(),
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
                    $("#btnGuardarTag").prop('disabled', false);
                    if(response.code == "200")
                    {
                            limpiarModalTag();
                            $("#ModalTag").modal('hide');
                            loadtags();

                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha actualizado la Etiqueta correctamente'
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
                    $("#btnGuardarTag").prop('disabled', false);
    
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            });
        }

        window.eliminarEtiqueta = function(etiqueta_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de eliminar la Etiqueta?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Eliminar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") + "/admin" + "/tags/"  + etiqueta_id;
                        let data = {
                            etiqueta_id: etiqueta_id
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
                                    loadtags();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha eliminado la Etiqueta correctamente'
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

        window.desactivarEtiqueta = function(etiqueta_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de desactivar la Etiqueta?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Desactivar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/tags" +  "/desactivar/" + etiqueta_id;
                        let data = {
                            etiqueta_id: etiqueta_id
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
                                    loadtags();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha desactivado la Etiqueta correctamente'
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

        window.activarEtiqueta = function(etiqueta_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de activar la Etiqueta?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/tags" +  "/activar/" + etiqueta_id;
                        let data = {
                            etiqueta_id: etiqueta_id
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
                                    loadtags();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha activado la Etiqueta correctamente'
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