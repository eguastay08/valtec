@extends('admin.master')

@section('title', 'Mantemiento Noticia')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
            {{ isset($noticia) ? 'FORMULARIO DE ACTUALIZACIÓN DE NOTICIA' : 'FORMULARIO DE REGISTRO DE NOTICIA' }}
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/noticias') }}" class="colorfont"> <i class="fas fa-bezier-curve"></i> Noticias</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ isset($noticia) ? 'Actualización de Noticia':'Registro de Noticia' }}</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-12 grid-margin stretch-card">

                <div class="card">

                    <form method="POST" action="{{ url('admin/noticias') }}" id="formNoticia">

                        @csrf

                        <div class="card-body">

                            <h3 class="card-title">Datos de la Noticia</h3>

                            <div class="form-group row">
          
                                <div class="col-12">
                                    <input type="hidden" name="hddnoticia_id" id="hddnoticia_id" value="{{ isset($noticia) ? $noticia->noticia_id : '' }}">
                                    <input type="hidden" name="hddusuario" id="hddusuario" value="{{Auth::user()->usuario}}">
                                    <label for="tituloNoticia"><b><span style="color:#AB0505;">(*)</span> Título:</b></label>
                                    <input type="text" class="form-control ml-2" id="tituloNoticia"  name="tituloNoticia" placeholder="Ingrese el Título de la Noticia.." value="{{ isset($noticia) ? $noticia->noticia : '' }}">
                                </div>

                            </div>
                            
                            <div class="form-group row">

                                <div class="col-lg-6 col-md-12">
                                <label for="categoriaNoticia"><b><span style="color:#AB0505;">(*)</span> Categoría Noticia:</b></label>
                                    <select class="form-control form-control-lg ml-2 selectpicker" name="categoriaNoticia[]" id="categoriaNoticia" multiple data-live-search="true">
                                        <!-- <option value="">--Seleccione--</option> -->
                                        @isset($noticias_categorias)
                                            @foreach ($noticias_categorias as $nc)
                                                <option value="{{$nc['noticia_categoria_id']}}" {{isset($noticiascategorias_Array) && in_array($nc['noticia_categoria_id'], $noticiascategorias_Array) ? 'selected' : ''}}>{{$nc['noticia_categoria']}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                
                                <div class="col-lg-6 col-md-12">
                                    <label for="tagsNoticia"><b>Etiquetas Noticias:</b></label>
                                    <select class="form-control form-control-lg ml-2 selectpicker" name="tagsNoticia[]" id="tagsNoticia" multiple data-live-search="true">
                                        <!-- <option value="">--Seleccione--</option> -->
                                        @if(isset($noticias_tags) && count($noticias_tags)>0)
                                            @foreach ($noticias_tags as $nt)
                                  
                                                <option value="{{$nt->noticia_tag_id}}" {{isset($noticiasetiquetas_Array) && in_array($nt->noticia_tag_id, $noticiasetiquetas_Array) ? 'selected' : ''}}>{{$nt->noticia_tag}}</option>  

                                            @endforeach

                                        @endif

                                    </select>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="descripcionNoticia"><b>&nbsp;&nbsp;Descripción de la Noticia:</b></label>
                                    <textarea class="form-control ml-2" name="descripcionNoticia" id="descripcionNoticia" cols="20" rows="7" placeholder="Ingrese la Descripción..">
                                        {{isset($noticia) ? $noticia->descripcion: ''}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="imgNoticia"><b>&nbsp;&nbsp;Imagen Principal:</b></label>
                                    <input type="file" name="imgNoticia" id="imgNoticia" class="form-control">
                                    @if(isset($imgnoticiaprincipal))
                                        <input type="hidden" name="idImgNoticia" id="idImgNoticia" value="{{$imgnoticiaprincipal->noticia_imagen_id}}">
                                    @endif
                                </div>
                            </div>

                            <div  id="imgNoticiaPrincipal_Preview" class="form-group row">

                                @if(isset($imgnoticiaprincipal))
                                    <div class="img-div col-md-3 col-6" id="imgNoticia{{$imgnoticiaprincipal->noticia_imagen_id}}">
                                        <img src="{{URL::asset($imgnoticiaprincipal->url)}}" class="img-fluid image img-thumbnail" title="{{$imgnoticiaprincipal->imagen}}">
                                        <div class="middle">
                                            <button type="button" id="imgnoticia-action-icon" value="imgNoticia{{$imgnoticiaprincipal->noticia_imagen_id}}" class="btn btn-danger" name="{{$imgnoticiaprincipal->imagen}}" temporal="0" noticia_id='{{$imgnoticiaprincipal->noticia_id}}' image_id='{{$imgnoticiaprincipal->noticia_imagen_id}}'>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <a class="btn btn-info" download href="{{URL::asset($imgnoticiaprincipal->url)}}"><i class="fas fa-download"></i></a>
                                        </div>
                                        <input value="{{$imgnoticiaprincipal->imagen}}|*|{{$imgnoticiaprincipal->size}}|*|0" name="imgnoticia" type="hidden">
                                    </div> 
                                @endif
                        
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="imgGaleriaNoticia"><b>&nbsp;&nbsp;Galeria Noticia:</b></label>
                                    <input type="file" name="imgGaleriaNoticia[]" id="imgGaleriaNoticia" multiple class="form-control">
                                </div>
                               
                            </div>

                            <div  id="imgGaleriaNoticia_preview" class="form-group row">
                                @if(isset($imgnoticiagaleria)&&count($imgnoticiagaleria)>0)
                                    @foreach($imgnoticiagaleria as $filesn):
                                        <div class="img-div col-md-3 col-6" id="imgGaleriaNoticia{{$filesn->noticia_imagen_id}}">
                                            <img src="{{URL::asset($filesn->url)}}" class="img-fluid image img-thumbnail" title="{{$filesn->imagen}}">
                                            <div class="middle">
                                                <button type="button" id="galeriaNoticia-action-icon" value="imgGaleriaNoticia{{$filesn->noticia_imagen_id}}" class="btn btn-danger" name="{{$filesn->imagen}}" temporal="0" noticia_id='{{$filesn->noticia_id}}' image_id='{{$filesn->noticia_imagen_id}}'>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a class="btn btn-info" download href="{{URL::asset($filesn->url)}}"><i class="fas fa-download"></i></a>
                                            </div>
                                            <input value="{{$filesn->imagen}}|*|{{$filesn->size}}|*|0" name="imagenes[]" type="hidden">
                                        </div> 
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="chkEstadoNoticia"><b>&nbsp;&nbsp;Estado:<b></label>
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input type="checkbox" class="custom-control-input" name="chkEstadoNoticia" id="chkEstadoNoticia" {{isset($noticia) && $noticia->estado == 1 ? 'checked':''}}>  
                                        <label class="custom-control-label" for="chkEstadoNoticia">Activo</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="form-group">

                                <p class="help-block font-weight-bold"><span style="color:#AB0505;">Nota: (*) Campos Obligatorios</span></p> 
                                <a class="btn btn-danger btn-icon-split" href="{{ url('/admin/noticias') }}"> <span class="icon text-white-50"><img src="{{ url('admin_assets/images/cancel.png') }}" width="24px"></span><span class="text">Cancelar</span></a>
                                <button type="submit" class="btn btn-dark btn-icon-split" id="guardarNoticia"><span class="icon text-white-50"><img src="{{ url('admin_assets/images/save.png') }}" width="24px"></span><span class="text">Guardar</span></button> 
                                                    
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{ asset('admin_assets/vendors/ckeditor4_26/ckeditor.js') }}"></script>

    <script>

        // CKEDITOR.replace('descripcionNoticia');
        // CKEDITOR.config.allowedContent = true;

        CKEDITOR.replace('descripcionNoticia', {
            filebrowserUploadUrl: "{{route('noticias.upload_img_desc', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        //comenzamos hacer un fileupload propio

        $('#imgNoticia').change(function(){
            
            let img = $('input[name="imgNoticia"]')[0].files;
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticias/subirImagenTmp";
            let imgDataprincipal = new FormData();
            let id = generateString(3);
            imgDataprincipal.append("imagen",img[0]);
            imgDataprincipal.append("indice",1);
            $('#imgNoticiaPrincipal_Preview').html("");
            $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: imgDataprincipal,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        if(response.code==200)
                        {
                            let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                            let urlimage = urlraiz + response.data.url;
                            let img_id = 'imgNoticia' + id;
                            previewtmpimage_col3(urlimage, 'imgNoticiaPrincipal_Preview',img_id, response.data.name, response.data.size, 'imgnoticia', 'imgnoticia-action', 'noticia_id');
                        
                            document.getElementById('imgNoticia').value="";
                        }
                        else  if(response.code == "422")
                        {
                            document.getElementById('imgNoticia').value="";
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
                            document.getElementById('imgNoticia').value="";

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar actualizar el registro!'
                            })
                        }
                    },
                    error: function(response) {
                        document.getElementById('imgNoticia').value="";
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
            });
        });

        $('#imgGaleriaNoticia').change(function(){

            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticias/subirImagenTmp";
            let galeria = $('input[name="imgGaleriaNoticia[]"]')[0].files;
            let imgData = new FormData();

            for (let i = 0; i < galeria.length; i++) 
            {
                let id = generateString(3);
                imgData.append("imagen",galeria[i]);
                imgData.append("indice",i);

                $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: imgData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        if(response.code==200)
                        {
                            let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                            let urlGaleriaProducto = urlraiz + response.data.url;
                            let galeriaProducto_id = 'imgGaleriaNoticia' + id;
                            previewtmpimage_col3(urlGaleriaProducto, 'imgGaleriaNoticia_preview',galeriaProducto_id, response.data.name, response.data.size, 'imagenesNoticias[]', 'galeriaNoticia-action', 'noticia_id');
                            document.getElementById('imgGaleriaNoticia').value="";
                        }
                        else  if(response.code == "422")
                        {
                            document.getElementById('imgGaleriaNoticia').value="";
                            let errors = response.errors;
                            let Galeriavalidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    Galeriavalidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                Galeriavalidation  + 
                                        '</ul>'
                            });
                        }
                        else 
                        {
                            document.getElementById('imgGaleriaNoticia').value="";
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar actualizar el registro!'
                            })
                        }
                    },
                    error: function(response) {
                        document.getElementById('imgGaleriaNoticia').value="";
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                })
            }
        });

        $('body').on('click', '#imgnoticia-action-icon', function(evt){
            let divNameImg = this.value;
            let filenameImg = $(this).attr('name');
            let temporalImg = $(this).attr('temporal');
            let noticia_id  = $(this).attr('noticia_id');
            let image_id = $(this).attr('image_id');
            if(temporalImg == 1)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticias/eliminarImagenTmp";
                deleteTempImg(divNameImg, filenameImg, temporalImg, url);
            }
            else if(temporalImg == 0)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticias/eliminarImagen";
                deleteImg(divNameImg, filenameImg, image_id, temporalImg, url, 0, noticia_id);
                $('#idImgNoticia').val("");
            }
            
            evt.preventDefault();
        });

        $('body').on('click', '#galeriaNoticia-action-icon', function(evt){
        
            let divNameGaleria = this.value;
            let filenameGaleria = $(this).attr('name');
            let temporalGaleria = $(this).attr('temporal');
            let noticia_idG  = $(this).attr('noticia_id');
            let image_idG = $(this).attr('image_id');
            if(temporalGaleria == 1)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticias/eliminarImagenTmp";
                deleteTempImg(divNameGaleria, filenameGaleria, temporalGaleria, url);
            }
            else if(temporalGaleria == 0)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/noticias/eliminarImagen";
                deleteimgGaleria(divNameGaleria, filenameGaleria, noticia_idG, image_idG, url);
            }
            evt.preventDefault();

        });

        $('#guardarNoticia').click(function(event){
            event.preventDefault();
            let hddnoticia_id = $('#hddnoticia_id').val();
            if(hddnoticia_id!="")
            {
                actualizarNoticia(hddnoticia_id);
            }
            else 
            {
                guardarNoticia();
            }
        });

        window.guardarNoticia = function(){

            $("#guardarNoticia").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/noticias";
            let formData = new FormData($("#formNoticia")[0]); 
            formData.append("descripcionNoticia",CKEDITOR.instances['descripcionNoticia'].getData());

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function(response) {
                    $("#guardarNoticia").prop('disabled', false);
                    if(response.code == "200")
                    {   
                        Swal.fire({
                        icon: 'success',
                        title: 'ÉXITO!',
                        text: 'Se ha registrado la Noticia correctamente',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = response.url;
                            }
                        });

                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let productoValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    productoValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                    productoValidation  + 
                                        '</ul>'
                            });
                    }
                },
                error: function(response) {
                    $("#guardarNoticia").prop('disabled', false);

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar guardar el registro!'
                    })
                }
            });
        }

        window.actualizarNoticia = function(noticia_id)
        {
            $("#guardarNoticia").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/noticias/" + noticia_id;
            let formDataEditar = new FormData($("#formNoticia")[0]); 
            formDataEditar.append("descripcionNoticia",CKEDITOR.instances['descripcionNoticia'].getData());
            formDataEditar.append('_method', 'PUT');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                enctype: 'multipart/form-data',
                data: formDataEditar,
                processData: false,  
                contentType: false,  
                success: function(response) {
                    $("#guardarNoticia").prop('disabled', false);
                    if(response.code == "200")
                    {   
                            Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado la Noticia correctamente',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = response.url;
                                }
                            });

                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let productoValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    productoValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                    productoValidation  + 
                                        '</ul>'
                            });
                    }
                },
                error: function(response) {
                    $("#guardarNoticia").prop('disabled', false);

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar guardar el registro!'
                    })
                }
            });
        }

    </script>

@endsection