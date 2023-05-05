@extends('admin.master')

@section('title', 'Módulo de Diseño')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE DISEÑO
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-palette"></i> Diseño</li>
                    </ol>
                </nav>
            </div>

        </div>

        @can('admin.disenio.crear')
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 d-flex justify-content-end">

                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw" data-toggle="modal" data-target="#ModalBloque"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Bloque</button>
                </div>

            </div>
        </div>
        @endcan

        <div class="row justify-content-md-center">
            
            <div class="col-md-6 col-md-offset-3">
                <h4 class="card-title">
                    <i class="fas fa-palette"></i>
                    Página Principal
                </h4>
                <div class="bloques">
                    @if(isset($bloques) && count($bloques) > 0)
                                
                        @include('admin.data.load_bloques_data')
                    
                    @else 

                        <ul class="list-group">

                            <li class="list-group-item list-group-item-info">
                                No se han encontrado registros
                            </li>

                        </ul>

                    @endif
                </div>
            </div>

        </div>

        <div class="row justify-content-center mt-5">
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
                                    <td style="font-size:14px">Editar Bloque</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Bloque</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Bloque</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Bloque</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/arrow_down.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Bajar Posición del Bloque</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/arrow_up.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Subir Posición del Bloque</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

    @can('admin.disenio.crear')
     <!-- Modal Agregar -->
     <div class="modal fade" id="ModalBloque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formBloque" name="formBloque">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalBloque" style="color:white !important">AGREGAR BLOQUE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalBloque()">
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
                                            <label for="txtCategoria"><b>Tipo:</b></label>
                                            <input type="hidden" name="hddbloque_id" id="hddbloque_id" value="">
                                            <input type="hidden" name="hdd_bloque_posicion" id="hdd_bloque_posicion" value="">
                                            <select name="tipobloque" id="tipobloque" class="form-control selectpicker" data-live-search="true">
                                                <option value="">--Seleccione--</option>
                                                @isset($tipoBloques)
                                                    @foreach ($tipoBloques as $tb)
                                                        <option value="{{$tb->bloque_tipo_id}}">{{$tb->nombre}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>

                                        <div id="categoriaBloqueDV" class="form-group" hidden="hidden">
                                            <label for="categoriaBloque"><b>Categoría:</b></label>
                                            <select name="categoriaBloque" id="categoriaBloque" class="form-control selectpicker" data-live-search="true">
                                                <option value="">--Seleccione--</option>    
                                                @isset($categorias)
                                                    @foreach ($categorias as $ct)
                                                    <option value="{{$ct['categoria_id']}}">{{$ct['categoria']}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>

                                        <div id="nroitemsBloque" class="form-group" hidden="hidden">
                                            <label for="nroitems"><b>Nro Items:</b></label>
                                            <input type="number" class="form-control ml-2" id="nroitems"  name="nroitems" min="0" steep="0"
                                                placeholder="Ingrese el nro de Items">
                                        </div>

                                        <div id="tituloBloqueDv" class="form-group" hidden="hidden">
                                            <label for="titulobloque"><b>Título:</b></label>
                                            <input type="text" class="form-control ml-2" id="titulobloque"  name="titulobloque" placeholder="Ingrese el título del bloque">
                                        </div>
                                        
                                        <div id="estadoBloqueDv"  class="form-group" hidden="hidden">
                                            <label for="chkEstadoBloque"><b>Estado:</b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoBloque" id="chkEstadoBloque" checked>  
                                                <label class="custom-control-label" for="chkEstadoBloque">Activo</label>
                                            </div>
                                        </div>

                                        <div id="iconoBloqueDv" class="form-group" hidden="hidden">
                                            <label for="IconoBloque"><b>&nbsp;&nbsp;Icono:</b></label>
                                            <input type="file" name="IconoBloque" id="IconoBloque" class="form-control">
                                            <input type="hidden" name="iconactualbloque" id="iconactualbloque" value="">
                                        </div>

                                        <div  id="IconoBloque_preview" class="form-group row" hidden="hidden">
                                        </div>
                                    
                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarBloque"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarBloque" data-dismiss="modal" onclick="limpiarModalBloque()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>
    @endcan


@endsection

@section('scripts')

    <script>

        function loadBloques()
        {
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/disenio";
            $.ajax({
                url: url
            }).done(function (data) {
                $('.bloques').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }

        function limpiarModalBloque()
        {
            $('#tituloModalBloque').html('AGREGAR BLOQUE');
            $('#hddbloque_id').val("");
            $('#hdd_bloque_posicion').val("");
            $('#tipobloque').val("");
            $('#tipobloque').selectpicker("refresh");
            $('#categoriaBloqueDV').attr('hidden', 'hidden');
            $('#categoriaBloque').val("");
            $('#categoriaBloque').selectpicker("refresh");
            $('#nroitemsBloque').attr('hidden', 'hidden');
            $('#nroitems').val("");
            $('#tituloBloqueDv').attr('hidden', 'hidden');
            $('#titulobloque').val("");
            $('#estadoBloqueDv').attr('hidden', 'hidden');
            $('#chkEstadoBloque').prop('checked', true);
            $('#iconoBloqueDv').attr('hidden', 'hidden');
            $('#IconoBloque').val("");
            $('#IconoBloque_preview').html("");
            $('#IconoBloque_preview').attr('hidden', 'hidden');
        }

        $('#tipobloque').on('change', function (e ){
            let tipobloqueval = this.value;
            if(tipobloqueval == 1 || tipobloqueval == 2)
            {
                $('#categoriaBloqueDV').removeAttr('hidden');
                $('#nroitemsBloque').removeAttr('hidden');
                $('#tituloBloqueDv').removeAttr('hidden');
                $('#estadoBloqueDv').removeAttr('hidden');
                $('#iconoBloqueDv').removeAttr('hidden');
                $('#IconoBloque_preview').removeAttr('hidden');
            }
            else if(tipobloqueval == 3 || tipobloqueval == 5)
            {
                $('#categoriaBloqueDV').attr('hidden', 'hidden');
                $('#nroitemsBloque').attr('hidden', 'hidden');
                $('#tituloBloqueDv').attr('hidden', 'hidden');
                $('#estadoBloqueDv').attr('hidden', 'hidden');

                $('#iconoBloqueDv').attr('hidden', 'hidden');
                $('#IconoBloque_preview').attr('hidden', 'hidden');

                $('#iconoBloqueDv').removeAttr('hidden');
                $('#IconoBloque_preview').removeAttr('hidden');
            }
            else if(tipobloqueval == 4)
            {
                $("#categoriaBloqueDV").attr('hidden', 'hidden');
                $("#nroitemsBloque").attr('hidden', 'hidden');
                $("#estadoBloqueDv").attr('hidden', 'hidden');
                $("#iconoBloqueDv").attr('hidden', 'hidden');
                $("#IconoBloque_preview").attr('hidden', 'hidden');
             
                $('#tituloBloqueDv').removeAttr('hidden');    
            }
            else 
            {   
                $('#tituloBloqueDv').attr('hidden', 'hidden');   
                $("#categoriaBloqueDV").attr('hidden', 'hidden');
                $("#nroitemsBloque").attr('hidden', 'hidden');
                $("#estadoBloqueDv").attr('hidden', 'hidden');
                $("#iconoBloqueDv").attr('hidden', 'hidden');
                $("#IconoBloque_preview").attr('hidden', 'hidden');
            }
           
        });

        $('#IconoBloque').change(function(){
            let iconBloque = $('input[name="IconoBloque"]')[0].files;
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio/subirImagenTmp";
            let iconBloqueData = new FormData();
            let bloque_id = generateString(3);
            iconBloqueData.append("imagen",iconBloque[0]);
            iconBloqueData.append("indice",1);
            $('#IconoBloque_preview').html("");
            $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: iconBloqueData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        if(response.code==200)
                        {
                            $('#IconoBloque_preview').removeAttr('hidden');
                            let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                            let urlicono = urlraiz + response.data.url;
                            let imgBloque = 'imgBloque'+bloque_id;
                            previewtmpimage_col12(urlicono,'IconoBloque_preview',imgBloque,response.data.name,response.data.size,'imgBloque','removeBloque','bloque_id');
                            // $('#IconoBloque_preview').append("<div class='img-div col-12' id='imgBloque"+c+"'>" +
                            //         "<img src='"+urlicono+"' class='img-fluid image img-thumbnail' title='"+response.data.name+"'>"+
                            //         "<div class='middle'>"+
                            //         "<button type='button' id='removeBloque-icon' value='imgBloque"+bloque_id+"' class='btn btn-danger' name='"+response.data.name+"' temporal='1' bloque_id=''>"+
                            //             "<i class='fa fa-trash'></i>"+
                            //         "</button>"+
                            //         "</div>"+
                            //         "<input value='"+response.data.name+"|*|"+response.data.size+"|*|1' name='imgBloque' id='imgBloque' type='hidden'>" +
                            //         "</div>");
                            document.getElementById('IconoBloque').value="";
                        }
                        else  if(response.code == "422")
                        {
                            document.getElementById('IconoBloque').value="";
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
                            document.getElementById('IconoBloque').value="";

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar actualizar el registro!'
                            })
                        }
                    },
                    error: function(response) {
                        document.getElementById('IconoBloque').value="";
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
            });
        });

        $('body').on('click', '#removeBloque-icon', function(evt){
        
            let divNameImg = this.value;
            let filenameImg = $(this).attr('name');
            let temporalImg = $(this).attr('temporal');
            let bloque_id  = $(this).attr('bloque_id');


            if(temporalImg == 1)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio/eliminarImagenTmp";
                deleteTempImg(divNameImg, filenameImg, temporalImg, url);
            }
            else if(temporalImg == 0)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio/eliminarimg";
                deleteImg(divNameImg, filenameImg, bloque_id, temporalImg, url);
                loadBloques();
            }
            
            evt.preventDefault();
        });

        // function deleteTempImg(div, file, temporal)
        // {
        //     let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio/eliminarImagenTmp";
        //     let DataSlider = new FormData();
        //     DataSlider.append("filename",file);
        //     $.ajax({
        //             headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             url: url,
        //             type: "POST",
        //             data: DataSlider,
        //             processData: false,  
        //             contentType: false,  
        //             success: function(response) {
        //                 if(response.code=='200')
        //                 {
        //                     $(`#${div}`).remove();
        //                 }
        //                 else 
        //                 {
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'ERROR...',
        //                         text: 'Se ha producido un error al intentar elminar el archivo!'
        //                     })
        //                 }
        //             }
        //     });
        // }

        // function deleteImg(div, file, bloque_id, temporal)
        // {
        //     let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio/eliminarimg";
        //     let formDataFi = new FormData();
        //     formDataFi.append("filename",file);
        //     formDataFi.append("bloque_id",bloque_id);
        //     formDataFi.append("temporal",temporal);
        //     $.ajax({
        //             headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             url: url,
        //             type: "POST",
        //             data: formDataFi,
        //             processData: false,  // tell jQuery not to process the data
        //             contentType: false,  // tell jQuery not to set contentType
        //             success: function(response) {
        //                 if(response.code=='200')
        //                 {
        //                     $(`#${div}`).remove();
        //                 }
        //                 else 
        //                 {
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'ERROR...',
        //                         text: 'Se ha producido un error al intentar elminar el archivo!'
        //                     })
        //                 }
        //             }
        //     });
        // }

        $('#formBloque').submit(function(event){
            event.preventDefault();
            let hddbloque_id = $('#hddbloque_id').val();
            if(hddbloque_id!="")
            {
                ActualizarBloque(hddbloque_id);
            }
            else 
            {
                GuardarBloque();
            }
        });

        window.GuardarBloque = function()
        {
            $("#btnGuardarBloque").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin" + "/disenio";
            let data = $('#formBloque').serialize();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#btnGuardarBloque").prop('disabled', false);
                    if(response.code == "200")
                    {
                        loadBloques();
                        $("#ModalBloque").modal('hide');
                        limpiarModalBloque();
                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha registrado el Bloque correctamente'
                        });
                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let disenioValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    disenioValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                disenioValidation  + 
                                        '</ul>'
                                });
                    }     
                    else  if(response.code == "423")
                    {

                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'El Título es obligatorio!'
                            });
                    }                 
                    else 
                    {
                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'Ha ocurrido un error al intentar registrar el Bloque!'
                            });
                    }
                }
            })

        }

        window.mostrarBloque = function(bloque_id)
        {
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/disenio/" +bloque_id;
            $("#ModalBloque").modal('show');
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {

                $('#IconoBloque_preview').html("");
                $('#tituloModalBloque').html('EDITAR BLOQUE');
                $('#hddbloque_id').val(bloque_id);
                $('#hdd_bloque_posicion').val(data.posicion);
                $('#tipobloque').val(data.bloque_tipo_id);
                $('#tipobloque').selectpicker("refresh");
                if(data.bloque_tipo_id == 1 || data.bloque_tipo_id == 2)
                {
                    let datajson = JSON.parse(data.config);
                    $('#categoriaBloqueDV').removeAttr('hidden');
                    $('#categoriaBloque').val(datajson.categoria);
                    $('#categoriaBloque').selectpicker("refresh");
                    $('#nroitemsBloque').removeAttr('hidden');
                    $('#nroitems').val(datajson.nro_items);
                    $('#tituloBloqueDv').removeAttr('hidden');
                    $('#titulobloque').val(data.titulo);
                    $('#estadoBloqueDv').removeAttr('hidden');
                    if(data.estado == "1")
                    {
                        $('#chkEstadoBloque').prop('checked', true)
                    }
                    else 
                    {
                        $('#chkEstadoBloque').prop('checked', false)
                    }
                    $('#iconoBloqueDv').removeAttr('hidden');
                    if(data.icono!="")
                    {
                        $('#iconactualbloque').val(data.nombre_icono);
                        $('#IconoBloque_preview').removeAttr('hidden');
                        loadimage(data.icono,'IconoBloque_preview','imgBloque','removeBloque',data.nombre_icono, bloque_id, data.size_icono,'bloque_id',0);
                        // $('#iconactualbloque').val(data.nombre_icono);
                        // $('#IconoBloque_preview').removeAttr('hidden');
                        // let urlIconoBloque = $('meta[name=app-url]').attr("content") + "/" + data.icono;
                        // $('#IconoBloque_preview').append("<div class='img-div col-12' id='imgBloque"+bloque_id+"'>" +
                        // "<img src='"+urlIconoBloque+"' class='img-fluid image img-thumbnail' title='Bloque"+bloque_id+"'>"+
                        // "<div class='middle'>"+
                        // "<button type='button' id='removeBloque-icon' value='imgBloque"+bloque_id+"' class='btn btn-danger' name='"+data.nombre_icono+"' temporal='0' bloque_id='"+bloque_id+"'>"+
                        //     "<i class='fa fa-trash'></i>"+
                        // "</button>"+
                        // "&nbsp;&nbsp;"+
                        // "<a class='btn btn-info' download href='"+urlIconoBloque+"'><i class='fas fa-download'></i></a>"+
                        // "</div>"+
                        // "<input value='"+data.nombre_icono+"|*|"+data.size_icono+"|*|0' name='imgBloque' id='imgBloque' type='hidden'>" +
                        // "</div>");
                    }
                    
                }
                else if(data.bloque_tipo_id == 3 || data.bloque_tipo_id == 5)
                {
                    $('#iconoBloqueDv').removeAttr('hidden');
                    if(data.icono!="")
                    {
                        $('#iconactualbloque').val(data.nombre_icono);
                        $('#IconoBloque_preview').removeAttr('hidden');
                        loadimage(data.icono, data.nombre_icono, bloque_id, data.size_icono);
                        // $('#iconactualbloque').val(data.nombre_icono);
                        // $('#IconoBloque_preview').removeAttr('hidden');
                        // let urlIconoBloque = $('meta[name=app-url]').attr("content") + "/" + data.icono;
                        // $('#IconoBloque_preview').append("<div class='img-div col-12' id='imgBloque"+bloque_id+"'>" +
                        // "<img src='"+urlIconoBloque+"' class='img-fluid image img-thumbnail' title='Bloque"+bloque_id+"'>"+
                        // "<div class='middle'>"+
                        // "<button type='button' id='removeBloque-icon' value='imgBloque"+bloque_id+"' class='btn btn-danger' name='"+data.nombre_icono+"' temporal='0' bloque_id='"+bloque_id+"'>"+
                        //     "<i class='fa fa-trash'></i>"+
                        // "</button>"+
                        // "&nbsp;&nbsp;"+
                        // "<a class='btn btn-info' download href='"+urlIconoBloque+"'><i class='fas fa-download'></i></a>"+
                        // "</div>"+
                        // "<input value='"+data.nombre_icono+"|*|"+data.size_icono+"|*|0' name='imgBloque' id='imgBloque' type='hidden'>" +
                        // "</div>");
                    }
                }
                else if(data.bloque_tipo_id == 4)
                {
                    $('#tituloBloqueDv').removeAttr('hidden');
                    $('#titulobloque').val(data.titulo);
                }

            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }

        window.ActualizarBloque = function(bloque_id)
        {
            $("#btnGuardarBloque").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio/" + bloque_id;
            let data = $('#formBloque').serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#btnGuardarBloque").prop('disabled', false);
                    if(response.code == "200")
                    {
                        loadBloques();
                        $("#ModalBloque").modal('hide');
                        limpiarModalBloque();
              
                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado el Bloque correctamente'
                        });
                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let disenioValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    disenioValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                disenioValidation  + 
                                        '</ul>'
                                });
                    }     
                    else  if(response.code == "423")
                    {

                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'El Título es obligatorio!'
                            });
                    }   
                    else 
                    {
                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'Ha ocurrido un error al intentar actualizar el Bloque!'
                            });
                    }    
                },
                error: function(response) {
                    $("#btnGuardarBloque").prop('disabled', false);
    
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            });
        }

        window.eliminarBloque = function(bloque_id)
        {
            Swal.fire({
            icon: 'warning',
            title: 'Está seguro de eliminar el Bloque?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonColor: "#EB1010",
            confirmButtonText: `Eliminar`,
            cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio/"  + bloque_id;
                    let data = {
                        bloque_id: bloque_id
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
                                loadBloques();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha eliminado el Bloque correctamente'
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

        window.desactivarBloque = function(bloque_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de desactivar el Bloque?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Desactivar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio" +  "/desactivar/" + bloque_id;
                        let data = {
                            bloque_id: bloque_id
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
                                    loadBloques();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha desactivado el Bloque correctamente'
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

        window.activarBloque = function(bloque_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de activar el Bloque?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio" +  "/activar/" + bloque_id;
                        let data = {
                            bloque_id: bloque_id
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
                                    loadBloques();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha activado el Bloque correctamente'
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
        
        window.bajarPosicion = function(bloque_id, posicion)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio" +  "/down/" + bloque_id;
            let data = {
                bloque_id: bloque_id,
                posicion: posicion
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    if(response.code == "200")
                    {
                        loadBloques();
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

        window.subirPosicion = function(bloque_id, posicion)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/disenio" +  "/up/" + bloque_id;
            let data = {
                bloque_id: bloque_id,
                posicion: posicion
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    if(response.code == "200")
                    {
                        loadBloques();
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

        
    </script>
@endsection