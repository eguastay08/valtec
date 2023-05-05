<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Noticia Categoría</th>
            <th>URL</th>
            <th>Subcategorías</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @if(count($noticias_categoria) > 0)

                @php($i=1)                 
                @foreach($noticias_categoria as $key => $ncat)
                <?php $parameter=Hashids::encode($ncat->noticia_categoria_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{ $ncat->noticia_categoria }}</td>
                        <td class="text-muted"><input type="text" class="form-control" readonly value="{{ $ncat->url }}"></td>
                        <td>
                            @can('admin.noticias_categorias.visualizar')
                            <a href="{{ url('admin/noticia_categoria/subcategorias_noticias/'.$parameter) }}">
                                <img src="{{ url('admin_assets/images/eye.png') }}" title="Ver Subcategorías" style="cursor: pointer; height:24px; width:24px;">
                            </a>
                            @endcan
                        </td>
                        @if($ncat->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.noticias_categorias.actualizar')
                                <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarNoticiaCategoria(<?php echo "'".$parameter."'"; ?>)" title="Editar Noticia Categoría" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @can('admin.noticias_categorias.Eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarNoticiaCategoría(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Noticia Categoría" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @if($ncat->estado!=0)
                                    @can('admin.noticias_categorias.Desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarNoticiaCategoría(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Noticia Categoría" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.noticias_categorias.Activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarNoticiaCategoria(<?php echo "'".$parameter."'"; ?>)" title="Activar Noticia Categoría" style="cursor: pointer; height:24px; width:24px;">&nbsp;
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

    {{ $noticias_categoria->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>
