@extends('admin.master')

@section('title', 'Módulo de Medios de Pago')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE MEDIOS DE PAGO
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-hand-holding-usd"></i> Medios de Pago</li>
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
                    <label for="nombremediobuscar" style="font-size:14px;">Nombre:</label>
                    <input type="text" name="nombremediobuscar" id="nombremediobuscar" class="form-control form-control-sm" placeholder="Ingrese el Medio de Pago que desea buscar...">
                </div>
            </div>

            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoMedioPago" style="font-size:14px;">Estado:</label>
                    <select name="estadoMedioPago" id="estadoMedioPago" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            
        </div>

        @can('admin.medios_pago.crear')

        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 d-flex justify-content-end">

                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw" data-toggle="modal" data-target="#ModalMedioPago"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Medio de Pago</button>
                </div>

            </div>
        </div>
        @endcan

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-hand-holding-usd"></i>
                            Listado de Medios de Pago
                        </h4>
                        <section class="tbl_medio_pago">
                            @if(isset($mediospago) && count($mediospago) > 0)
                                
                                @include('admin.data.load_medios_pago_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Transferencia</th>
                                            <th>Billetera Digital</th>
                                            <th>Pago Online</th>
                                            <th>Depósito</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="10">No se encontraron registros</td>
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
                                    <td style="font-size:14px">Editar Medio de Pago</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Medio de Pago</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Medio de Pago</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Medio de Pago</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

    @can('admin.medios_pago.crear')
    <div class="modal fade" id="ModalMedioPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formMedioPago" name="formMedioPago">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalMedioPago" style="color:white !important">AGREGAR MEDIO DE PAGO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalMedioPago()">
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
                                            <label for="txtNombreMedio"><b>Nombre:</b></label>
                                            <input type="hidden" name="hddMedio_Pago_id" id="hddMedio_Pago_id" value="">
                                            <input type="text" class="form-control ml-2" id="txtNombreMedio"  name="txtNombreMedio" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Medio de Pago">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtDescripcionMedioPago"><b>Descripción:</b></label>
                                            <textarea class="form-control ml-2" name="txtDescripcionMedioPago" id="txtDescripcionMedioPago" cols="20" rows="3" placeholder="Ingrese la Descripción.."></textarea>
                                        </div>

                                        <div class="form-group row">

                                           <div class="col-md-6 col-12">

                                                <label for="transferenciaRadio" class="col-12"><b>Transferencia:</b></label><br>
                                                <div class="d-flex">

                                                    <div class="form-check ml-3">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input radio-inline" name="transferenciaRadio" id="transferenciaRadio1" value="0" checked>
                                                        No
                                                        </label>
                                                    </div>
                                                    <div class="form-check ml-3">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input radio-inline" name="transferenciaRadio" id="transferenciaRadio2" value="1">
                                                        Si
                                                        </label>
                                                    </div>

                                                </div>
                                           </div>

                                           <div class="col-md-6 col-12">

                                                <label for="DepositoRadio" class="col-12"><b>Depósito:</b></label><br>
                                                <div class="d-flex">

                                                    <div class="form-check ml-3">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input radio-inline" name="DepositoRadio" id="DepositoRadio1" value="0" checked>
                                                        No
                                                        </label>
                                                    </div>
                                                    <div class="form-check ml-3">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input radio-inline" name="DepositoRadio" id="DepositoRadio2" value="1">
                                                        Si
                                                        </label>
                                                    </div>

                                                </div>
                                           </div>

                                        </div>
                                        
                                        <div class="form-group row">

                                            <div class="col-md-6 col-12">

                                                <label for="BilleteraDigitalRadio" class="col-12"><b>Biletera Digital:</b></label><br>
                                                <div class="d-flex">
                                                    
                                                    <div class="form-check ml-3">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input radio-inline" name="BilleteraDigitalRadio" id="BilleteraDigitalRadio1" value="0" checked>
                                                        No
                                                        </label>
                                                    </div>
                                                    <div class="form-check ml-3">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input radio-inline" name="BilleteraDigitalRadio" id="BilleteraDigitalRadio2" value="1">
                                                        Si
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">

                                                <label for="PagoOnlineRadio" class="col-12"><b>Pago Online:</b></label><br>
                                                <div class="d-flex">

                                                    <div class="form-check ml-3">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input radio-inline" name="PagoOnlineRadio" id="PagoOnlineRadio1" value="0" checked>
                                                        No
                                                        </label>
                                                    </div>
                                                    <div class="form-check ml-3">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input radio-inline" name="PagoOnlineRadio" id="PagoOnlineRadio2" value="1">
                                                        Si
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="chkEstadoMedioPago"><b>Estado:</b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoMedioPago" id="chkEstadoMedioPago" checked>  
                                                <label class="custom-control-label" for="chkEstadoMedioPago">Activo</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="MedioPagoImg"><b>&nbsp;&nbsp;Imagen:</b></label>
                                            <input type="file" name="MedioPagoImg" id="MedioPagoImg" class="form-control">
                                            <input type="hidden" name="MedioPagoImgName" id="MedioPagoImgName">
                                        </div>

                                        <div  id="MedioPagoImg_preview" class="form-group row">
                                        </div>
                                
                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarMedioPago"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarMedioPago" data-dismiss="modal" onclick="limpiarModalMedioPago()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>
    @endcan

@endsection 


@section('scripts')

    <script src="{{ asset('admin_assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <!-- <script src="{{ asset('admin_assets/vendors/summernote/dist/summernote-bs4.min.js') }}"></script> -->
<!-- 
    <script src="{{ asset('admin_assets/vendors/tinymce_6/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/tinymce_6/js/tinymce/themes/silver/theme.min.js') }}"></script> -->
    <!-- <script src="../../vendors/summernote/dist/summernote-bs4.min.js"></script> -->

    <script>
        // tinymce.init({
        //         selector: 'textarea#txtDescripcionMedioPago',

        //     image_class_list: [
        //     {title: 'img-responsive', value: 'img-responsive'},
        //     ],
        //     height: 500,
        //     setup: function (editor) {
        //         editor.on('init change', function () {
        //             editor.save();
        //         });
        //     },
        //     plugins: [ 'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview','media' ],
        //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",

        //     image_title: true,
        //     automatic_uploads: true,
        //     images_upload_url: 'admin/tiny/upload',
        //     file_picker_types: 'image',
        //     file_picker_callback: function(cb, value, meta) {
        //         var input = document.createElement('input');
        //         input.setAttribute('type', 'file');
        //         input.setAttribute('accept', 'image/*');
        //         input.onchange = function() {
        //             var file = this.files[0];

        //             var reader = new FileReader();
        //             reader.readAsDataURL(file);
        //             reader.onload = function () {
        //                 var id = 'blobid' + (new Date()).getTime();
        //                 var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        //                 var base64 = reader.result.split(',')[1];
        //                 var blobInfo = blobCache.create(id, file, base64);
        //                 blobCache.add(blobInfo);
        //                 cb(blobInfo.blobUri(), { title: file.name });
        //             };
        //         };
        //         input.click();
        //     }
        // });

        // tinymce.init({
        //     selector: 'textarea#txtDescripcionMedioPago',
        //     plugins: [ 'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview','media' ],
        //     image_title:true,
        //     automatic_uploads: true,
        //     images_upload_url:'',
        //     file_picker_types:'image',
        //     file_picker_callback: function(cb, value, meta)
        //     {
        //         var input = document.createElement('input');
        //         input.setAttribute('type','file');
        //         input.setAttribute('accept','image/*');
        //         input.onchange = function(){
        //             var file = this.files[0];
        //             var reader = new FileReader();
        //             reader.readAsDataURL(file);
        //             reader.onload = function() {
        //                 var id = 'blobid' = (new Date()).getTime();
        //                 var blobCache = tinymce.activateEditor.editorUpload.blobCache;
        //                 var base64 = reader.result.split(',')[1];
        //                 var blobInfo = blobCache.create(id, file, base64);
        //                 blobCache.add(blobInfo);
        //                 cb(blobInfo.blobUri(), { title:file.name });
        //             };
        //         };

        //         input.click();
        //     }
        // });
        // $('#txtDescripcionMedioPago').summernote();
        // // CKEDITOR.replace( 'txtDescripcionMedioPago' );
        // CKEDITOR.config.allowedContent = true;

       /// ///////// CKEDITOR.replace( 'txtDescripcionMedioPago' );
        ////////////// CKEDITOR.config.allowedContent = true;

        // CKEDITOR.config.fillEmptyBlocks = false;
        // CKEDITOR.config.tabSpaces = 0;
        // // CKEDITOR.config.basicEntities = false;

        CKEDITOR.replace('txtDescripcionMedioPago', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });


        $(window).on('hashchange',function(){
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else{
                    loadmediospago(page);
                }
            }
        });

        $(document).on('click', '.tbl_medio_pago .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadmediospago(page);
        });

        function loadmediospago(page)
        {
            let url='';
            let mediopago = $('#nombremediobuscar').val();
            let estado = $('#estadoMedioPago').val(); 
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/medios_pagos?page="+page;

            $.ajax({
                url: url,
                method:'GET',
                data: {mediopago: mediopago, estado: estado}
            }).done(function (data) {
                $('.tbl_medio_pago').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }

        $('#nombremediobuscar').on('keyup', function(e){
            // console.log(this.value);
            let mediopago = this.value;
            let estado = $('#estadoMedioPago').val(); 
            ajaxMedioPago(mediopago,estado);
        })

        
        $('#estadoMedioPago').on('change', function (e ){
            let mediopago = $('#nombremediobuscar').val();
            let estado = this.value;
            ajaxMedioPago(mediopago,estado);
        });

        function ajaxMedioPago(mediopago,estado)
        {
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/medios_pagos";

            $.ajax({
                url: url,
                method:'GET',
                data: {mediopago: mediopago, estado: estado}
            }).done(function (data) {
                $('.tbl_medio_pago').html(data);
                // console.log(data);
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }
   
        //imagen Medio de Pago
        $('#MedioPagoImg').change(function(){
            let medioPago = $('input[name="MedioPagoImg"]')[0].files;
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/medios_pagos/subirImagenTmp";
            let mediopagoData = new FormData();
            let medioPago_id = generateString(3);
            mediopagoData.append("imagen",medioPago[0]);
            mediopagoData.append("indice",1);
            $('#MedioPagoImg_preview').html("");
            $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: mediopagoData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        if(response.code==200)
                        {
                            let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                            let urlImgMedioPago = urlraiz + response.data.url;
                            let medio_pago_img_id = 'medioPagoImg' + medioPago_id;
                            previewtmpimage_col12(urlImgMedioPago, 'MedioPagoImg_preview',medio_pago_img_id, response.data.name, response.data.size, 'medioPagoImg', 'removeMedioPago', 'medioPago_id');
                            document.getElementById('MedioPagoImg').value="";
                        }
                        else  if(response.code == "422")
                        {
                            document.getElementById('MedioPagoImg').value="";
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
                            document.getElementById('MedioPagoImg').value="";

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar actualizar el registro!'
                            })
                        }
                    },
                    error: function(response) {
                        document.getElementById('MedioPagoImg').value="";
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
            });
        });

        $('body').on('click', '#removeMedioPago-icon', function(evt){
        
            let divNameImg = this.value;
            let filenameImg = $(this).attr('name');
            let temporalImg = $(this).attr('temporal');
            let medio_pago_id  = $(this).attr('medioPago_id');


            if(temporalImg == 1)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/medios_pagos/eliminarImagenTmp";
                deleteTempImg(divNameImg, filenameImg, temporalImg, url);
            }
            else if(temporalImg == 0)
            {
            
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/medios_pagos/eliminarimg";
                deleteImg(divNameImg, filenameImg, medio_pago_id, temporalImg, url);
                $('#MedioPagoImgName').val("");
                loadmediospago();
            }

            evt.preventDefault();
        });

        function limpiarModalMedioPago()
        {
            $('#tituloModalMedioPago').html('AGREGAR MEDIO DE PAGO');
            $('#hddMedio_Pago_id').val("");
            $('#txtNombreMedio').val("");
            $('#txtDescripcionMedioPago').val("");
            $('#transferenciaRadio1').prop('checked',true);
            $('#DepositoRadio1').prop('checked',true);
            $('#BilleteraDigitalRadio1').prop('checked',true);
            $('#PagoOnlineRadio1').prop('checked',true);
            $('#chkEstadoMedioPago').prop('checked', true);
            $('#MedioPagoImg_preview').html("");
            $('#MedioPagoImgName').val("");
            $('#MedioPagoImg').val("");
        }

        $('#formMedioPago').submit(function(event){
            event.preventDefault();
            let hddMedio_Pago_id = $('#hddMedio_Pago_id').val();
            if(hddMedio_Pago_id!="")
            {
                ActualizarMedioPago(hddMedio_Pago_id);
            }
            else 
            {
                GuardarMedioPago();
            }
        });

        window.GuardarMedioPago = function()
        {
            $("#btnGuardarMedioPago").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin" + "/medios_pagos";
            let data = {
                medio_pago: $("#txtNombreMedio").val(),
                descripcion:  CKEDITOR.instances['txtDescripcionMedioPago'].getData(),
                transferencia: $("input[name=transferenciaRadio]:checked").val(),
                deposito: $("input[name=DepositoRadio]:checked").val(),
                billetera_digital: $("input[name=BilleteraDigitalRadio]:checked").val(),
                pago_online: $("input[name=PagoOnlineRadio]:checked").val(),
                estado: $("#chkEstadoMedioPago").prop('checked'),
                medioPagoImg: $("#medioPagoImg").val(),
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
                    $("#btnGuardarMedioPago").prop('disabled', false);
                    if(response.code == "200")
                    {
                            
                            $("#ModalMedioPago").modal('hide');
                            limpiarModalMedioPago();
                            loadmediospago();

                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha registrado el Medio de Pago correctamente'
                            });
                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let medioPagoValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    medioPagoValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                    medioPagoValidation  + 
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

        window.mostrarMedioPago = function(medio_pago_id)
        {
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/medios_pagos/" +medio_pago_id;
            $("#ModalMedioPago").modal('show');
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                $('#tituloModalMedioPago').html('EDITAR MEDIO DE PAGO');
                $('#hddMedio_Pago_id').val(medio_pago_id);
                $('#txtNombreMedio').val(data.nombre);
                CKEDITOR.instances['txtDescripcionMedioPago'].setData(data.descripcion);
                // $('#txtDescripcionMedioPago').val(data.descripcion);

                if(data.transferencia=="0")
                {
                    $('#transferenciaRadio1').prop('checked', true);
                }
                else if(data.transferencia=="1")
                {
                    $('#transferenciaRadio2').prop('checked', true);
                }

                if(data.deposito=="0")
                {
                    $('#DepositoRadio1').prop('checked', true);
                }
                else if(data.deposito=="1")
                {
                    $('#DepositoRadio2').prop('checked', true);
                }

                if(data.billetera_digital=="0")
                {
                    $('#BilleteraDigitalRadio1').prop('checked', true);
                }
                else if(data.billetera_digital=="1")
                {
                    $('#BilleteraDigitalRadio2').prop('checked', true);
                }

                if(data.pago_online=="0")
                {
                    $('#PagoOnlineRadio1').prop('checked', true);
                }
                else if(data.pago_online=="1")
                {
                    $('#PagoOnlineRadio2').prop('checked', true);
                }

                if(data.estado == "1")
                {
                    $('#chkEstadoMedioPago').prop('checked', true)
                }
                else 
                {
                    $('#chkEstadoMedioPago').prop('checked', false)
                }

                if(data.imagen!="")
                {
                   $('#MedioPagoImgName').val(data.nombre_img);
                   loadimage(data.imagen,'MedioPagoImg_preview','medioPagoImg','removeMedioPago',data.nombre_img, medio_pago_id, data.size_img,'medioPago_id',0);
                }

            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }
        
        window.ActualizarMedioPago = function(medio_pago_id)
        {
            $("#btnGuardarMedioPago").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/medios_pagos/" + medio_pago_id;
            let data = {
                medio_pago_id: medio_pago_id,
                medio_pago: $("#txtNombreMedio").val(),
                descripcion: CKEDITOR.instances['txtDescripcionMedioPago'].getData(), 
                transferencia: $("input[name=transferenciaRadio]:checked").val(),
                deposito: $("input[name=DepositoRadio]:checked").val(),
                billetera_digital: $("input[name=BilleteraDigitalRadio]:checked").val(),
                pago_online: $("input[name=PagoOnlineRadio]:checked").val(),
                estado: $("#chkEstadoMedioPago").prop('checked'),
                medioPagoImg: $("#medioPagoImg").val(),
                medioPagoImgActual:$('#MedioPagoImgName').val(),
                usuario:<?php echo '"'.Auth::user()->usuario.'"'; ?>
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
                    $("#btnGuardarMedioPago").prop('disabled', false);
                    if(response.code == "200")
                    {
                        $("#ModalMedioPago").modal('hide');
                        limpiarModalMedioPago();
                        loadmediospago();

                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado el Medio de Pago correctamente'
                        });
                    }
                    else if(response.code == "422")
                    {
                        let errors = response.errors;
                        let mediopagoValidation = '';

                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                mediopagoValidation += '<li>' + value + '</li>';
                            }

                        }); 

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            html: '<ul>'+
                                mediopagoValidation  + 
                                    '</ul>'
                        });
                    }
                    else 
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                },
                error: function(response) {
                    $("#btnGuardarMedioPago").prop('disabled', false);

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            });
        }

        window.eliminarMedioPago = function(medio_pago_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de eliminar el Medio Pago?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Eliminar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/medios_pagos/"  + medio_pago_id;
                        let data = {
                            medio_pago_id: medio_pago_id,
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
                                    loadmediospago();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha eliminado el Medio Pago correctamente'
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

        window.desactivarMedioPago = function(medio_pago_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de desactivar el Medio de Pago?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Desactivar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/medios_pagos" +  "/desactivar/" + medio_pago_id;
                            let data = {
                                medio_pago_id: medio_pago_id,
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
                                        loadmediospago();
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha desactivado el Medio de Pago correctamente'
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

        window.activarMedioPago = function(medio_pago_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de activar el Medio de Pago?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Activar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/medios_pagos" +  "/activar/" + medio_pago_id;
                            let data = {
                                medio_pago_id: medio_pago_id,
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
                                        loadmediospago();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha activado el Medio de Pago correctamente'
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