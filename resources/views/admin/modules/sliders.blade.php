@extends('admin.master')

@section('title', 'Módulo de Sliders')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE SLIDERS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-camera-retro"></i> Sliders</li>
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

            
            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="popupSlider" style="font-size:14px;">Popup:</label>
                    <select name="popupSlider" id="popupSlider" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoSlider" style="font-size:14px;">Estado:</label>
                    <select name="estadoSlider" id="estadoSlider" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            @can('admin.sliders.crear')
            <div class="col-xl-2 col-md-6 col-sm-12">
                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw btn-mt" data-toggle="modal" data-target="#ModalSlider"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Slider</button>
                </div>
            </div>
            @endcan

            
        </div>

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-camera-retro"></i>
                            Listado de Sliders
                        </h4>
                        <section class="tbl-sliders">
                            @if(isset($sliders) && count($sliders) > 0)
                                
                                @include('admin.data.load_sliders_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Link</th>
                                            <th>Popup</th>          
                                            <th>Posición</th>                 
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="7">No se encontraron registros</td>
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
                                    <td style="font-size:14px">Editar Slider</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Slider</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Slider</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Slider</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>


    </div>

    @can('admin.sliders.crear')
     <!-- Modal Agregar -->
     <div class="modal fade" id="ModalSlider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formSlider" name="formSlider" enctype="multipart/form-data"> 

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalSlider" style="color:white !important">AGREGAR SLIDER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalSlider()">
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
                                            <label for="txtLinkSlider"><b>Link:</b></label>
                                            <input type="hidden" name="hdd_slider_id" id="hdd_slider_id" value="">
                                            <input type="text" class="form-control ml-2" id="txtLink"  name="txtLink" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Link">
                                        </div>

                                        <div id="divPosicion" class="form-group" hidden="hidden">
                                            <label for="txtLinkSlider"><b>Posición:</b></label>
                                            <input type="number" name="posicionslider" id="posicionslider" class="form-control" min="0">
                                            <input type="hidden" name="hdd_posicion_actual" id="hdd_posicion_actual">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtLinkSlider"><b>Popup:</b></label>
                                            <div class="form-inline">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="popupSlider" id="popupSlider1" value="0" checked>
                                                        NO
                                                    </label>
                                                </div>
                                                &nbsp;&nbsp; &nbsp;&nbsp;
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="popupSlider" id="popupSlider2" value="1">
                                                        SI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <label for="chkEstadoSlider"><b>Estado:<b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoSlider" id="chkEstadoSlider" checked>  
                                                <label class="custom-control-label" for="chkEstadoSlider">Activo</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="sliderImg"><b>&nbsp;&nbsp;Imagen:</b></label>
                                            <input type="file" name="sliderImg" id="sliderImg" class="form-control">
                                            <input type="hidden" name="sliderImgName" id="sliderImgName">
                                        </div>

                                        <div  id="imgSlider_preview" class="form-group row">
                                        </div>

                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarSlider"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarSlider" data-dismiss="modal" onclick="limpiarModalSlider()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
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
                loadsliders(page);
            }
        }
    });

    $(document).on('click', '.tbl-sliders .pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadsliders(page);
    });

    function loadsliders(page)
    {
        let url='';
        let popup = $('#popupSlider').val();
        let estado = $('#estadoSlider').val(); 
        url=$('meta[name=app-url]').attr("content")  + "/admin" + "/sliders?page="+page;

        $.ajax({
            url: url,
            method:'GET',
            data: {popup: popup, estado: estado}
        }).done(function (data) {
            $('.tbl-sliders').html(data);
        }).fail(function () {
            console.log("Failed to load data!");
        });
    }

    $('#popupSlider').on('change', function (e ){
        let popupslider = this.value;
        let estadoSlider = $('#estadoSlider').val();
        ajaxSliders(popupslider,estadoSlider);
    });

    $('#estadoSlider').on('change', function (e ){
        let popupslider = $('#popupSlider').val();
        let estadoSlider = this.value;
        ajaxSliders(popupslider,estadoSlider);
    });

    function ajaxSliders(popup,estado)
    {
        url=$('meta[name=app-url]').attr("content") + "/admin" + "/sliders";

        $.ajax({
            url: url,
            method:'GET',
            data: {popup: popup, estado: estado}
        }).done(function (data) {
            $('.tbl-sliders').html(data);
            // console.log(data);
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    }
   
    //imagen Slider
    $('#sliderImg').change(function(){
        let imgslider = $('input[name="sliderImg"]')[0].files;
        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/sliders/subirImagenTmp";
        let SliderData = new FormData();
        let slider_id = generateString(3);
        SliderData.append("imagen",imgslider[0]);
        SliderData.append("indice",1);
        $('#imgSlider_preview').html("");
        $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: SliderData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function(response) {
                    if(response.code==200)
                    {
                        let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                        let urlimgslider = urlraiz + response.data.url;
                        let slider_img_id = 'imgSlider' + slider_id;
                        previewtmpimage_col12(urlimgslider, 'imgSlider_preview',slider_img_id, response.data.name, response.data.size, 'imgSlider', 'removeslider', 'slider_id');
                        document.getElementById('sliderImg').value="";
                    }
                    else  if(response.code == "422")
                    {
                        document.getElementById('sliderImg').value="";
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
                        document.getElementById('sliderImg').value="";

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                },
                error: function(response) {
                    document.getElementById('sliderImg').value="";
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
        });
    });


    $('body').on('click', '#removeslider-icon', function(evt){
        
        let divNameImg = this.value;
        let filenameImg = $(this).attr('name');
        let temporalImg = $(this).attr('temporal');
        let slider_id  = $(this).attr('slider_id');


        if(temporalImg == 1)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/sliders/eliminarImagenTmp";
            deleteTempImg(divNameImg, filenameImg, temporalImg, url);
        }
        else if(temporalImg == 0)
        {
          
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/sliders/eliminarimg";
            deleteImg(divNameImg, filenameImg, slider_id, temporalImg, url);
            $('#sliderImgName').val("");
            loadsliders();
        }

        evt.preventDefault();
    });

    //fin imagen slider

    $('#formSlider').submit(function(event){
        event.preventDefault();
        let hdd_slider_id = $('#hdd_slider_id').val();
        if(hdd_slider_id!="")
        {
            ActualizarSlider(hdd_slider_id);
        }
        else 
        {
            GuardarSlider();
        }
    });

    function limpiarModalSlider()
    {
        $('#tituloModalSlider').html('AGREGAR SLIDER');
        $('#hdd_slider_id').val("");
        $('#txtLink').val("");
        $('#popupSlider1').prop('checked', true);
        $('#chkEstadoSlider').prop('checked', true);
        $('#imgSlider_preview').html("");
        $('#sliderImg').val("");
        $("#divPosicion").attr('hidden', 'hidden');
    }

    window.GuardarSlider = function()
    {
        $("#btnGuardarSlider").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/admin" + "/sliders";
        let data = {
            link: $("#txtLink").val(),
            popup: $("input:radio[name=popupSlider]:checked").val(),
            estado: $("#chkEstadoSlider").prop('checked'),
            imgSlider: $("#imgSlider").val()
        };
        // console.log(data);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: data,
            success: function(response) {
                $("#btnGuardarSlider").prop('disabled', false);
                if(response.code == "200")
                {
                        
                        $("#ModalSlider").modal('hide');
                        limpiarModalSlider();
                        loadsliders();

                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha registrado el Slider correctamente'
                        });
                }
                else  if(response.code == "422")
                {
                        let errors = response.errors;
                        let sliderValidation = '';

                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                sliderValidation += '<li>' + value + '</li>';
                            }

                        }); 

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            html: '<ul>'+
                                sliderValidation  + 
                                    '</ul>'
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

    window.mostrarSlider = function(slider_id)
    {
        url=$('meta[name=app-url]').attr("content") + "/admin" + "/sliders/" +slider_id;
        $("#ModalSlider").modal('show');
        $.ajax({
            url: url,
            method:'GET'
        }).done(function (data) {
            // let valores = JSON.parse(data)
            // console.log(data);
            $('#tituloModalSlider').html('EDITAR SLIDER');
            $('#hdd_slider_id').val(slider_id);
            $('#hdd_posicion_actual').val(data.posicion);
            $('#txtLink').val(data.link);
            if(data.popup=="0")
            {
                $('#popupSlider1').prop('checked', true);
            }
            else if(data.popup=="1")
            {
                $('#popupSlider2').prop('checked', true);
            }
            if(data.estado == "1")
            {
                $('#chkEstadoSlider').prop('checked', true)
            }
            else 
            {
                $('#chkEstadoSlider').prop('checked', false)
            }
            $('#divPosicion').removeAttr('hidden');
            $('#posicionslider').val(data.posicion);
            if(data.url!="")
            {
                $('#sliderImgName').val(data.nombre_img);
                loadimage(data.url,'imgSlider_preview','imgSlider','removeslider',data.nombre_img, slider_id, data.size_img,'slider_id',0);
            }
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    }

    window.ActualizarSlider = function(slider_id)
    {
        $("#btnGuardarSlider").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/sliders/" + slider_id;
        let data = {
            slider_id: slider_id,
            link: $("#txtLink").val(),
            posicion:$('#posicionslider').val(),
            posicion_actual:$('#hdd_posicion_actual').val(),
            popup: $("input:radio[name=popupSlider]:checked").val(),
            estado: $("#chkEstadoSlider").prop('checked'),
            imgSlider: $("#imgSlider").val(),
            sliderImgName:  $('#sliderImgName').val()
        };
        // console.log(data);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "PUT",
            data: data,
            success: function(response) {
                $("#btnGuardarSlider").prop('disabled', false);
                if(response.code == "200")
                {
                    limpiarModalSlider();
                    $("#ModalSlider").modal('hide');
                    loadsliders();

                    Swal.fire({
                        icon: 'success',
                        title: 'ÉXITO!',
                        text: 'Se ha actualizado el Slider correctamente'
                    });
                }
                else if(response.code == "422")
                {
                    let errors = response.errors;
                    let sliderValidation = '';

                    $.each(errors, function(index, value) {

                        if (typeof value !== 'undefined' || typeof value !== "") 
                        {
                            sliderValidation += '<li>' + value + '</li>';
                        }

                    }); 

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        html: '<ul>'+
                            sliderValidation  + 
                                '</ul>'
                    });
                }
                else if(response.code == "423")
                {
                    Swal.fire({
                    icon: 'error',
                    title: 'ERROR...',
                    text: 'No existe la posición ingresada!'
                })
                }
            },
            error: function(response) {
                $("#btnGuardarSlider").prop('disabled', false);

                Swal.fire({
                    icon: 'error',
                    title: 'ERROR...',
                    text: 'Se ha producido un error al intentar actualizar el registro!'
                })
            }
        });
    }

    window.eliminarSlider = function(slider_id)
    {
        Swal.fire({
            icon: 'warning',
            title: 'Está seguro de eliminar el Slider?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonColor: "#EB1010",
            confirmButtonText: `Eliminar`,
            cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/sliders/"  + slider_id;
                    let data = {
                        slider_id: slider_id
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
                                loadsliders();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha eliminado el Slider correctamente'
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

    window.desactivarSlider = function(slider_id)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está seguro de desactivar el Slider?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Desactivar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/sliders" +  "/desactivar/" + slider_id;
                        let data = {
                            slider_id: slider_id
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
                                    loadsliders();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha desactivado el Slider correctamente'
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

    window.activarSlider = function(slider_id)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está seguro de activar el Slider?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/sliders" +  "/activar/" + slider_id;
                        let data = {
                            slider_id: slider_id
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
                                    loadsliders();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha activado el Slider correctamente'
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

    window.popupSlider = function(slider_id, popup)
    {
        // let popup = $('#btnPopupSlider').attr('popup-value');
        // console.log(popup);
        Swal.fire({
                icon: 'warning',
                title: 'Está Seguro de Modificar el Slider?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
            }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/sliders" +  "/popup/" + slider_id;
                        let data = {
                            slider_id: slider_id,
                            popup: popup
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
                                    loadsliders();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha actualizado el Slider'
                                    });
                                    // document.location.reload(true)
                                }
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR...',
                                    text: 'Se ha producido un error al intentar modificar el registro!'
                                })
                            }
                        });
                    }
        })
    }


</script>

@endsection