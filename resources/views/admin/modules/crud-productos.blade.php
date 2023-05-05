@extends('admin.master')

@section('title', 'Mantemiento Producto')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
            {{ isset($producto) ? 'FORMULARIO DE ACTUALIZACIÓN DE PRODUCTO' : 'FORMULARIO DE REGISTRO DE PRODUCTO' }}
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/productos') }}" class="colorfont"> <i class="fas fa-dolly-flatbed"></i> Productos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-dolly"></i> {{ isset($producto) ? 'Actualización de Producto':'Registro de Producto' }}</li>
                    </ol>
                </nav>
            </div>

        </div>

        
        <div class="row">

            <div class="col-12 grid-margin stretch-card">

                <div class="card">
                    
                    <form method="POST" action="{{ url('admin/productos') }}" enctype="multipart/form-data" id="formProducto">

                        @csrf

                        <div class="card-body">

                            <h3 class="card-title">Datos del producto</h3>

                            <div class="form-group row">
          
                                <div class="col-12">
                                    <input type="hidden" name="hddproducto_id" id="hddproducto_id" value="{{ isset($producto) ? $producto->producto_id : '' }}">
                                    <label for="nombreProducto"><b><span style="color:#AB0505;">(*)</span> Producto:</b></label>
                                    <input type="text" class="form-control ml-2" id="nombreProducto"  name="nombreProducto" placeholder="Ingrese el Nombre del Producto.." value="{{ isset($producto) ? $producto->producto : '' }}">
                                </div>
     
                            </div>

                            <div class="form-group row">
          
                                <div class="col-12">
                                    <label for="skuProducto"><b>SKU:</b></label>
                                    <input type="text" class="form-control ml-2" id="skuProducto"  name="skuProducto" placeholder="Ingrese el SKU del Producto.." value="{{ isset($producto) ? $producto->sku : '' }}" maxlength="13">
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="txtDescripcionProducto"><b>&nbsp;&nbsp;Descripción del Producto:</b></label>
                                    <textarea class="form-control ml-2" name="txtDescripcionProducto" id="txtDescripcionProducto" cols="20" rows="7" placeholder="Ingrese la Descripción..">
                                        {{isset($producto) ? $producto->descripcion_producto: ''}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label for="txtPrecioCompraProducto"><b>&nbsp;&nbsp;Precio Compra:</b></label>
                                    <input type="number" class="form-control ml-2" id="txtPrecioCompraProducto"  name="txtPrecioCompraProducto" placeholder="Ingrese el Precio Compra del Producto.." min="0" value="{{ isset($producto) ? $producto->precio_compra : '0.00' }}" step="0.01" >
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label for="txtPrecioProducto"><b>&nbsp;&nbsp;Precio:</b></label>
                                    <input type="number" class="form-control ml-2" id="txtPrecioProducto"  name="txtPrecioProducto" placeholder="Ingrese el Precio del Producto.." min="0" value="{{ isset($producto) ? $producto->precio : '0.00' }}" step="0.01" >
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <div class="custom-control custom-checkbox ml-2 mt-4">
                           
                                        <input class="checkbox" type="checkbox" name="checkdescuento" id="checkdescuento" onclick="activarDescuento()" {{ isset($producto) && $producto->descuento != '' ? 'checked': ''}}>
                                        <label class="form-check-label" for="chkEstadoProducto">Con Descuento</label>
                          
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label for="descuentoProducto"><b>&nbsp;&nbsp;Descuento:</b></label>
                                    <select class="form-control form-control-lg ml-2" name="descuentoProducto" id="descuentoProducto" {{ isset($producto) && $producto->descuento != '' ? '': 'disabled'}}>        
                                            @for ($j = 0; $j <=100; $j++)
                                                <option value="{{ $j }}" {{isset($producto) && intval($producto->descuento)==$j ? 'selected' : ''}}>{{ $j }}%</option>
                                            @endfor
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    
                                     <label for="txtPrecioProducto"><b>&nbsp;&nbsp;Fecha Finalización Descuento:</b></label>
                                    
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="example" name="fechafinalizacion" value="{{isset($producto) ? $producto->fecha_finalizacion:''}}" {{ isset($producto) && $producto->fecha_finalizacion != '' ? '': 'disabled'}}>
                                        <span class="input-group-addon input-group-append border-left">
                                        <span class="far fa-calendar input-group-text"></span>
                                        </span>
                                    </div> 
                                   
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <label for="txtMonedasProducto"><b>&nbsp;&nbsp;Monedas:</b></label>
                                    <input type="number" class="form-control ml-2" id="txtMonedasProducto"  name="txtMonedasProducto" placeholder="Ingrese las monedas del Producto.." min="0" value="{{ isset($producto) ? $producto->monedas : '0' }}">
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-6">
                                    <div class="custom-control custom-checkbox ml-2 mt-4">
                           
                                        <input class="checkbox" type="checkbox" name="chkStock" id="chkStock" onclick="activarStock()" {{ isset($producto) && $producto->stock > 0 ? 'checked': ''}}>
                                        <label class="form-check-label" for="chkEstadoProducto">Con Stock</label>
                          
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-5 col-sm-6">
                                    <label for="stockProducto"><b>&nbsp;&nbsp;Stock:</b></label>
                                    <input type="number" class="form-control ml-2" id="stockProducto"  name="stockProducto" placeholder="Ingrese el Stock del Producto.." min="0" value="{{isset($producto) ? $producto->stock:'0'}}" {{ isset($producto) && $producto->stock > 0  ? '': 'disabled'}}>
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-lg-6 col-md-12">

                                    <label for="videoProducto"><b> Video:</b></label>
                                    <input type="text" class="form-control ml-2" id="videoProducto"  name="videoProducto" placeholder="URl del video del Producto" value="{{ isset($producto) ? $producto->video : '' }}">

                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-4">
                                    <label for="txtPrecioProducto"><b>&nbsp;&nbsp;Envío a Domicilio:</b></label>
                                    <select class="form-control form-control-lg ml-2" name="enviodomicilioProducto" id="enviodomicilioProducto">        
                                          <option value="0" {{isset($producto) && $producto->envio_domicilio == "0" ? 'selected' : ''}}>No</option>
                                          <option value="1" {{isset($producto) && $producto->envio_domicilio == "1" ? 'selected' : ''}}>Si</option>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-4">
                                    <label for="txtPrecioProducto"><b>&nbsp;&nbsp;Recojo en Tienda:</b></label>
                                    <select class="form-control form-control-lg ml-2" name="recojoProducto" id="recojoProducto">        
                                          <option value="0" {{isset($producto) && $producto->recojo == "0" ? 'selected' : ''}}>No</option>
                                          <option value="1" {{isset($producto) && $producto->recojo == "1" ? 'selected' : ''}}>Si</option>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-4">
                                    <label for="txtPrecioProducto"><b>&nbsp;&nbsp;Pago contraEntrega:</b></label>
                                    <select class="form-control form-control-lg ml-2" name="contraentregaProducto" id="contraentregaProducto">        
                                          <option value="0" {{isset($producto) && $producto->contraentrega == "0" ? 'selected' : ''}}>No</option>
                                          <option value="1" {{isset($producto) && $producto->contraentrega == "1" ? 'selected' : ''}}>Si</option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-lg-7 col-md-12">
                                <label for="categoriaProducto"><b><span style="color:#AB0505;">(*)</span> Categoría:</b></label>
                                    <select class="form-control form-control-lg ml-2 selectpicker" name="categoriaProducto[]" id="categoriaProducto" multiple data-live-search="true">
                                        <option value="">--Seleccione--</option>
                                        @isset($categorias)
                                            @foreach ($categorias as $ct)
                                                <option value="{{$ct['categoria_id']}}" {{isset($producto_categorias) && in_array($ct['categoria_id'], $producto_categorias) ? 'selected' : ''}}>{{$ct['categoria']}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                
                                <div class="col-lg-5 col-md-12">
                                    <label for="etiquetasProducto"><b>Etiquetas:</b></label>
                                    <select class="form-control form-control-lg ml-2 selectpicker" name="etiquetasProducto[]" id="etiquetasProducto" multiple data-live-search="true">
                                        <option value="">--Seleccione--</option>

                                        @if(isset($tags) && count($tags)>0)
                                            @foreach ($tags as $tag)
                                  
                                                <option value="{{$tag->tag_id}}" {{isset($productos_etiquetas) && in_array($tag->tag_id, $productos_etiquetas) ? 'selected' : ''}}>{{$tag->tag}}</option>  

                                            @endforeach

                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="imgProducto"><b>&nbsp;&nbsp;Imagen Principal:</b></label>
                                    <input type="file" name="imgProducto" id="imgProducto" class="form-control">
                                    @if(isset($imgproductoprincipal))
                                        <input type="hidden" name="idImgProducto" id="idImgProducto" value="{{$imgproductoprincipal->producto__imagens_id}}">
                                    @endif
                                </div>
                               
                            </div>

                            <div  id="imgProducto_preview" class="form-group row">

                                @if(isset($imgproductoprincipal))
                                    <div class="img-div col-md-3 col-6" id="imgprincipal-div{{$imgproductoprincipal->producto__imagens_id}}">
                                        <img src="{{URL::asset($imgproductoprincipal->url)}}" class="img-fluid image img-thumbnail" title="{{$imgproductoprincipal->nombre}}">
                                        <div class="middle">
                                            <button type="button" id="imagen-action-icon" value="imgprincipal-div{{$imgproductoprincipal->producto__imagens_id}}" class="btn btn-danger" name="{{$imgproductoprincipal->nombre}}" temporal="0" producto_id='{{$imgproductoprincipal->producto_id}}' image_id='{{$imgproductoprincipal->producto__imagens_id}}'>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <a class="btn btn-info" download href="{{URL::asset($imgproductoprincipal->url)}}"><i class="fas fa-download"></i></a>
                                        </div>
                                        <input value="{{$imgproductoprincipal->nombre}}|*|{{$imgproductoprincipal->size}}|*|0" name="imgproducto" type="hidden">
                                    </div> 
                                @endif
                        
                            </div>
                    
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="images"><b>&nbsp;&nbsp;Galeria Producto:</b></label>
                                    <input type="file" name="imgGalerias[]" id="imgGalerias" multiple class="form-control">
                                </div>
                               
                            </div>

                            <div  id="imgGalerias_preview" class="form-group row">
                                @if(isset($imgproductogaleria)&&count($imgproductogaleria)>0)
                                    @foreach($imgproductogaleria as $files):
                                        <div class="img-div col-md-3 col-6" id="imggaleria-div{{$files->producto__imagens_id}}">
                                            <img src="{{URL::asset($files->url)}}" class="img-fluid image img-thumbnail" title="{{$files->nombre}}">
                                            <div class="middle">
                                                <button type="button" id="galeria-action-icon" value="imggaleria-div{{$files->producto__imagens_id}}" class="btn btn-danger" name="{{$files->nombre}}" temporal="0" producto_id='{{$files->producto_id}}' image_id='{{$files->producto__imagens_id}}'>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a class="btn btn-info" download href="{{URL::asset($files->url)}}"><i class="fas fa-download"></i></a>
                                            </div>
                                            <input value="{{$files->nombre}}|*|{{$files->size}}|*|0" name="imagenes[]" type="hidden">
                                        </div> 
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="chkEstadoProducto"><b>&nbsp;&nbsp;Estado:<b></label>
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input type="checkbox" class="custom-control-input" name="chkEstadoProducto" id="chkEstadoProducto" {{isset($producto) && $producto->estado == 1 ? 'checked':''}}>  
                                        <label class="custom-control-label" for="chkEstadoProducto">Activo</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="form-group">

                                <p class="help-block font-weight-bold"><span style="color:#AB0505;">Nota: (*) Campos Obligatorios</span></p> 
                                <a class="btn btn-danger btn-icon-split" href="{{ url('/admin/productos') }}"> <span class="icon text-white-50"><img src="{{ url('admin_assets/images/cancel.png') }}" width="24px"></span><span class="text">Cancelar</span></a>
                                <button type="submit" class="btn btn-dark btn-icon-split" id="guardarProducto"><span class="icon text-white-50"><img src="{{ url('admin_assets/images/save.png') }}" width="24px"></span><span class="text">Guardar</span></button> 
                                                    
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>   



    </div>

@endsection

@section('scripts')

<script src="{{ asset('admin_assets/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/Datetimepicker-bootstrap/build/js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/Datetimepicker-bootstrap/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/Datetimepicker-bootstrap/build/js/bootstrap-datepicker-es.js') }}"></script>

<script>

    CKEDITOR.replace( 'txtDescripcionProducto' );
    CKEDITOR.config.allowedContent = true;

    $('#example').datetimepicker({
    //opción locale para definir el idioma
    locale:'es',
    format: 'YYYY-MM-DD HH:mm:ss',
    icons:{
        time:'fas fa-clock',
        date:'fa fa-calendar',
        up:'fa fa-chevron-up',
        down:'fa fa-chevron-down',
        previous:'fa fa-chevron-left',
        next:'fa fa-chevron-right',
        today:'fa fa-crosshairs',
        clear:'fa fa-trash-o',
            close:'fa fa-times'
    },
    // Show the "Today" button in the icon toolbar
    showTodayButton:true,
    // Show the "Clear" button in the icon toolbar
    showClear:true,
    showClose:true,
    tooltips: {
        today:'Fecha Actual',
        clear:'Limpiar Selección',
        close:'Cerrar',
        selectTime:'Seleccionar Hora',
        selectDate:'Seleccionar Fecha',
        selectMonth:'Seleccionar Mes',
        selectDecade:'Seleccionar Década',
        selectYear:'Seleccionar Año',
        pickHour:'Seleccionar Hora',
        incrementHour:'Incrementar Hora',
        decrementHour:'Decrementar Hora',
        pickMinute:'Seleccionar Minuto',
        incrementMinute:'Incrementar Minuto',
        decrementMinute:'Decrementar Minuto',
        pickSecond:'Seleccionar Segundo',
        incrementSecond:'Incrementar Segundo',
        decrementSecond:'Decrementar Segundo',
    }
    });

    //comenzamos hacer un fileupload propio

    $('#imgProducto').change(function(){
        
        let img = $('input[name="imgProducto"]')[0].files;
        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/subirImagenTmp";
        let imgDataprincipal = new FormData();
        let id = generateString(3);
        imgDataprincipal.append("imagen",img[0]);
        imgDataprincipal.append("indice",1);
        $('#imgProducto_preview').html("");
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
                        let img_id = 'imgprincipal' + id;
                        previewtmpimage_col3(urlimage, 'imgProducto_preview',img_id, response.data.name, response.data.size, 'imgproducto', 'imagen-action', 'producto_id');
                        // $('#imgProducto_preview').append("<div class='img-div col-md-3 col-6' id='imgprincipal"+id+"'>" +
                        //         "<img src='"+urlimage+"' class='img-fluid image img-thumbnail' title='"+response.data.name+"'>"+
                        //         "<div class='middle'>"+
                        //         "<button type='button' id='imagen-action-icon' value='imgprincipal"+id+"' class='btn btn-danger' name='"+response.data.name+"' temporal='1' producto_id='' image_id=''>"+
                        //             "<i class='fa fa-trash'></i>"+
                        //         "</button>"+
                        //         "</div>"+
                        //         "<input value='"+response.data.name+"|*|"+response.data.size+"|*|1' name='imgproducto' type='hidden'>" +
                        //         "</div>");
                        document.getElementById('imgProducto').value="";
                    }
                    else  if(response.code == "422")
                    {
                        document.getElementById('imgProducto').value="";
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
                        document.getElementById('imgProducto').value="";

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                },
                error: function(response) {
                    document.getElementById('imgProducto').value="";
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
        });
    })


    $('#imgGalerias').change(function(){

        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/subirImagenTmp";
        let galeria = $('input[name="imgGalerias[]"]')[0].files;
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
                        let galeriaProducto_id = 'imgprincipal' + id;
                        previewtmpimage_col3(urlGaleriaProducto, 'imgGalerias_preview',galeriaProducto_id, response.data.name, response.data.size, 'imagenes[]', 'galeria-action', 'producto_id');
                        // $('#imgGalerias_preview').append("<div class='img-div col-md-3 col-6' id='img-div"+id+"'>" +
                        //         "<img src='"+url+"' class='img-fluid image img-thumbnail' title='"+response.data.name+"'>"+
                        //         "<div class='middle'>"+
                        //         "<button type='button' id='galeria-action-icon' value='img-div"+id+"' class='btn btn-danger' name='"+response.data.name+"' temporal='1' producto_id='' image_id=''>"+
                        //             "<i class='fa fa-trash'></i>"+
                        //         "</button>"+
                        //         "</div>"+
                        //         "<input value='"+response.data.name+"|*|"+response.data.size+"|*|1' name='imagenes[]' type='hidden'>" +
                        //         "</div>");
                        document.getElementById('imgGalerias').value="";
                    }
                    else  if(response.code == "422")
                    {
                        document.getElementById('imgGalerias').value="";
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
                        document.getElementById('imgGalerias').value="";
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                },
                error: function(response) {
                    document.getElementById('imgGalerias').value="";
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            })
        }
    });

    $('body').on('click', '#imagen-action-icon', function(evt){
        let divNameImg = this.value;
        let filenameImg = $(this).attr('name');
        let temporalImg = $(this).attr('temporal');
        let producto_id  = $(this).attr('producto_id');
        let image_id = $(this).attr('image_id');

        if(temporalImg == 1)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/eliminarImagenTmp";
            deleteTempImg(divNameImg, filenameImg, temporalImg, url);
        }
        else if(temporalImg == 0)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/eliminarImagen";
            // deleteimg(divNameImg, filenameImg, producto_id, image_id);
            deleteImgproducto(divNameImg, filenameImg, producto_id, image_id);
            $('#idImgProducto').val("");
        }
        
        evt.preventDefault();
    });


    $('body').on('click', '#galeria-action-icon', function(evt){
        
        let divNameGaleria = this.value;
        let filenameGaleria = $(this).attr('name');
        let temporalGaleria = $(this).attr('temporal');
        let producto_idG  = $(this).attr('producto_id');
        let image_idG = $(this).attr('image_id');
        if(temporalGaleria == 1)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/eliminarImagenTmp";
            deleteTempImg(divNameGaleria, filenameGaleria, temporalGaleria, url);
        }
        else if(temporalGaleria == 0)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/eliminarImagen";
            deleteimgGaleria(divNameGaleria, filenameGaleria, producto_idG, image_idG, url);
        }
        evt.preventDefault();
    });

    // function deleteimg(div,file, producto_id, img_id)
    // {
    //     let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/eliminarImagen";
    //     let formDataFi = new FormData();
    //     formDataFi.append("filename",file);
    //     formDataFi.append("producto_id",producto_id);
    //     formDataFi.append("img_id",img_id);
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

    // function deletetmp(div, file, temporal)
    // {
    //     let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/eliminarImagenTmp";
    //     let formDataimg = new FormData();
    //     formDataimg.append("filename",file);
    //     $.ajax({
    //             headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             url: url,
    //             type: "POST",
    //             data: formDataimg,
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

    window.activarDescuento = function()
    {
       if($('#checkdescuento').is(':checked') ) 
       {
            $('#descuentoProducto').prop('disabled',false);
            $('#example').prop('disabled',false);
       }
       else
       {
            $('#descuentoProducto').val(0);
            $('#descuentoProducto').prop('disabled',true);
            $('#example').val('');
            $('#example').prop('disabled',true);
       }
    }

    window.activarStock = function()
    {
        if($('#chkStock').is(':checked') ) 
        {
                $('#stockProducto').prop('disabled',false);
        }
        else
        {
                $('#stockProducto').val(0);
                $('#stockProducto').prop('disabled',true);
        }
    }


    $('#guardarProducto').click(function(event){
        event.preventDefault();
        let hddproducto_id = $('#hddproducto_id').val();
        if(hddproducto_id!="")
        {
            actualizarProducto(hddproducto_id);
        }
        else 
        {
            guardarProducto();
        }
    });

    window.guardarProducto = function(){

        $("#guardarProducto").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/admin/productos";
        let formData = new FormData($("#formProducto")[0]); 
        formData.append("descripcion_producto",CKEDITOR.instances['txtDescripcionProducto'].getData());
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
                $("#guardarProducto").prop('disabled', false);
                if(response.code == "200")
                {   
                        Swal.fire({
                        icon: 'success',
                        title: 'ÉXITO!',
                        text: 'Se ha registrado el Producto correctamente',
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
                $("#guardarProducto").prop('disabled', false);

                Swal.fire({
                    icon: 'error',
                    title: 'ERROR...',
                    text: 'Se ha producido un error al intentar guardar el registro!'
                })
            }
        });
    }

    window.actualizarProducto = function(producto_id)
    {  
        $("#guardarProducto").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/admin/productos/" + producto_id;
        let formDataEditar = new FormData($("#formProducto")[0]); 
        formDataEditar.append("descripcion_producto",CKEDITOR.instances['txtDescripcionProducto'].getData());
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
                $("#guardarProducto").prop('disabled', false);
                if(response.code == "200")
                {   
                        Swal.fire({
                        icon: 'success',
                        title: 'ÉXITO!',
                        text: 'Se ha actualizado el Producto correctamente',
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
                $("#guardarProducto").prop('disabled', false);

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