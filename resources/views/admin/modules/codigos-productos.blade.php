@extends('admin.master')

@section('title', 'Mantemiento Producto')

@section('content')


    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE CÓDIGOS PARA {{ isset($producto) ? $producto[0]->producto : ''}}
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/productos') }}" class="colorfont"> <i class="fas fa-dolly-flatbed"></i> Productos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-dolly-flatbed"></i>{{ isset($producto) ? $producto[0]->producto : ''}}</li>
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
                    <label for="estadoCodigoProducto" style="font-size:14px;">Estado:</label>
                    <select name="estadoCodigoProducto" id="estadoCodigoProducto" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Disponible</option>
                        <option value="2">Pendiente</option>
                        <option value="3">Vendido</option>
                    </select>
                </div>
            </div>

            @can('admin.productos.codigos.crear')
            <div class="col-xl-5 col-md-6 col-sm-12">
                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw btn-mt" data-toggle="modal" data-target="#ModalCodigoProducto"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Código</button>
                </div>
            </div>
            @endcan

            
        </div>

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-dolly-flatbed"></i>
                            Listado de Códigos
                        </h4>
                        <section class="tbl_codigos_producto">
                            @if(isset($codigos_productos) && count($codigos_productos) > 0)
                                
                                @include('admin.data.load_codigos_productos_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="4">No se encontraron registros</td>
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
                                    <td style="font-size:14px">Editar Código</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Código</td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

     <!-- Modal Agregar -->
     <div class="modal fade" id="ModalCodigoProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formCodigoProducto" name="formCodigoProducto">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalCodigoProducto" style="color:white !important">AGREGAR CÓDIGO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalCodigoProducto()">
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
                                            <label for="txtCodigoProducto"><b>Código:</b></label>
                                            <input type="hidden" name="hddcodigoproducto_id" id="hddcodigoproducto_id" value="">
                                            <input type="text" class="form-control ml-2" id="txtCodigoProducto"  name="txtCodigoProducto" aria-describedby="emailHelp"
                                                placeholder="Ingrese el Código">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtDescripcionCodigo"><b>Descripción:</b></label>
                                            <textarea class="form-control ml-2" name="txtDescripcionCodigo" id="txtDescripcionCodigo" cols="20" rows="3" placeholder="Ingrese la Descripción.."></textarea>
                                        </div>
                                
                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarCodigoProduto"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarCodigoProduto" data-dismiss="modal" onclick="limpiarModalCodigoProducto()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script>

    function loadcodigosproductos(param='')
    {
        let url='';
        let get_producto_id = <?php echo "'".Hashids::encode($producto[0]->producto_id)."'"; ?>;
        if(param!="")
        {
            url= param;
        }
        else 
        {
            url=$('meta[name=app-url]').attr("content")  + "/admin/productos/codigos_producto/" + get_producto_id;
        }

        $.ajax({
            url: url
        }).done(function (data) {
            $('.tbl_codigos_producto').html(data);
        }).fail(function () {
            console.log("Failed to load data!");
        });
    }

    $('#estadoCodigoProducto').on('change', function (e ){
        let get_producto_id = <?php echo "'".Hashids::encode($producto[0]->producto_id)."'"; ?>;
        url=$('meta[name=app-url]').attr("content") + "/admin/productos/codigos_producto/" + get_producto_id;
        $.ajax({
            url: url,
            method:'GET',
            data: {estado: this.value}
        }).done(function (data) {
            $('.tbl_codigos_producto').html(data);
            // console.log(data);
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    });

    window.limpiarModalCodigoProducto = function() {
        $('#tituloModalCodigoProducto').html('AGREGAR CÓDIGO');
        $('#hddcodigoproducto_id').val("");
        $('#txtCodigoProducto').val("");
        $('#txtDescripcionCodigo').val("");
    }

    $('#formCodigoProducto').submit(function(event){
        event.preventDefault();
        let hddcodigoproducto_id = $('#hddcodigoproducto_id').val();
        if(hddcodigoproducto_id!="")
        {
            ActualizarCodigoProducto(hddcodigoproducto_id);
        }
        else 
        {
            GuardarCodigoProducto();
        }
    });

    window.GuardarCodigoProducto = function()
    {
        $("#btnGuardarCodigoProduto").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/admin/" + "productos/codigos_producto/store";
        let producto_id = <?php echo "'".Hashids::encode($producto[0]->producto_id)."'"; ?>;
        let data = {
            producto_id: producto_id,
            codigo_producto: $("#txtCodigoProducto").val(),
            descripcion_codigo: $('#txtDescripcionCodigo').val()
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: data,
            success: function(response) {
                $("#btnGuardarCodigoProduto").prop('disabled', false);
                if(response.code == "200")
                {
                        
                        $("#ModalCodigoProducto").modal('hide');
                        limpiarModalCodigoProducto();
                        loadcodigosproductos();

                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha registrado el Código correctamente'
                        });
                }
                else  if(response.code == "422")
                {
                        let errors = response.errors;
                        let codigoValidation = '';

                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                codigoValidation += '<li>' + value + '</li>';
                            }

                        }); 

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            html: '<ul>'+
                            codigoValidation  + 
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

    window.mostrarCodigoProducto = function(codigo_producto_id)
    {
        url=$('meta[name=app-url]').attr("content") + "/admin/productos/codigos_producto/show/"+codigo_producto_id;
        $("#ModalCodigoProducto").modal('show');
        $.ajax({
            url: url,
            method:'GET'
        }).done(function (data) {
            $('#tituloModalCodigoProducto').html('EDITAR CÓDIGO');
            $('#hddcodigoproducto_id').val(codigo_producto_id);
            $('#txtCodigoProducto').val(data[0].codigo);
            $('#txtDescripcionCodigo').val(data[0].descripcion);
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    }

    window.ActualizarCodigoProducto = function(codigo_producto_id)
    {
        $("#btnGuardarCodigoProduto").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/admin/" + "productos/codigos_producto/update/"+ codigo_producto_id;
        let producto_id = <?php echo "'".Hashids::encode($producto[0]->producto_id)."'"; ?>;
        let data = {
            producto_id: producto_id,
            codigo_producto: $("#txtCodigoProducto").val(),
            descripcion_codigo: $('#txtDescripcionCodigo').val()
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "PUT",
            data: data,
            success: function(response) {
                $("#btnGuardarCodigoProduto").prop('disabled', false);
                if(response.code == "200")
                {
                        
                        $("#ModalCodigoProducto").modal('hide');
                        limpiarModalCodigoProducto();
                        loadcodigosproductos();

                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado el Código correctamente'
                        });
                }
                else  if(response.code == "422")
                {
                        let errors = response.errors;
                        let codigoValidation = '';

                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                codigoValidation += '<li>' + value + '</li>';
                            }

                        }); 

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            html: '<ul>'+
                            codigoValidation  + 
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

    window.eliminarCodigoProducto = function(codigo_producto_id, producto_id)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está seguro de eliminar el código?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Eliminar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/codigos_producto/delete/"  + codigo_producto_id;
                        let data = {
                            codigo_producto_id: codigo_producto_id,
                            producto_id: producto_id
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
                                    loadcodigosproductos();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha eliminado el código correctamente'
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
