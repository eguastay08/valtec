@extends('admin.master')

@section('title', 'Módulo de Preguntas Frecuentes')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE PREGUNTAS FRECUENTES
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> <i class="far fa-question-circle"></i> Preguntas Frecuentes</li>
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
                    <label for="estadoPreguntaFrecuenteBuscar" style="font-size:14px;">Estado:</label>
                    <select name="estadoPreguntaFrecuenteBuscar" id="estadoPreguntaFrecuenteBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            @can('admin.preguntas.crear')
            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw btn-mt" data-toggle="modal" data-target="#ModalPreguntaFrecuente"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Pregunta Frecuente</button>
                </div>
            </div>
            @endcan

        </div>

        <div class="row">

            <div class="col-12 grid-margin">

                <div class="card">
                    
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="far fa-question-circle"></i>
                            Listado de Preguntas Frecuentes
                        </h4>
                        <section class="tbl-preguntas_frecuentes">
                            @if(isset($preguntas_frecuentes) && count($preguntas_frecuentes) > 0)
                                
                                @include('admin.data.load_preguntas_frecuentes_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pregunta</th>
                                            <th>Respuesta</th>          
                                            <th>Estado</th>
                                            <th>Posición</th>
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
                                    <td style="font-size:14px">Editar Pregunta Frecuente</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Pregunta Frecuente</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Pregunta Frecuente</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Pregunta Frecuente</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
            </div>
        </div>

    </div>

    @can('admin.preguntas.crear')
    <!-- Modal Agregar -->
    <div class="modal fade" id="ModalPreguntaFrecuente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formPreguntaFrecuente" name="formPreguntaFrecuente" enctype="multipart/form-data"> 

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloPreguntaFrecuente" style="color:white !important">AGREGAR PREGUNTA FRECUENTE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarPreguntaFrecuente()">
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
                                            <label for="txtPregunta"><b>Pregunta:</b></label>
                                            <input type="hidden" name="hddPregunta_id" id="hddPregunta_id" value="">
                                            <input type="text" class="form-control ml-2" id="txtPregunta"  name="txtPregunta" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Titulo">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtRespuestaPregunta"><b>Respuesta:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtRespuestaPregunta"  name="txtRespuestaPregunta" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Link">
                                        </div>

                
                                        <div class="form-group" id="posicionpreguntafrecuenteDV" hidden="hidden">
                                            <label for="posicionPregunta"><b>Posición:</b></label>
                                            <input type="number" name="posicionPregunta" id="posicionPregunta" class="form-control" min="0">
                                            <input type="hidden" name="hdd_posicionPregunta_actual" id="hdd_posicionPregunta_actual">
                                        </div>


                                        <div class="form-group">
                                            <label for="chkEstadoPreguntaFrecuente"><b>Estado:<b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoPreguntaFrecuente" id="chkEstadoPreguntaFrecuente" checked>  
                                                <label class="custom-control-label" for="chkEstadoPreguntaFrecuente">Activo</label>
                                            </div>
                                        </div>

                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarPreguntaFrecuente"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarPreguntaFrecuente" data-dismiss="modal" onclick="limpiarPreguntaFrecuente()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>
    @endcan

@endsection

@section('scripts')

<script src="{{ asset('admin_assets/vendors/ckeditor/ckeditor.js') }}"></script>

<script>

    CKEDITOR.replace( 'txtRespuestaPregunta');
    CKEDITOR.config.allowedContent = true;

    $(window).on('hashchange',function(){
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else{
                loadPreguntasFrecuentes(page);
            }
        }
    });

    $(document).on('click', '.tbl-preguntas_frecuentes .pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadPreguntasFrecuentes(page);
    });

    function loadPreguntasFrecuentes(page)
    {
        let url='';
        let estado = $('#estadoPreguntaFrecuenteBuscar').val(); 
        url=$('meta[name=app-url]').attr("content")  + "/admin" + "/preguntas_frecuentes?page="+page;

        $.ajax({
            url: url,
            method:'GET',
            data: {estado: estado}
        }).done(function (data) {
            $('.tbl-preguntas_frecuentes').html(data);
        }).fail(function () {
            console.log("Failed to load data!");
        });
    }

    $('#estadoPreguntaFrecuenteBuscar').on('change', function (e ){
        let estadopregunta = this.value;
        ajaxPregunta(estadopregunta);
    });

    
    function ajaxPregunta(estado)
    {
        url=$('meta[name=app-url]').attr("content") + "/admin" + "/preguntas_frecuentes";

        $.ajax({
            url: url,
            method:'GET',
            data: {estado: estado}
        }).done(function (data) {
            $('.tbl-preguntas_frecuentes').html(data);
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    }

    $('#formPreguntaFrecuente').submit(function(event){
        event.preventDefault();
        let hddPregunta_id = $('#hddPregunta_id').val();
        if(hddPregunta_id!="")
        {
            ActualizarPreguntaFrecuente(hddPregunta_id);
        }
        else 
        {
            GuardarPreguntaFrecuente();
        }
    });

    function limpiarPreguntaFrecuente()
    {
        $('#tituloPreguntaFrecuente').html('AGREGAR PREGUNTA FRECUENTE');
        $('#hddPregunta_id').val("");
        $('#txtPregunta').val("");
        CKEDITOR.instances['txtRespuestaPregunta'].setData('')
        // $('#txtRespuestaPregunta').val("");
        $('#posicionPregunta').val("");
        $('#hdd_posicionPregunta_actual').val("");
        $('#posicionpreguntafrecuenteDV').attr('hidden', 'hidden');
        $('#chkEstadoPreguntaFrecuente').prop('checked', true);
    }

    window.GuardarPreguntaFrecuente = function()
    {
        $("#btnGuardarPreguntaFrecuente").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/admin" + "/preguntas_frecuentes";
        let data = {
            pregunta: $("#txtPregunta").val(),
            respuesta: CKEDITOR.instances['txtRespuestaPregunta'].getData(),
            estado: $("#chkEstadoPreguntaFrecuente").prop('checked'),
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: data,
            success: function(response) {
                $("#btnGuardarPreguntaFrecuente").prop('disabled', false);
                if(response.code == "200")
                {
                    loadPreguntasFrecuentes();
                    $("#ModalPreguntaFrecuente").modal('hide');
                    limpiarPreguntaFrecuente();

                    Swal.fire({
                        icon: 'success',
                        title: 'ÉXITO!',
                        text: 'Se ha registrado la Pregunta Frecuente correctamente'
                    });
                }
                else  if(response.code == "422")
                {
                        let errors = response.errors;
                        let preguntaFrecuenteValidation = '';

                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                preguntaFrecuenteValidation += '<li>' + value + '</li>';
                            }

                        }); 

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            html: '<ul>'+
                            preguntaFrecuenteValidation  + 
                                    '</ul>'
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

    window.mostrarPreguntaFrecuente = function(pregunta_frecuente_id)
    {
        url=$('meta[name=app-url]').attr("content") + "/admin" + "/preguntas_frecuentes/" +pregunta_frecuente_id;
        $("#ModalPreguntaFrecuente").modal('show');
        $.ajax({
            url: url,
            method:'GET'
        }).done(function (data) {
            $('#tituloPreguntaFrecuente').html('EDITAR PREGUNTA FRECUENTE');
            $('#hddPregunta_id').val(pregunta_frecuente_id);
            $('#txtPregunta').val(data.pregunta);
            CKEDITOR.instances['txtRespuestaPregunta'].setData(data.respuesta);
            $('#posicionpreguntafrecuenteDV').removeAttr('hidden');
            $('#posicionPregunta').val(data.posicion);
            $('#hdd_posicionPregunta_actual').val(data.posicion);
            
            if(data.estado == "1")
            {
                $('#chkEstadoPreguntaFrecuente').prop('checked', true)
            }
            else 
            {
                $('#chkEstadoPreguntaFrecuente').prop('checked', false)
            }
           
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    }

    window.ActualizarPreguntaFrecuente = function(pregunta_frecuente_id)
    {
        $("#btnGuardarPreguntaFrecuente").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/admin" + "/preguntas_frecuentes/"+pregunta_frecuente_id;
        let data = {
            pregunta: $("#txtPregunta").val(),
            respuesta: CKEDITOR.instances['txtRespuestaPregunta'].getData(),
            posicion: $('#posicionPregunta').val(),
            posicion_actual: $('#hdd_posicionPregunta_actual').val(),
            estado: $("#chkEstadoPreguntaFrecuente").prop('checked'),
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "PUT",
            data: data,
            success: function(response) {
                $("#btnGuardarPreguntaFrecuente").prop('disabled', false);
                if(response.code == "200")
                {
                    loadPreguntasFrecuentes();
                    $("#ModalPreguntaFrecuente").modal('hide');
                    limpiarPreguntaFrecuente();

                    Swal.fire({
                        icon: 'success',
                        title: 'ÉXITO!',
                        text: 'Se ha actualizado la Pregunta Frecuente correctamente'
                    });
                }
                else  if(response.code == "422")
                {
                        let errors = response.errors;
                        let preguntaFrecuenteValidation = '';

                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                preguntaFrecuenteValidation += '<li>' + value + '</li>';
                            }

                        }); 

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            html: '<ul>'+
                            preguntaFrecuenteValidation  + 
                                    '</ul>'
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

    window.eliminarPreguntaFrecuente = function(pregunta_frecuente_id)
    {
        Swal.fire({
            icon: 'warning',
            title: 'Está seguro de eliminar la Pregunta Frecuente?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonColor: "#EB1010",
            confirmButtonText: `Eliminar`,
            cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/preguntas_frecuentes/"  + pregunta_frecuente_id;
                    let data = {
                        pregunta_frecuente_id: pregunta_frecuente_id
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
                                loadPreguntasFrecuentes();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha eliminado la pregunta correctamente'
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

    window.desactivarPreguntaFrecuente = function(pregunta_frecuente_id)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está seguro de desactivar la Pregunta?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Desactivar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/preguntas_frecuentes" +  "/desactivar/" + pregunta_frecuente_id;
                        let data = {
                            pregunta_frecuente_id: pregunta_frecuente_id
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
                                    loadPreguntasFrecuentes();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha desactivado la pregunta correctamente'
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

    window.activarPreguntaFrecuente = function(pregunta_frecuente_id)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está seguro de activar la Pregunta?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/preguntas_frecuentes" +  "/activar/" + pregunta_frecuente_id;
                        let data = {
                            pregunta_frecuente_id: pregunta_frecuente_id
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
                                    loadPreguntasFrecuentes();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha activado la Pregunta correctamente'
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