<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Etiqueta</th>
            <th>URL</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @if(count($tags) > 0)

                @php($i=1)                 
                @foreach($tags as $key => $tag)
                <?php $encryptagid=Hashids::encode($tag->tag_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{ $tag->tag }}</td>
                        <td class="text-muted"><input type="text" class="form-control" readonly value="{{ $tag->url }}"></td>
                        @if($tag->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.tags.actualizar')
                                <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarEtiqueta(<?php echo "'".$encryptagid."'"; ?>)" title="Editar Etiqueta" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @can('admin.tags.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarEtiqueta(<?php echo "'".$encryptagid."'"; ?>)" title="Eliminar Etiqueta" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @if($tag->estado!=0)
                                    @can('admin.tags.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarEtiqueta(<?php echo "'".$encryptagid."'"; ?>)" title="Desactivar Etiqueta" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.tags.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarEtiqueta(<?php echo "'".$encryptagid."'"; ?>)" title="Activar Etiqueta" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @endif
                            </div>
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="5">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>

    {{ $tags->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>
