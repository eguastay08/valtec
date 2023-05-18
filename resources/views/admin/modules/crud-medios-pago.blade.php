@extends('admin.master')

@section('title', 'Mantemiento Medio Pago')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
            {{ isset($medio_pago) ? 'FORMULARIO DE ACTUALIZACIÓN DE MEDIO DE PAGO' : 'FORMULARIO DE REGISTRO DE MEDIO DE PAGO' }}
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/medios_pagos') }}" class="colorfont"> <i class="fas fa-hand-holding-usd"></i> Medios de Pago</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ isset($medio_pago) ? 'Actualización de Medio Pago':'Registro de Medio de Pago' }}</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-12 grid-margin stretch-card">

                <div class="card">

                    <form method="POST" action="{{ url('admin/medios_pagos') }}" id="formMedioPago">

                        @csrf

                        <div class="card-body">

                            <h3 class="card-title">Datos del Medio de Pago</h3>

                            
                            <div class="form-group row">
                                @php $mediopago_id_encrypt=''; @endphp
                                @if(isset($medio_pago))
                                    @php $mediopago_id_encrypt=Hashids::encode($medio_pago->medio_pago_id); @endphp
                                @endif
                                <div class="col-12">
                                    <input type="hidden" name="hddmediopago_id" id="hddmediopago_id" value="{{$mediopago_id_encrypt}}">
                                    <input type="hidden" name="hddusuario" id="hddusuario" value="{{Auth::user()->usuario}}">
                                    <label for="txtNombreMedio"><b><span style="color:#AB0505;">(*)</span> Medio de Pago:</b></label>
                                    <input type="text" class="form-control ml-2" id="txtNombreMedio"  name="txtNombreMedio" placeholder="Ingrese el nombre del Medio de Pago.." value="{{ isset($medio_pago) ? $medio_pago->nombre : '' }}">
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="txtDescripcionMedioPago"><b>&nbsp;&nbsp;Descripción del Medio de Pago:</b></label>
                                    <textarea class="form-control ml-2" name="txtDescripcionMedioPago" id="txtDescripcionMedioPago" cols="20" rows="7" placeholder="Ingrese la Descripción del Medio de Pago..">
                                        {{isset($medio_pago) ? $medio_pago->descripcion: ''}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-3 col-6">

                                    <label for="transferenciaRadio" class="col-12"><b>Transferencia:</b></label><br>
                                    <div class="d-flex">

                                        <div class="form-check ml-3">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input radio-inline" name="transferenciaRadio" id="transferenciaRadio1" value="0" {{isset($medio_pago) && $medio_pago->transferencia == 0 ? 'checked':'checked'}}>
                                            No
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input radio-inline" name="transferenciaRadio" id="transferenciaRadio2" value="1" {{isset($medio_pago) && $medio_pago->transferencia == 1 ? 'checked':''}}>
                                            Si
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-3 col-6">

                                    <label for="DepositoRadio" class="col-12"><b>Depósito:</b></label><br>
                                    <div class="d-flex">

                                        <div class="form-check ml-3">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input radio-inline" name="DepositoRadio" id="DepositoRadio1" value="0" {{isset($medio_pago) && $medio_pago->deposito == 0 ? 'checked':'checked'}}>
                                            No
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input radio-inline" name="DepositoRadio" id="DepositoRadio2" value="1" {{isset($medio_pago) && $medio_pago->deposito == 1 ? 'checked':''}}>
                                            Si
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-3 col-6">

                                    <label for="BilleteraDigitalRadio" class="col-12"><b>Biletera Digital:</b></label><br>
                                    <div class="d-flex">
                                        
                                        <div class="form-check ml-3">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input radio-inline" name="BilleteraDigitalRadio" id="BilleteraDigitalRadio1" value="0" {{isset($medio_pago) && $medio_pago->biletera_digital == 0 ? 'checked':'checked'}}>
                                            No
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input radio-inline" name="BilleteraDigitalRadio" id="BilleteraDigitalRadio2" value="1" {{isset($medio_pago) && $medio_pago->biletera_digital == 1 ? 'checked':''}}>
                                            Si
                                            </label>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3 col-6">

                                    <label for="PagoOnlineRadio" class="col-12"><b>Pago Online:</b></label><br>
                                    <div class="d-flex">

                                        <div class="form-check ml-3">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input radio-inline" name="PagoOnlineRadio" id="PagoOnlineRadio1" value="0" {{isset($medio_pago) && $medio_pago->pago_online == 0 ? 'checked':'checked'}}>
                                            No
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input radio-inline" name="PagoOnlineRadio" id="PagoOnlineRadio2" value="1" {{isset($medio_pago) && $medio_pago->pago_online == 1 ? 'checked':''}}>
                                            Si
                                            </label>
                                        </div>

                                    </div>

                                </div>


                            </div>
                            
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="chkEstadoMedioPago"><b>&nbsp;&nbsp;Estado:</b></label>
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input type="checkbox" class="custom-control-input" name="chkEstadoMedioPago" id="chkEstadoMedioPago" {{isset($medio_pago) && $medio_pago->estado == 1 ? 'checked':''}}>  
                                        <label class="custom-control-label" for="chkEstadoMedioPago">Activo</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="imgNoticia"><b>&nbsp;&nbsp;Imagen:</b></label>
                                    <input type="file" name="MedioPagoImg" id="MedioPagoImg" class="form-control">
                                    @isset($medio_pago)
                                        @if($medio_pago->imagen!='')
                                            <input type="hidden" name="MedioPagoImgName" id="MedioPagoImgName" value="{{$medio_pago->imagen}}">
                                        @endif
                                    @endisset
                                </div>
                            </div>
                            
                            <div  id="MedioPagoImg_preview" class="form-group row">

                                @isset($medio_pago)
                                    @if($medio_pago->imagen!='')
                                        <div class="img-div col-md-3 col-6" id="medioPagoImg{{$medio_pago->medio_pago_id}}">
                                            <img src="{{URL::asset($medio_pago->imagen)}}" class="img-fluid image img-thumbnail" title="{{$medio_pago->nombre}}">
                                            <div class="middle">
                                                <button type="button" id="removeMedioPago-icon" value="medioPagoImg{{$medio_pago->medio_pago_id}}" class="btn btn-danger" name="{{$medio_pago->imagen}}" temporal="0" mediopago_id='{{$medio_pago->medio_pago_id}}'>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a class="btn btn-info" download href="{{URL::asset($medio_pago->imagen)}}"><i class="fas fa-download"></i></a>
                                            </div>
                                            <input value="{{$medio_pago->nombre_img}}|*|{{$medio_pago->size_img}}|*|0" name="medioPagoImg" type="hidden">
                                        </div> 
                                    @endif
                                @endisset

                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="form-group">

                                <p class="help-block font-weight-bold"><span style="color:#AB0505;">Nota: (*) Campos Obligatorios</span></p> 
                                <a class="btn btn-danger btn-icon-split" href="{{ url('/admin/medios_pagos') }}"> <span class="icon text-white-50"><img src="{{ url('admin_assets/images/cancel.png') }}" width="24px"></span><span class="text">Cancelar</span></a>
                                <button type="submit" class="btn btn-dark btn-icon-split" id="btnGuardarMedioPago"><span class="icon text-white-50"><img src="{{ url('admin_assets/images/save.png') }}" width="24px"></span><span class="text">Guardar</span></button> 
                                                    
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

        CKEDITOR.replace('txtDescripcionMedioPago', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

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
            }

            evt.preventDefault();
        });

        $('#formMedioPago').submit(function(event){
            event.preventDefault();
            let hddMedio_Pago_id = $('#hddmediopago_id').val();
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
            let formData = new FormData($("#formMedioPago")[0]); 
            formData.append("txtDescripcionMedioPago",CKEDITOR.instances['txtDescripcionMedioPago'].getData());

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
                    $("#btnGuardarMedioPago").prop('disabled', false);
                    if(response.code == "200")
                    {   
                        Swal.fire({
                        icon: 'success',
                        title: 'ÉXITO!',
                        text: 'Se ha registrado el Medio de Pago correctamente',
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

        window.ActualizarMedioPago = function(mediopago_id)
        {
            $("#btnGuardarMedioPago").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/medios_pagos/" + mediopago_id;
            let formDataEditar = new FormData($("#formMedioPago")[0]); 
            formDataEditar.append("txtDescripcionMedioPago",CKEDITOR.instances['txtDescripcionMedioPago'].getData());
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
                    $("#btnGuardarMedioPago").prop('disabled', false);
                    if(response.code == "200")
                    {   
                            Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado el Medio de Pago correctamente',
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
                    $("#btnGuardarMedioPago").prop('disabled', false);

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