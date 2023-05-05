@extends('admin.master')

@section('title', 'Módulo de Descuentos')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE DESCUENTOS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-percent"></i> Descuentos</li>
                    </ol>
                </nav>
            </div>

        </div>
        
        @can('admin.descuentos.crear')
        <div class="row">

            <div class="col-12">
                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw btn-mt" data-toggle="modal" data-target="#ModalDescuento"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Descuento</button>
                </div>
            </div>

        </div>
        @endcan
        
        <div class="row">

            <div class="col-12 grid-margin">

                <div class="card">
                    
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-percent"></i>
                            Listado de Descuentos
                        </h4>
                        <section class="tbl-descuentos">
                            
                            @if(isset($descuentos) && count($descuentos) > 0)
                                
                                @include('admin.data.load_descuentos_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cupón</th>
                                            <th>Porcentaje</th>          
                                            <th>N° de Productos</th>
                                            <th>Uso</th>                           
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
                                    <td style="font-size:14px">Editar Descuento</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Descuento</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Descuento</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Descuento</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>


    </div>

    @can('admin.descuentos.crear')
    <div class="modal fade" id="ModalDescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formDescuento" name="formDescuento" enctype="multipart/form-data"> 

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalDescuento" style="color:white !important">AGREGAR DESCUENTO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalDescuento()">
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
                                            <label for="txtcupon"><b>Cupón:</b></label>
                                            <input type="hidden" name="hdddescuento_id" id="hdddescuento_id" value="">
                                            <input type="hidden" name="hdd_usuario" name="hdd_usuario" value="{{Auth::user()->usuario}}">
                                            <input type="text" class="form-control ml-2" id="txtcupon"  name="txtcupon" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Cupón">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtporcentajes"><b>Porcentaje:</b></label>
                                            <input type="number" class="form-control ml-2" id="txtporcentajes" min="0"  name="txtporcentajes" aria-describedby="emailHelp"
                                                placeholder="Ingrese el porcentaje">
                                        </div>

                                        <div class="form-group">
                                            <label for="cboUsoDescuento"><b>Uso:</b></label>
                                            <select name="cboUsoDescuento" id="cboUsoDescuento"  class="form-control ml-2 selectpicker">
                                                <option value="">-Seleccione-</option>
                                                <option value="1">Ilimitado</option>
                                                <option value="2">Solo una Vez</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="nroProductos"><b>N° de Productos:</b></label>
                                            <input type="number" name="nroProductos" id="nroProductos" class="form-control" min="0">
                                        </div>


                                        <div class="form-group">
                                            <label for="chkEstadoDescuento"><b>Estado:</b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoDescuento" id="chkEstadoDescuento" checked>  
                                                <label class="custom-control-label" for="chkEstadoDescuento">Activo</label>
                                            </div>
                                        </div>

                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarDescuento"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarDescuento" data-dismiss="modal" onclick="limpiarModalDescuento()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>
    @endcan


@endsection

@section('scripts')

    <script>

        @can('admin.descuentos.index')
        $(window).on('hashchange',function(){
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else{
                    loadDescuentos(page);
                }
            }
        });

        $(document).on('click', '.tbl-descuentos .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadDescuentos(page);
        });

        function loadDescuentos(page)
        {
            let url='';
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/descuentos?page="+page;

            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                $('.tbl-descuentos').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }
        @endcan
        
        function limpiarModalDescuento()
        {
            $('#tituloModalDescuento').html('AGREGAR BANNER');
            $('#hdddescuento_id').val("");
            $('#txtcupon').val("");
            $('#txtporcentajes').val("");
            $('#cboUsoDescuento').val("");
            $('#cboUsoDescuento').selectpicker("refresh");
            $('#nroProductos').val("");
            $('#chkEstadoDescuento').prop('checked', true);
        }

        $('#formDescuento').submit(function(event){
            event.preventDefault();
            let hdddescuento_id = $('#hdddescuento_id').val();
            if(hdddescuento_id!="")
            {
                ActualizarDescuento(hdddescuento_id);
            }
            else 
            {
                GuardarDescuento();
            }
        });

        @can('admin.descuentos.crear')
        window.GuardarDescuento = function()
        {
            $("#btnGuardarDescuento").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin" + "/descuentos";
            let data = $('#formDescuento').serialize();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#btnGuardarDescuento").prop('disabled', false);
                    if(response.code == "200")
                    {
                        loadDescuentos();
                        $("#ModalDescuento").modal('hide');
                        limpiarModalDescuento();

                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha registrado el Descuento correctamente'
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
        @endcan

        @can('admin.descuentos.actualizar')
        window.mostrarDescuento = function(descuento_id)
        {
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/descuentos/" +descuento_id;
            $("#ModalDescuento").modal('show');
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                $('#tituloModalDescuento').html('EDITAR DESCUENTO');
                $('#hdddescuento_id').val(descuento_id);
                $('#txtcupon').val(data.cupon);
                $('#txtporcentajes').val(data.porcentaje);
                $('#cboUsoDescuento').val(data.uso);
                $('#cboUsoDescuento').selectpicker("refresh");
                $('#nroProductos').val(data.nro_productos);

            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }
        
        window.ActualizarDescuento = function(hdddescuento_id)
        {
            $("#btnGuardarDescuento").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/descuentos/" + hdddescuento_id;
            let data = $('#formDescuento').serialize();
            // console.log(data);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#btnGuardarDescuento").prop('disabled', false);
                    if(response.code == "200")
                    {
                        loadDescuentos();
                        $("#ModalDescuento").modal('hide');
                        limpiarModalDescuento();

                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado el cupón correctamente'
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
                    $("#btnGuardarDescuento").prop('disabled', false);

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            });
        }
        @endcan

        @can('admin.descuentos.eliminar')
        window.eliminarDescuento = function(hdddescuento_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de eliminar el Cupón?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Eliminar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/descuentos/"  + hdddescuento_id;
                        let data = {
                            descuento_id: hdddescuento_id
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
                                    loadDescuentos();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha eliminado el Cupón correctamente'
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
        @endcan

        @can('admin.descuentos.desactivar')
        window.desactivarDescuento = function(hdddescuento_id)
        {
            Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de desactivar el Cupón?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Desactivar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/descuentos" +  "/desactivar/" + hdddescuento_id;
                            let data = {
                                descuento_id: hdddescuento_id
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
                                        loadDescuentos();
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha desactivado el cupón correctamente'
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
        @endcan

        @can('admin.descuentos.activar')
        window.activarDescuento = function(hdddescuento_id)
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
                            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/descuentos" +  "/activar/" + hdddescuento_id;
                            let data = {
                                descuento_id: hdddescuento_id
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
                                        loadDescuentos();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha activado el cupón correctamente'
                                        });
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
        @endcan

    </script>

@endsection