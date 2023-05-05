@extends('admin.master')

@section('title', 'Módulo de Órdenes')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE ÓRDENES
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-money-check-alt"></i> Órdenes</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-money-check-alt"></i>
                            Listado de Órdenes
                        </h4>
                        <section class="tbl_ordenes">
                            @if(isset($ordenes) && count($ordenes) > 0)
                                
                                @include('admin.data.load_ordenes_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Email</th>
                                                <th>Fecha de Pago</th>
                                                <th>Información Adicional</th>
                                                <th>Ip</th>
                                                <th>Medio de Pago</th>
                                                <th>N° Operación</th>
                                                <th>Cupon</th>
                                                <th>Subtotal</th>
                                                <th>Descuento</th>
                                                <th>Total</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="13">No se encontraron registros</td>
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

    </div>

     <!--Bootstrap modal -->
    <div class="modal fade" id="ModalComprobante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document" style="margin-top:20px;">
            <div class="modal-content">
                <!-- Modal heading -->
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalComprobanteLabel">
                        Comprobante de Pago
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalComprobante()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal body with image -->
                <div class="modal-body">
                    <img id="imgComprobante" src="" width="450px" height="450px" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCerrarCategoria" data-dismiss="modal" onclick="limpiarModalComprobante()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        $(window).on('hashchange',function(){
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else{
                    loadcategorias(page);
                }
            }
        });

        $(document).on('click', '.tbl_ordenes .pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadordenes(page);
        });

        function loadordenes(page)
        {
            let url='';
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/ordenes?page="+page;

            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                $('.tbl_ordenes').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }

        window.limpiarModalComprobante = function() {
            $('#imgComprobante').attr('src',"");
        }

        window.MostrarComprobante = function(comprobante)
        {
            // console.log(comprobante);
            $("#ModalComprobante").modal('show');
            $('#imgComprobante').attr('src', comprobante);
        }

        window.AprobarOrden = function(orden_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de Aprobar la Orden?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#63AA08",
                confirmButtonText: `Aprobar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/ordenes/aprobar/"  + orden_id;
                        let data = {
                            orden_id: orden_id
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
                                    loadordenes();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha aprobado la orden correctamente'
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

        window.RechazarOrden = function(orden_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de Rechazar la Orden?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Rechazar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/ordenes/rechazar/"  + orden_id;
                        let data = {
                            orden_id: orden_id
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
                                    loadordenes();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha rechazado la orden correctamente'
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

        window.AtenderOrden = function(orden_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de Atender la Orden?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#0D14B4",
                confirmButtonText: `Atender`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/ordenes/atender/"  + orden_id;
                        let data = {
                            orden_id: orden_id
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
                                    loadordenes();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha atendido la orden correctamente'
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

    </script>

@endsection