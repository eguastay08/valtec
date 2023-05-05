@extends('admin.master')

@section('title', 'Módulo de Monedas')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE MONEDAS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-coins"></i> Monedas</li>
                    </ol>
                </nav>
            </div>

        </div>

        @can('admin.moneda.crear')

        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 d-flex justify-content-end">

                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw" data-toggle="modal" data-target="#ModalMoneda"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Moneda</button>
                </div>

            </div>
        </div>
        @endcan

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-coins"></i>
                            Listado de Monedas
                        </h4>
                        <section class="tbl_monedas">
                            @if(isset($monedas) && count($monedas) > 0)
                                
                                @include('admin.data.load_monedas_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Código</th>
                                                <th>Prefijo</th>
                                                <th>Sufijo</th>
                                                <th>Tipo de cambio</th>
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
                                    <td style="font-size:14px">Editar Moneda</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Moneda</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Moneda</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Moneda</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

    @can('admin.medios_pago.crear')
    <div class="modal fade" id="ModalMoneda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formMoneda" name="formMoneda">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalMoneda" style="color:white !important">AGREGAR MONEDA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalMoneda()">
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
                                            <label for="txtNombreMoneda"><b>Nombre:</b></label>
                                            <input type="hidden" name="hddmoneda_id" id="hddmoneda_id" value="">
                                            <input type="text" class="form-control ml-2" id="txtNombreMoneda"  name="txtNombreMoneda" aria-describedby="emailHelp"
                                                placeholder="Ingrese el nombre de la Moneda">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtCodigoMoneda"><b>Código:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtCodigoMoneda"  name="txtCodigoMoneda" aria-describedby="emailHelp"
                                                placeholder="Ingrese el código de la Moneda">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtTipoCambioMoneda"><b>Tipo de Cambio:</b></label>
                                            <input type="number" class="form-control ml-2" id="txtTipoCambioMoneda"  name="txtTipoCambioMoneda"
                                                placeholder="Ingrese el Tipo de Cambio de la Moneda"  min="0" step="0.01">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtPrefijoMoneda"><b>Prefijo:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtPrefijoMoneda"  name="txtPrefijoMoneda" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Prefijo de la Moneda">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtSufijoMoneda"><b>Sufijo:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtSufijoMoneda"  name="txtSufijoMoneda" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Sufijo de la Moneda">
                                        </div>
                                     
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarMoneda"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarMoneda" data-dismiss="modal" onclick="limpiarModalMoneda()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
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
                    loadMonedas(page);
                }
            }
        });

        $(document).on('click', '.tbl_monedas .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadMonedas(page);
        });

        function loadMonedas(page)
        {
            let url='';
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/monedas?page="+page;

            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                $('.tbl_monedas').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }

        function limpiarModalMoneda()
        {
            $('#tituloModalMoneda').html('AGREGAR MONEDA');
            $('#hddmoneda_id').val("");
            $('#txtNombreMoneda').val("");
            $('#txtCodigoMoneda').val("");
            $('#txtPrefijoMoneda').val("");
            $('#txtSufijoMoneda').val("");   
            $('#txtTipoCambioMoneda').val("");    
        }

        $('#formMoneda').submit(function(event){
            event.preventDefault();
            let hddmoneda_id = $('#hddmoneda_id').val();
            if(hddmoneda_id!="")
            {
                ActualizarMoneda(hddmoneda_id);
            }
            else 
            {
                GuardarMoneda();
            }
        });

        window.GuardarMoneda = function()
        {
            $("#btnGuardarMoneda").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin" + "/monedas";
            let data = {
                nombre: $("#txtNombreMoneda").val(),
                codigo: $("#txtCodigoMoneda").val(),
                tipo_cambio:$('#txtTipoCambioMoneda').val(),
                prefijo: $('#txtPrefijoMoneda').val(),           
                sufijo: $("#txtSufijoMoneda").val(),
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
                    $("#btnGuardarMoneda").prop('disabled', false);
                    if(response.code == "200")
                    {
                            
                            $("#ModalMoneda").modal('hide');
                            limpiarModalMoneda();
                            loadMonedas();

                            Swal.fire({
                                icon: 'success',
                                title: 'ÉXITO!',
                                text: 'Se ha registrado la Moneda correctamente'
                            });
                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let monedaValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    monedaValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                    monedaValidation  + 
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

        window.mostrarMoneda = function(moneda_id)
        {
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/monedas/" +moneda_id;
            $("#ModalMoneda").modal('show');
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                $('#tituloModalMoneda').html('EDITAR MONEDA');
                $('#hddmoneda_id').val(moneda_id);
                $('#txtNombreMoneda').val(data.nombre);
                $('#txtCodigoMoneda').val(data.codigo);
                $('#txtTipoCambioMoneda').val(data.tipo_cambio);
                $('#txtPrefijoMoneda').val(data.prefijo);
                $('#txtSufijoMoneda').val(data.sufijo);

            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }
        
        window.ActualizarMoneda = function(moneda_id)
        {
            $("#btnGuardarMoneda").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/monedas/" + moneda_id;
            let data = {
                moneda_id: moneda_id,
                nombre: $("#txtNombreMoneda").val(),
                codigo: $("#txtCodigoMoneda").val(),   
                tipo_cambio:$('#txtTipoCambioMoneda').val(),
                prefijo: $('#txtPrefijoMoneda').val(),           
                sufijo: $("#txtSufijoMoneda").val(),
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
                    $("#btnGuardarMoneda").prop('disabled', false);
                    if(response.code == "200")
                    {
                        $("#ModalMoneda").modal('hide');
                        limpiarModalMoneda();
                        loadMonedas();

                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado la Moneda correctamente'
                        });
                    }
                    else if(response.code == "422")
                    {
                        let errors = response.errors;
                        let monedaValidation = '';

                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                monedaValidation += '<li>' + value + '</li>';
                            }

                        }); 

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            html: '<ul>'+
                                monedaValidation  + 
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
                    $("#btnGuardarMoneda").prop('disabled', false);

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            });
        }

        window.eliminarMoneda = function(moneda_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de eliminar la Moneda?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Eliminar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/monedas/"  + moneda_id;
                        let data = {
                            moneda_id: moneda_id
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
                                    loadMonedas();

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

        window.desactivarMoneda = function(moneda_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de desactivar la Moneda?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Desactivar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/monedas" +  "/desactivar/" + moneda_id;
                            let data = {
                                moneda_id: moneda_id
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
                                        loadMonedas();
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha desactivado la Moneda correctamente'
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

        window.activarMoneda = function(moneda_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de activar la Moneda?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Activar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/monedas" +  "/activar/" + moneda_id;
                            let data = {
                                moneda_id: moneda_id
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
                                        loadMonedas();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha activado la Moneda correctamente'
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