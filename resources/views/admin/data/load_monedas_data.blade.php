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
            @if(count($monedas) > 0)

                @php($i=1)                 
                @foreach($monedas as $key => $mo)
                <?php $parameter=Hashids::encode($mo->moneda_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{$mo->nombre}}</td>
                        <td class="text-muted">{{ $mo->codigo }}</td>
                        <td>{{$mo->prefijo}}</td>
                        <td>{{$mo->sufijo}}</td>
                        <td>{{$mo->tipo_cambio}}</td>
                        @if($mo->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.moneda.actualizar')
                                <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarMoneda(<?php echo "'".$parameter."'"; ?>)" title="Editar Medio de Pago" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @can('admin.moneda.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarMoneda(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Medio de Pago" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @if($mo->estado!=0)
                                    @can('admin.moneda.activar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarMoneda(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Banner" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.moneda.desactivar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarMoneda(<?php echo "'".$parameter."'"; ?>)" title="Activar Banner" style="cursor: pointer; height:24px; width:24px;">&nbsp;
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

    {{ $monedas->onEachSide(1)->links('admin.partials.my-paginate') }}

</div>