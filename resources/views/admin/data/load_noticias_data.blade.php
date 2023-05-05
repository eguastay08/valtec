<div class="table-responsive">
    <table class="table">
        
        <thead>
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Noticia</th>
                <th>Categorías</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($noticias) > 0)

                @php($i=1)                 
                @foreach($noticias as $key => $no)
                <?php $encryptagid=Hashids::encode($no->noticia_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        @if($no->imgnoticia!= '')
                        <td><img src="{{URL::asset($no->imgnoticia)}}" class="img-thumbnail" alt="Imagen Noticia" style="width:180px !important"></td>
                        @else 
                        <td><img src="{{URL::asset('admin_assets/images/noticias/producto.png')}}" alt="Imagen Noticia"></td>
                        @endif
                        <td class="font-weight-bold">{{$no->noticia}}</td>
                        <td>{{$no->noticia_categorias}}</td>
                        @if($no->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.noticias.actualizar')
                                <a href="{{ route('admin.noticias.edit',$encryptagid) }}"><img src="{{ url('admin_assets/images/edit.png') }}" title="Editar Producto" style="cursor: pointer; height:24px; width:24px;"></a>
                                @endcan

                                @can('admin.noticias.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarNoticia(<?php echo "'".$encryptagid."'"; ?>)" title="Eliminar Producto" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @if($no->estado!=0)
                                    @can('admin.noticias.activar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarNoticia(<?php echo "'".$encryptagid."'"; ?>)" title="Desactivar Producto" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.noticias.desactivar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarNoticia(<?php echo "'".$encryptagid."'"; ?>)" title="Activar Producto" style="cursor: pointer; height:24px; width:24px;">&nbsp;
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

    {{ $noticias->onEachSide(1)->links('admin.partials.my-paginate') }}

</div>
