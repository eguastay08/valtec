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
            @if(count($descuentos) > 0)
                @php($i=1)                 
                @foreach($descuentos as $key => $desc)
                <?php $parameter=Hashids::encode($desc->descuento_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{$desc->cupon}}</td>
                        <td class="text-muted">% {{ $desc->porcentaje }}</td>
                        <td>{{$desc->nro_productos}}</td>
                        <td>{{$desc->uso == 1 ? 'Ilimitado':'Solo una vez'}}</td>
                        @if($desc->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.descuentos.actualizar')
                                    <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarDescuento(<?php echo "'".$parameter."'"; ?>)" title="Editar Descuento" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @can('admin.descuentos.eliminar')
                                    <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarDescuento(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Descuento" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @if($desc->estado!=0)
                                    @can('admin.descuentos.activar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarDescuento(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Descuento" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.descuentos.desactivar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarDescuento(<?php echo "'".$parameter."'"; ?>)" title="Activar Descuento" style="cursor: pointer; height:24px; width:24px;">&nbsp;
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

    {{ $descuentos->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>