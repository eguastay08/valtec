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
            @if(count($ordenes) > 0)

                @php($i=1)                 
                @foreach($ordenes as $key => $or)
                <?php $parameter=Hashids::encode($or->orden_id);
                        // $fechaPago = date_format($or->fecha_pago,"Y/m/d");
                ?>
                    <tr>
                        <td>{{ $i }}<br>
                            @if($or->orden_estado_id==2)
                               <label class="badge badge-light badge-pill" style="color:black;">{{$or->estado}}</label>
                            @elseif($or->orden_estado_id==3)
                               <label class="badge badge-danger badge-pill">{{$or->estado}}</label>
                            @elseif($or->orden_estado_id==1)
                               <label class="badge badge-success badge-pill">{{$or->estado}}</label>
                            @elseif($or->orden_estado_id==4)
                               <label class="badge badge-info badge-pill">{{$or->estado}}</label>
                            @elseif($or->orden_estado_id==5)
                               <label class="badge badge-warning badge-pill">{{$or->estado}}</label>
                            @elseif($or->orden_estado_id==6)
                               <label class="badge badge-secondary badge-pill">{{$or->estado}}</label>
                            @elseif($or->orden_estado_id==7)
                               <label class="badge badge-dark badge-pill">{{$or->estado}}</label>
                            @endif
                        </td>
                        <td>{{$or->nombres}}</td>
                        <td class="text-muted">{{ $or->email }}</td>
                        <td>{!! \Carbon\Carbon::parse($or->fecha_pago)->format('d/m/Y') !!}</td>
                        <td>
                            <span>Telefono: {{$or->informacion_adicional}}</span><br>
                            <span>Provincia: {{$or->provincia}}</span><br>
                            <span>Ciudad: {{$or->ciudad}}</span><br>
                            <span>Dirección: {{$or->direccion}} {{$or->direccion2}}</span><br>
                            <span>Comentario: {{$or->comentario}}</span><br>
                        </td>
                        <td>{{$or->ip}}</td>
                        @if($or->mediopago != "")
                        <td>{{$or->mediopago}}</td>
                        @else 
                        <td>{{$or->mediopago_online}}</td>
                        @endif
                        <td>{{$or->n_operacion}}</td>
                        <td>{{$or->cupon}}</td>
                        <td>{{$or->subtotal}}</td>
                        <td>{{$or->descuento}}</td>
                        <td>{{$or->total}}</td>
                        <td>{!! \Carbon\Carbon::parse($or->fecha_registro)->format('d/m/Y H:i:s') !!}</td>
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.ordenes.ver_detalle')
                                    <a href="{{ route('admin.ordenes.show',$parameter) }}"><img src="{{ url('admin_assets/images/eye1.png') }}" onclick="VerDetalleOrden(<?php echo "'".$parameter."'"; ?>)" title="Ver Detalle de Orden" style="cursor: pointer; height:24px; width:24px;"></a>
                                @endcan

                                @can('admin.ordenes.visualizar_comprobante')
                                    @if($or->comprobante!="")
                                        <img src="{{ url('admin_assets/images/comprobante.png') }}" onclick="MostrarComprobante(<?php echo "'".asset('assets/images/comprobantes/'.$or->comprobante)."'"; ?>)" style="cursor: pointer; height:24px; width:24px;" title="Visualizar comprobante" alt="Visualizar comprobante">                                
                                    @endif
                                @endcan

                                @if($or->orden_estado_id==2)

                                    @can('admin.ordenes.aprobar_orden')
                                        <img src="{{ url('admin_assets/images/aprobado.png') }}" onclick="AprobarOrden(<?php echo "'".$parameter."'"; ?>)" title="Aprobar Orden" style="cursor: pointer; height:24px; width:24px;">
                                    @endcan

                                    @can('admin.ordenes.rechazar_orden')
                                        <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="RechazarOrden(<?php echo "'".$parameter."'"; ?>)" title="Rechazar Orden" style="cursor: pointer; height:24px; width:24px;">
                                    @endcan
                                

                                @elseif($or->orden_estado_id==7)

                                    @can('admin.moneda.eliminar')
                                        @can('admin.ordenes.aprobar_orden')
                                        <img src="{{ url('admin_assets/images/aprobado.png') }}" onclick="AprobarOrden(<?php echo "'".$parameter."'"; ?>)" title="Aprobar Orden" style="cursor: pointer; height:24px; width:24px;">
                                        @endcan

                                        @can('admin.ordenes.rechazar_orden')
                                        <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="RechazarOrden(<?php echo "'".$parameter."'"; ?>)" title="Rechazar Orden" style="cursor: pointer; height:24px; width:24px;">
                                        @endcan 
                                    @endcan


                                @elseif($or->orden_estado_id==1)

                                        @can('admin.ordenes.atender_orden')
                                            <img src="{{ url('admin_assets/images/atendido.png') }}" onclick="AtenderOrden(<?php echo "'".$parameter."'"; ?>)" title="Orden Atendida" style="cursor: pointer; height:24px; width:24px;">
                                        @endcan

                                @endif

                            </div>
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="7">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>

    {{ $ordenes->onEachSide(1)->links('admin.partials.my-paginate') }}

</div>