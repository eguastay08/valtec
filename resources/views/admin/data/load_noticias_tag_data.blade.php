<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Noticia Tag</th>
            <th>URL</th>                  
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @if(count($noticia_tags) > 0)

                @php($i=1)                 
                @foreach($noticia_tags as $key => $nt)
                <?php $encryptagid=Hashids::encode($nt->noticia_tag_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{ $nt->noticia_tag }}</td>
                        <td class="text-muted"><input type="text" class="form-control" readonly value="{{ $nt->url }}"></td>
                        @if($nt->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.noticias_etiquetas.actualizar')
                                <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarNoticiaEtiqueta(<?php echo "'".$encryptagid."'"; ?>)" title="Editar Noticia Etiqueta" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @can('admin.noticias_etiquetas.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarNoticiaEtiqueta(<?php echo "'".$encryptagid."'"; ?>)" title="Eliminar Noticia Etiqueta" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @if($nt->estado!=0)
                                    @can('admin.noticias_etiquetas.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarNoticiaEtiqueta(<?php echo "'".$encryptagid."'"; ?>)" title="Desactivar Noticia Etiqueta" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.noticias_etiquetas.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarNoticiaEtiqueta(<?php echo "'".$encryptagid."'"; ?>)" title="Activar Noticia Etiqueta" style="cursor: pointer; height:24px; width:24px;">&nbsp;
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

    {{ $noticia_tags->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>
