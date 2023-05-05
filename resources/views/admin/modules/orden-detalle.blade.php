@extends('admin.master')

@section('title', 'Detalle de Orden')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                DETALLE ORDEN N° {{$orden['n_operacion']}}
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/ordenes') }}" class="colorfont"> <i class="fas fa-money-check-alt"></i> Orden</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-pallet"></i> Detalle de Orden</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">

                    <div class="card-body">

                        <h3 class="card-title">Datos de la Orden</h3>

                        <div class="row">

                            <div class="col-md-6 col-12">

                                <div class="form-group">
                                    <input type="hidden" name="hddproducto_id" id="hddproducto_id" value="{{ isset($orden) ? $orden->orden_id : '' }}">
                                    <label for="nombresOrden"><b>Nombres:</b></label>
                                    <input type="text" class="form-control ml-2" id="nombresOrden"  readonly name="nombresOrden" value="{{ isset($orden) ? $orden->nombres : '' }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nombresOrden"><b>Email:</b></label>
                                    <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" value="{{ isset($orden) ? $orden->email : '' }}">
                                </div>    
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nombresOrden"><b>Fecha de Pago:</b></label>
                                    <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" value="{{ isset($orden) ? $orden->fecha_pago : '' }}">
                                </div>    
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nombresOrden"><b>Cupon:</b></label>
                                    <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" value="{{ isset($orden) ? $orden->cupon : '' }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nombresOrden"><b>Información adicional:</b></label>
                                    <textarea name="" id="" class="form-control ml-2" readonly cols="30" rows="5">{{ isset($orden) ? $orden->informacion_adicional : '' }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-5">

                            <table class="table table-condensed" id="cart-table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Producto</th>
                                        <th style="width:90px;" class="hidden-xs">Precio</th>
                                        <th style="width:70px;">Cantidad</th>
                                        <th style="width:90px;">Total</th>
                                        <th style="width:90px;">Código Online</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($orden_detalle)

                                        @if(count($orden_detalle) > 0)

                                            @foreach($orden_detalle as $od)
                                                
                                                <tr>
                                                <td><img src="{{URL::asset($od->image)}}" alt="Imagen Producto" style="width: 60px;height:70px;"></td>
                                                    <td>{{$od->producto}}</td>
                                                    <td>{{$od->precio}}</td>
                                                    <td>{{$od->cantidad}}</td>
                                                    <td>{{$od->subtotal}}</td>
                                                    @if($od->codigo_producto != "")
                                                        <td><img class="img-fluid" src="{{asset('admin_assets/images/code-prod.png')}}" title="Códigos de Producto" alt="Códigos de Producto" style="cursor:pointer;width:24px;height:24px;" onclick="visualizarCodigo({{$od->codigo_producto}})"></td>
                                                    @endif
                                                </tr>
                                            @endforeach

                                        @endif

                                    @endisset
                                </tbody>
                            </table>

                        </div>

                        <div class="row">

                            <div class="col-md-4 col-12">   
                                <div class="form-group">
                                    <label for="nombresOrden"><b>Subtotal:</b></label>
                                    <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" placeholder="Ingrese el Nombre del Producto.." value="{{ isset($orden) ? $orden->subtotal : '' }}">
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="nombresOrden"><b>Descuento:</b></label>
                                    <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" placeholder="Ingrese el Nombre del Producto.." value="{{ isset($orden) ? $orden->descuento : '' }}">
                                </div>    
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="nombresOrden"><b>Total:</b></label>
                                    <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" placeholder="Ingrese el Nombre del Producto.." value="{{ isset($orden) ? $orden->total : '' }}">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="form-group">
                            <a class="btn btn-secondary btn-icon-split" style="color:black;" href="{{ url('/admin/ordenes') }}"> <span class="icon text-white-50"><img src="{{ url('admin_assets/images/back.png') }}" width="24px"></span><span class="text">Volver</span></a>                                                
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>

     <!--Bootstrap modal -->
     <div class="modal fade" id="ModalCodProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document" style="margin-top:20px;">
            <div class="modal-content">
                <!-- Modal heading -->
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalCodProducto">
                        Listado de Códigos de Producto
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiaModalCodigoProducto()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal body with image -->
                <div class="modal-body">
                    <table class="table table-condensed" id="tblCodigoProducto">
                        <thead>
                            <th>#</th>
                            <th>Código</th>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCerrarModalCodigo" data-dismiss="modal" onclick="limpiaModalCodigoProducto()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

   <script>

        window.visualizarCodigo = function(codigos) 
        {
            $('#tblCodigoProducto tbody').html('');
            $("#ModalCodProducto").modal('show');
            let o = JSON.stringify(codigos);
            let arrayCodigos = JSON.parse(o);
            let stringValue = '';
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/ordenes/detalle/" +o;
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                // acodigos=[];
                
                // for(var i  in data)
                // {
                //     acodigos.push(data[i]); 
                // }

                $.each(data, function(index, value) {
                    stringValue += '<tr><td>'+index+'</td><td>'+value+'</td></tr>'; 
                }); 

                $('#tblCodigoProducto tbody').html(stringValue);
            });
                
        }

        window.limpiaModalCodigoProducto = function() 
        {
            $('#tblCodigoProducto tbody').html('');
        }


   </script>

@endsection