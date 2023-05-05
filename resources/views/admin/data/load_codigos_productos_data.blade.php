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
            @if(count($codigos_productos) > 0)

                @php($i=1)                 
                @foreach($codigos_productos as $key => $codpro)
                <?php $parameter=Hashids::encode($codpro->producto_codigos_id);?>
                <?php $paramProducto=Hashids::encode($codpro->producto_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{ $codpro->codigo }}</td>
                        <th class="text-muted">{{ $codpro->descripcion }}</th>
                        @if($codpro->estado==1)
                            <td><label class="badge badge-success badge-pill">Disponible</label></td>
                        @elseif($codpro->estado==2)
                           <td><label class="badge badge-secondary badge-pill">Pendiente</label></td>
                        @elseif($codpro->estado==3)
                           <td><label class="badge badge-info badge-pill">vendido</label></td>
                        @endif
                        <td>
                            @if($codpro->estado!=3)
                            <div class="btn-group" role="group">
                                @can('admin.productos.codigos.editar')
                                <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarCodigoProducto(<?php echo "'".$parameter."'"; ?>)" title="Editar Código" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @can('admin.productos.codigos.borrar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarCodigoProducto(<?php echo "'".$parameter."'"; ?>,<?php echo "'".$paramProducto."'"; ?>)" title="Eliminar Código" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                            </div>
                            @endif
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="4">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>

    {{ $codigos_productos->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>