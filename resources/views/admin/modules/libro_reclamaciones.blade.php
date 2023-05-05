@extends('admin.master')

@section('title', 'Módulo de Libro de Reclamaciones')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
            ADMINISTRADOR DE LIBRO DE RECLAMACIONES
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Libro de Reclamaciones</li>
                    </ol>
                </nav>
            </div>

        </div>

        
        <div class="row">
        
            <div class="col-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-paper-plane"></i>
                            Listado de Libros de Reclamaciones
                        </h4>
                        <section class="libros_reclamaciones">
                            @if(isset($libro_reclamaciones) && count($libro_reclamaciones) > 0)
                        
                                    @include('admin.data.load_libro_reclamaciones_data')
                            
                            @else 
                            
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombres Completo</th>
                                                <th>Tipo Doc.</th>
                                                <th>Nro Doc.</th>
                                                <th>Correo</th>
                                                <th>Id Bien</th>
                                                <th>Monto</th>
                                                <th>Tipo</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td align="center" colspan="9">No se encontraron registros</td>
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
                                    <td><img src="{{ url('admin_assets/images/eye.png') }}" alt="Editar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Visualizar Registro</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Registro</td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

      <!-- Modal Agregar -->
      <div class="modal fade" id="ModalLibroReclamaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formLibroReclamaciones" name="formLibroReclamaciones">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalCategoria" style="color:white !important">VISUALIZAR REGISTRO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalLibroReclamaciones()">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                    
                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mb-4">

                                    <div class="card-body">

                                        <div id="error-div"></div>

                                        <!-- <div class="form-group">
                                            <label for="txtCodigoCategoria"><b>Código:</b></label>
                                        
                                            <input type="text" class="form-control ml-2" id="txtCodigoCategoria"  name="txtCodigoCategoria" value="(AUTO)" disabled>
     
                                        </div> -->
                                
                                        <div class="form-group">
                                            <label for="txtNombresLR"><b>Nombres Completos:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtNombresLR"  name="txtNombresLR" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="nroDocLR"><b>Documento:</b></label>
                                            <div class="info-doc d-flex">
                                                <select name="cboLRtipoDoc" id="cboLRtipoDoc" class="form-control ml-2" readonly style="height:auto;">
                                                    <option value="1">RUC</option>
                                                    <option value="2">DNI</option>
                                                    <option value="3">Pasaporte</option>
                                                    <option value="4">CE</option>
                                                </select>
                                                <input type="text" class="form-control ml-2" id="nroDocLR"  name="nroDocLR" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="txtDireccionLR"><b>Dirección:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtDireccionLR"  name="txtDireccionLR" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtTelefonoLR"><b>Teléfono:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtTelefonoLR"  name="txtTelefonoLR" readonly>
                                        </div>
          
                                        <div class="form-group">
                                            <label for="txtCorreoLR"><b>Correo:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtCorreoLR"  name="txtCorreoLR" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="cboBienContratado"><b>Bien Contratado:</b></label>
                                            <select name="cboBienContratado" id="cboBienContratado" class="form-control ml-2" readonly>
                                                <option value="1">PRODUCTO</option>
                                                <option value="0">SERVICIO</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtMontoLR"><b>Monto Reclamado:</b></label>
                                            <input type="text" class="form-control ml-2" id="txtMontoLR"  name="txtMontoLR" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="cboTipoLR"><b>Tipo:</b></label>
                                            <select name="cboTipoLR" id="cboTipoLR" class="form-control ml-2" readonly>
                                                <option value="1">RECLAMO</option>
                                                <option value="2">QUEJA</option>
                                                <option value="3">SUGERENCIA</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtDetalleLR"><b>Detalle del Cliente:</b></label>
                                            <textarea class="form-control ml-2" name="txtDetalleLR" id="txtDetalleLR" cols="20" rows="4" readonly></textarea>
                                        </div>
       
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" id="btnCerrarCategoria" data-dismiss="modal" onclick="limpiarModalLibroReclamaciones()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <script>
    
        $(document).ready(function() {

            function loadLibrosReclamaciones(page)
            {
                let url='';
                url=$('meta[name=app-url]').attr("content")  + "/admin" + "/libro_reclamaciones?page="+page;

                $.ajax({
                    url: url,
                    method:'GET'
                }).done(function (data) {
                    $('.libros_reclamaciones').html(data);
                }).fail(function () {
                    console.log("Failed to load data!");
                });
            }

            window.limpiarModalLibroReclamaciones = function()
            {
                $('#txtNombresLR').val("");
                $('#cboLRtipoDoc').val("");
                $('#nroDocLR').val("");
                $('#txtDireccionLR').val("");
                $('#txtTelefonoLR').val("");
                $('#txtCorreoLR').val("");
                $('#cboBienContratado').val("");
                $('#txtMontoLR').val("");
                $('#cboTipoLR').val("");
                $('#txtDetalleLR').val("");
            }

            window.showLibroReclamacion = function(hddlibro_reclamacion_id)
            {
                $("#ModalLibroReclamaciones").modal('show');
                url=$('meta[name=app-url]').attr("content") + "/admin" + "/libro_reclamaciones/" +hddlibro_reclamacion_id;
                $.ajax({
                    url: url,
                    method:'GET'
                }).done(function (data) {
                    // let valores = JSON.parse(data)
                    $('#txtNombresLR').val(data.nombre_apellidos);
                    $('#cboLRtipoDoc').val(data.tipo_doc);
                    $('#nroDocLR').val(data.nro_documento);
                    $('#txtDireccionLR').val(data.direccion);
                    $('#txtTelefonoLR').val(data.telefono);
                    $('#txtCorreoLR').val(data.correo);
                    $('#cboBienContratado').val(data.id_bien_contratado);
                    $('#txtMontoLR').val('S/.' + data.monto_reclamado);
                    $('#cboTipoLR').val(data.tipo);
                    $('#txtDetalleLR').val(data.detalle_cliente);
                }).fail(function () {
                    console.log("Error al cargar los datos");
                });
            }

            window.eliminarLibroReclamacion = function(hddlibro_reclamacion_id)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Está seguro de eliminar el registro?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: "#EB1010",
                    confirmButtonText: `Eliminar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $('meta[name=app-url]').attr("content") + "/admin/libro_reclamaciones/" + hddlibro_reclamacion_id;
                            let data = {
                                libro_reclamacion_id: hddlibro_reclamacion_id
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
                                        loadLibrosReclamaciones();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ÉXITO!',
                                            text: 'Se ha eliminado el registro correctamente'
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

        });

    </script>

@endsection