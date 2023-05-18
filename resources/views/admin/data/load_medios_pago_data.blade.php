<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Transferencia</th>
                <th>Depósito</th>
                <th>Billetera Digital</th>
                <th>Pago Online</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($mediospago) > 0)

                @php($i=1)                 
                @foreach($mediospago as $key => $mp)
                <?php $parameter=Hashids::encode($mp->medio_pago_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        @if($mp->imagen!='')
                        <td><img class="img-thumbnail" src="{{URL::asset($mp->imagen)}}" alt="Imagen Medio Pago" style="width:150px"></td>
                        @else
                        <td><img class="img-thumbnail" src="{{URL::asset('admin_assets/images/medios_pago/default.png')}}" alt="Imagen Banner" style="width:150px"></td>
                        @endif
                        <td>{{$mp->nombre}}</td>
                        <td class="text-muted">{{strip_tags($mp->descripcion)}}</td>
                        <td>{{$mp->transferencia == 1 ? 'Si' : 'No'}}</td>
                        <td>{{$mp->deposito == 1 ? 'Si' : 'No'}}</td>
                        <td>{{$mp->billetera_digital == 1 ? 'Si' : 'No'}}</td>
                        <td>{{$mp->pago_online == 1 ? 'Si' : 'No'}}</td>
                        @if($mp->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.medios_pago.actualizar')
                                    <a href="{{ route('admin.medios_pagos.edit',$parameter) }}"><img src="{{ url('admin_assets/images/edit.png') }}" title="Editar Medio de Pago" style="cursor: pointer; height:24px; width:24px;"></a>
                                @endcan

                                @can('admin.medios_pago.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarMedioPago(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Medio de Pago" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @if($mp->estado!=0)
                                    @can('admin.medios_pago.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarMedioPago(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Banner" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.medios_pago_activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarMedioPago(<?php echo "'".$parameter."'"; ?>)" title="Activar Banner" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @endif
                            
                            </div>
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="10">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>

    {{ $mediospago->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>