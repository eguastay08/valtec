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
                <th>Estado</th>
                <th>Cupon</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Ver Órden</th>
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
                        <td>{{ $i }}</td>
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
                        <td> 
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
                        <td>{{$or->cupon}}</td>
                        <td>{{$or->subtotal}}</td>
                        <td>{{$or->descuento}}</td>
                        <td>{{$or->total}}</td>
                        <td>{!! \Carbon\Carbon::parse($or->fecha_registro)->format('d/m/Y H:i:s') !!}</td>
                        <td>
                            <a href="{{ route('orders.show',$parameter) }}"><img src="{{ url('admin_assets/images/eye1.png') }}" onclick="VerDetalleOrden(<?php echo "'".$parameter."'"; ?>)" title="Ver Detalle de Orden" style="cursor: pointer; height:24px; width:24px;"></a>
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