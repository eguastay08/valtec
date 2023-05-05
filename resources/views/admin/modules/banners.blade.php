@extends('admin.master')

@section('title', 'Módulo de Banners')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE BANNERS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-images"></i> Banners</li>
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
                    <label for="estadoBannerBuscar" style="font-size:14px;">Estado:</label>
                    <select name="estadoBannerBuscar" id="estadoBannerBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            @can('admin.banners.crear')
            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw btn-mt" data-toggle="modal" data-target="#ModalBanner"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Banner</button>
                </div>
            </div>
            @endcan

        </div>

        <div class="row">

            <div class="col-12 grid-margin">

                <div class="card">
                    
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-images"></i>
                            Listado de Banners
                        </h4>
                        <section class="tbl-banners">
                            @if(isset($banners) && count($banners) > 0)
                                
                                @include('admin.data.load_banners_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Titulo</th>          
                                            <th>Link</th>
                                            <th>Ubicación</th>          
                                            <th>Posición</th>                 
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="8">No se encontraron registros</td>
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
                                    <td style="font-size:14px">Editar Banner</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Banner</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Banner</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Banner</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

    @can('admin.banners.crear')
      <!-- Modal Agregar -->
    <div class="modal fade" id="ModalBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formBanner" name="formBanner" enctype="multipart/form-data"> 

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalBanner" style="color:white !important">AGREGAR BANNER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalBanner()">
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
                                            <label for="txtTituloBanner"><b>Titulo:</b></label>
                                            <input type="hidden" name="hdd_banner_id" id="hdd_banner_id" value="">
                                            <input type="text" class="form-control ml-2" id="txtTituloBanner"  name="txtTituloBanner" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Titulo">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtLinkBanner"><b>Link:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtLinkBanner"  name="txtLinkBanner" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Link">
                                        </div>

                                        <div class="form-group">
                                            <label for="tamanioBanner"><b>Tamaño:</b></label>
                                            <select name="tamanioBanner" id="tamanioBanner"  class="form-control ml-2 selectpicker">
                                                <option value="">-Seleccione-</option>
                                                @for ($i = 1; $i <=12; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="ubicacionBanner"><b>Ubicación:</b></label>
                                            <select name="ubicacionBanner" id="ubicacionBanner"  class="form-control ml-2 selectpicker">
                                                <option value="">-Seleccione-</option>
                                                @isset($bloques)
                                                    @foreach($bloques as $blo)
                                                        <option value="{{ $blo->bloque_id }}">{{ $blo->titulo }}</option>
                                                    @endforeach
                                                @endisset
                                            
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="estiloBanner"><b>Estilo:</b></label>
                                            <select name="estiloBanner" id="estiloBanner" class="form-control ml-2 selectpicker">
                                                <option value="">-Seleccione-</option>
                                                @isset($bannerEstilos)
                                                    @foreach($bannerEstilos as $bae)
                                                        <option value="{{ $bae->banner__estilo_id }}">{{ $bae->nombre }}</option>
                                                    @endforeach
                                                @endisset
                                            
                                            </select>
                                        </div>

                                        <div class="form-group" id="posicionBannerDV" hidden="hidden">
                                            <label for="posicionBanner"><b>Posición:</b></label>
                                            <input type="number" name="posicionBanner" id="posicionBanner" class="form-control" min="0">
                                            <input type="hidden" name="hdd_posicionBanner_actual" id="hdd_posicionBanner_actual">
                                        </div>


                                        <div class="form-group">
                                            <label for="chkEstadoBanner"><b>Estado:<b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoBanner" id="chkEstadoBanner" checked>  
                                                <label class="custom-control-label" for="chkEstadoBanner">Activo</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="bannerImg"><b>&nbsp;&nbsp;Imagen:</b></label>
                                            <input type="file" name="bannerImg" id="bannerImg" class="form-control">
                                            <input type="hidden" name="bannerImgActual" id="bannerImgActual" value="">
                                        </div>

                                        <div  id="bannerImg_preview" class="form-group row">
                                        </div>

                                        <div id="bannerSuperpuestoDV" class="form-group" hidden="hidden">
                                            <label for="bannerSuperpuesto"><b>&nbsp;&nbsp;Imagen Superpuesta:</b></label>
                                            <input type="file" name="bannerSuperpuesto" id="bannerSuperpuesto" class="form-control">
                                            <input type="hidden" name="bannerSuperpuestoActual" id="bannerSuperpuestoActual" value="">
                                        </div>

                                        <div  id="bannerSuperpuesto_preview" class="form-group row" hidden="hidden">
                                        </div>

                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarBanner"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarBanner" data-dismiss="modal" onclick="limpiarModalBanner()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
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
                loadBanners(page);
            }
        }
    });

    $(document).on('click', '.tbl-banners .pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadBanners(page);
    });

    function loadBanners(page)
    {
        let url='';
        let estado = $('#estadoBannerBuscar').val(); 
        url=$('meta[name=app-url]').attr("content")  + "/admin" + "/banners?page="+page;

        $.ajax({
            url: url,
            method:'GET',
            data: {estado: estado}
        }).done(function (data) {
            $('.tbl-banners').html(data);
        }).fail(function () {
            console.log("Failed to load data!");
        });
    }

    $('#estadoBannerBuscar').on('change', function (e ){
        let estadoBanner = this.value;
        ajaxBanner(estadoBanner);
    });

    
    function ajaxBanner(estado)
    {
        url=$('meta[name=app-url]').attr("content") + "/admin" + "/banners";

        $.ajax({
            url: url,
            method:'GET',
            data: {estado: estado}
        }).done(function (data) {
            $('.tbl-banners').html(data);
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    }

    $('#estiloBanner').on('change', function (e ){
        let value = this.value;
        if(value == 2)
        {
            $('#bannerSuperpuestoDV').removeAttr('hidden');
            $('#bannerSuperpuesto_preview').removeAttr('hidden');
        }
        else 
        {
            $('#bannerSuperpuestoDV').attr('hidden', 'hidden');   
            $('#bannerSuperpuesto_preview').attr('hidden', 'hidden');   
        }
    });

    function limpiarModalBanner()
    {
        $('#tituloModalBanner').html('AGREGAR BANNER');
        $('#hdd_banner_id').val("");
        $('#txtTituloBanner').val("");
        $('#txtLinkBanner').val("");
        $('#tamanioBanner').val("");
        $('#tamanioBanner').selectpicker("refresh");
        $('#ubicacionBanner').val("");
        $('#ubicacionBanner').selectpicker("refresh");
        $('#estiloBanner').val("");
        $('#estiloBanner').selectpicker("refresh");
        $('#posicionBanner').val("");
        $('#hdd_posicionBanner_actual').val("");
        $('#posicionBannerDV').attr('hidden', 'hidden');
        $('#chkEstadoBanner').prop('checked', true);
        $('#bannerImg').val("");
        $('#bannerImgActual').val("");
        $('#bannerImg_preview').html("");
        $('#bannerSuperpuesto').val("");
        $('#bannerSuperpuestoActual').val("");
        $('#bannerSuperpuestoDV').attr('hidden', 'hidden');
        $('#bannerSuperpuesto_preview').html("");
        $('#bannerSuperpuesto_preview').attr('hidden', 'hidden');
    }

    $('#bannerImg').change(function(){
        $("#btnGuardarBanner").prop('disabled', true);
        let bannerImg = $('input[name="bannerImg"]')[0].files;
        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners/subirImagenTmp";
        let bannerImgData = new FormData();
        let banner_id = generateString(3);
        bannerImgData.append("imagen",bannerImg[0]);
        bannerImgData.append("indice",1);
        $('#bannerImg_preview').html("");
        $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: bannerImgData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        if(response.code==200)
                        {
                            let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                            let urlBanner = urlraiz + response.data.url;
                            let imgBanner = 'imgBanner'+banner_id;
                            previewtmpimage_col12(urlBanner,'bannerImg_preview',imgBanner,response.data.name,response.data.size,'imgBanner','removeBanner','banner_id');
                            // $('#bannerImg_preview').append("<div class='img-div col-12' id='imgBanner"+banner_id+"'>" +
                            //         "<img src='"+urlBanner+"' class='img-fluid image img-thumbnail' title='"+response.data.name+"'>"+
                            //         "<div class='middle'>"+
                            //         "<button type='button' id='removeBanner-icon' value='imgBanner"+banner_id+"' class='btn btn-danger' name='"+response.data.name+"' temporal='1' banner_id=''>"+
                            //             "<i class='fa fa-trash'></i>"+
                            //         "</button>"+
                            //         "</div>"+
                            //         "<input value='"+response.data.name+"|*|"+response.data.size+"|*|1' name='imgBanner' id='imgBanner' type='hidden'>" +
                            //         "</div>");
                            document.getElementById('bannerImg').value="";
                            $("#btnGuardarBanner").prop('disabled', false);
                        }
                        else  if(response.code == "422")
                        {
                            document.getElementById('bannerImg').value="";
                            $("#btnGuardarBanner").prop('disabled', false);
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
                            document.getElementById('bannerImg').value="";
                            $("#btnGuardarBanner").prop('disabled', false);

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar actualizar el registro!'
                            })
                        }
                    },
                    error: function(response) {
                        document.getElementById('bannerImg').value="";
                        $("#btnGuardarBanner").prop('disabled', false);
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
            });
    });

    $('body').on('click', '#removeBanner-icon', function(evt){
        
        let divNameImg = this.value;
        let filenameImg = $(this).attr('name');
        let temporalImg = $(this).attr('temporal');
        let banner_id  = $(this).attr('banner_id');
        let superpuesto = 0;
        // console.log(filenameImg);
        if(temporalImg == 1)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners/eliminarImagenTmp";
            deleteTempImg(divNameImg, filenameImg, temporalImg, url, superpuesto);
        }
        else if(temporalImg == 0)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners/eliminarimg";
            deleteImg(divNameImg, filenameImg, banner_id, temporalImg, url, superpuesto);
            loadBanners();
        }
        
        evt.preventDefault();
    });

    $('#bannerSuperpuesto').change(function(){
        $("#btnGuardarBanner").prop('disabled', true);
        let bannerSuperpuestoImg = $('input[name="bannerSuperpuesto"]')[0].files;
        let estiloBanner = $('#estiloBanner').val();
        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners/subirImagenTmp";
        let bannerSuperpuestoData = new FormData();
        let bannersuper_id = generateString(3);
        bannerSuperpuestoData.append("imagen",bannerSuperpuestoImg[0]);
        bannerSuperpuestoData.append("indice",1);
        $('#bannerSuperpuesto_preview').html("");
        if(estiloBanner == 2)
        {
            $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: bannerSuperpuestoData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        if(response.code==200)
                        {
                            $('#bannerSuperpuesto_preview').removeAttr('hidden');
                            let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                            let urlBannerSuper = urlraiz + response.data.url;
                            let imgBannerSuperpuesto = 'imgBannerSuperpuesto'+bannersuper_id;
                            previewtmpimage_col12(urlBannerSuper,'bannerSuperpuesto_preview',imgBannerSuperpuesto,response.data.name,response.data.size,'imgBannerSuperpuesto','removeBannerSuperpuesto','bannerSuperpuesto_id');
                            document.getElementById('bannerSuperpuesto').value="";
                            $("#btnGuardarBanner").prop('disabled', false);
                        }
                        else  if(response.code == "422")
                        {
                            document.getElementById('bannerSuperpuesto').value="";
                            $("#btnGuardarBanner").prop('disabled', false);
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
                            document.getElementById('bannerSuperpuesto').value="";
                            $("#btnGuardarBanner").prop('disabled', false);

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar procesar el registro!'
                            });
                        }
                    },
                    error: function(response) {
                        document.getElementById('bannerSuperpuesto').value="";
                        $("#btnGuardarBanner").prop('disabled', false);
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar procesar el registro!'
                        });
                    }
            });
        }
        else 
        {
            document.getElementById('bannerImg').value="";

                Swal.fire({
                    icon: 'error',
                    title: 'ERROR...',
                    text: 'La operación no es válida para los estilos de Banner seleccionados'
                })
        }
        
    });

    $('body').on('click', '#removeBannerSuperpuesto-icon', function(evt){
       
        let divNameImg = this.value;
        let filenameImg = $(this).attr('name');
        let temporalImg = $(this).attr('temporal');
        let bannerSuperpuesto_id  = $(this).attr('bannerSuperpuesto_id');
        let superpuesto = 1;
        // console.log(filenameImg);
        if(temporalImg == 1)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners/eliminarImagenTmp";
            deleteTempImg(divNameImg, filenameImg, temporalImg, url);
        }
        else if(temporalImg == 0)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners/eliminarimg";
            deleteImg(divNameImg, filenameImg, bannerSuperpuesto_id, temporalImg, url, superpuesto);
            loadBanners();
        }
        
        evt.preventDefault();
    });

    $('#formBanner').submit(function(event){
        event.preventDefault();
        let hdd_banner_id = $('#hdd_banner_id').val();
        if(hdd_banner_id!="")
        {
            ActualizarBanner(hdd_banner_id);
        }
        else 
        {
            GuardarBanner();
        }
    });

    window.GuardarBanner = function()
    {
        $("#btnGuardarBanner").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/admin" + "/banners";
        let data = $('#formBanner').serialize();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: data,
            success: function(response) {
                $("#btnGuardarBanner").prop('disabled', false);
                if(response.code == "200")
                {
                    loadBanners();
                    $("#ModalBanner").modal('hide');
                    limpiarModalBanner();

                    Swal.fire({
                        icon: 'success',
                        title: 'ÉXITO!',
                        text: 'Se ha registrado el Banner correctamente'
                    });
                }
                else  if(response.code == "422")
                {
                        let errors = response.errors;
                        let banerValidation = '';

                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                banerValidation += '<li>' + value + '</li>';
                            }

                        }); 

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            html: '<ul>'+
                            banerValidation  + 
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
                            text: 'Ha ocurrido un error al intentar registrar el Banner!'
                        });
                }
            }
        })

    }

    window.mostrarBanner = function(banner_id)
    {
        url=$('meta[name=app-url]').attr("content") + "/admin" + "/banners/" +banner_id;
        $("#ModalBanner").modal('show');
        $.ajax({
            url: url,
            method:'GET'
        }).done(function (data) {
            $('#bannerImg_preview').html("");
            $('#tituloModalBanner').html('EDITAR BANNER');
            $('#hdd_banner_id').val(banner_id);
            $('#txtTituloBanner').val(data.titulo);
            $('#txtLinkBanner').val(data.link);
            $('#tamanioBanner').val(data.columnas);
            $('#tamanioBanner').selectpicker("refresh");
            $('#ubicacionBanner').val(data.bloque_id);
            $('#ubicacionBanner').selectpicker("refresh");
            $('#estiloBanner').val(data.banner__estilo_id);
            $('#estiloBanner').selectpicker("refresh");
            $('#posicionBannerDV').removeAttr('hidden');
            $('#posicionBanner').val(data.posicion);
            $('#hdd_posicionBanner_actual').val(data.posicion);
            
            if(data.estado == "1")
            {
                $('#chkEstadoBanner').prop('checked', true)
            }
            else 
            {
                $('#chkEstadoBanner').prop('checked', false)
            }

            if(data.banner!="")
            {
                $('#bannerImgActual').val(data.banner);
                $('#bannerImg_preview').removeAttr('hidden');
                loadimage(data.banner,'bannerImg_preview','imgBanner','removeBanner',data.nombre_banner, banner_id, data.size_banner,'Banner_id',0);
            }

            if(data.banner__estilo_id == 2)
            {
                $('#bannerSuperpuestoDV').removeAttr('hidden');
                if(data.banner_superpuesto!="")
                {
                    $('#bannerSuperpuestoActual').val(data.banner_superpuesto);
                    $('#bannerSuperpuesto_preview').removeAttr('hidden');
                    loadimage(data.banner_superpuesto,'bannerSuperpuesto_preview','imgBannerSuperpuesto','removeBannerSuperpuesto',data.nombre_banner_superpuesto, banner_id, data.size_banner_superpuesto,'bannerSuperpuesto_id',0);
                }            
            }
           
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    }

    window.ActualizarBanner = function (banner_id)
    {
        $("#btnGuardarBanner").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners/" + banner_id;
            let data = $('#formBanner').serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#btnGuardarBanner").prop('disabled', false);
                    console.log(response);
                    if(response.code == "200")
                    {
                        loadBanners();
                        $("#ModalBanner").modal('hide');
                        limpiarModalBanner();
              
                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado el Banner correctamente'
                        });
                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let banerValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    banerValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                banerValidation  + 
                                        '</ul>'
                                });
                    }     
                    else  if(response.code == "423")
                    {

                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'No existe la posición para el estilo de Banner Seleccionado!'
                            });
                    }   
                    else 
                    {
                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'Ha ocurrido un error al intentar actualizar el Banner!'
                            });
                    }    
                },
                error: function(response) {
                    $("#btnGuardarBanner").prop('disabled', false);
    
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            });
    }

    window.eliminarBanner = function(banner_id)
    {
        Swal.fire({
            icon: 'warning',
            title: 'Está seguro de eliminar el Banner?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonColor: "#EB1010",
            confirmButtonText: `Eliminar`,
            cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners/"  + banner_id;
                    let data = {
                        banner_id: banner_id
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
                                loadBanners();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha eliminado el Banner correctamente'
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

    window.desactivarBanner = function(banner_id)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está seguro de desactivar el Banner?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Desactivar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners" +  "/desactivar/" + banner_id;
                        let data = {
                            banner_id: banner_id
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
                                    loadBanners();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha desactivado el Banner correctamente'
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
    
    window.activarBanner = function(banner_id)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está seguro de activar el Banner?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/banners" +  "/activar/" + banner_id;
                        let data = {
                            banner_id: banner_id
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
                                    loadBanners();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha activado el Banenr correctamente'
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
   

</script>

@endsection
