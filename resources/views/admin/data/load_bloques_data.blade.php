<ul class="list-group">

    @if(count($bloques) > 0)
        @php($posicion=0)                 
        @foreach($bloques as $key => $blo)
            <?php $parameter=Hashids::encode($blo->bloque_id);?>
            @php($posicion++)
            <li class="list-group-item list-group-item-info">
                @if($blo->icono!='')
                    <img src="{{URL::asset($blo->icono)}}"  style="height:15px; margin-right:10px">
                @endif
                <b>{{$blo->nombre}}{{$blo->titulo!="" ? " | ".$blo->titulo : ''}}</b>
                <div class="float-right">
                    <div class="btn-group" role="group">
                        @can('admin.disenio.down')
                            @if($posicion >= 1 && $posicion < count($bloques))
                                <img src="{{ url('admin_assets/images/arrow_down.png') }}" onclick="bajarPosicion(<?php echo "'".$parameter."'"; ?>, {{"'".$blo->posicion."'"}})" title="Editar Categoría" style="cursor: pointer; height:20px; width:20px;">
                            @endif
                        @endcan

                        @can('admin.disenio.up')
                            @if($posicion > 1 && $posicion <= count($bloques))
                                <img src="{{ url('admin_assets/images/arrow_up.png') }}" onclick="subirPosicion(<?php echo "'".$parameter."'"; ?>, {{"'".$blo->posicion."'"}})" title="Editar Categoría" style="cursor: pointer; height:20px; width:20px;">
                            @endif
                        @endcan

                        @can('admin.disenio.actualizar')
                            <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarBloque(<?php echo "'".$parameter."'"; ?>)" title="Editar Bloque" style="cursor: pointer; height:20px; width:20px;">
                        @endcan

                        @can('admin.disenio.eliminar')
                            <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarBloque(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Bloque" style="cursor: pointer; height:20px; width:20px;">
                        @endcan
                        
                        @if($blo->estado!=0)
                            @can('admin.disenio.desactivar')
                                <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarBloque(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Bloque" style="cursor: pointer; height:20px; width:20px;">&nbsp;
                            @endcan
                        @else 
                            @can('admin.disenio.activar')
                            <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarBloque(<?php echo "'".$parameter."'"; ?>)" title="Activar Bloque" style="cursor: pointer; height:20px; width:20px;">&nbsp;
                            @endcan
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    @endif

</ul>