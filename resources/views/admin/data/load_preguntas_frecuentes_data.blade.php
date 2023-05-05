<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Pregunta</th>
                <th>Respuesta</th>      
                <th>Posición</th>    
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($preguntas_frecuentes) > 0)

                @php($i=1)                 
                @foreach($preguntas_frecuentes as $key => $pre)
                <?php $parameter=Hashids::encode($pre->pregunta_frecuente_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{$pre->pregunta}}</td>
                        <td class="text-muted">{{ $pre->respuesta }}</td>
                        <td>{{$pre->posicion}}</td>
                        @if($pre->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.preguntas.actualizar')
                                <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarPreguntaFrecuente(<?php echo "'".$parameter."'"; ?>)" title="Editar Pregunta Frecuente" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @can('admin.preguntas.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarPreguntaFrecuente(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Pregunta Frecuente" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @if($pre->estado!=0)

                                    @can('admin.preguntas.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarPreguntaFrecuente(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Pregunta Frecuente" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan

                                @else 

                                    @can('admin.preguntas.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarPreguntaFrecuente(<?php echo "'".$parameter."'"; ?>)" title="Activar Pregunta Frecuente" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                    
                                @endif
                            </div>
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="6">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>

    {{ $preguntas_frecuentes->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>