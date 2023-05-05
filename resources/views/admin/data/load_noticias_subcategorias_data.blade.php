<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Noticia Subcategoría</th>
            <th>URL</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @if(count($subcategoriasNoticias) > 0)

                @php($i=1)                 
                @foreach($subcategoriasNoticias as $key => $nsub)
                <?php $encrypt_id=Hashids::encode($nsub->noticia_categoria_id);?>
                    <tr>
                        <td>{{$i}}</td>
                        <td class="font-weight-bold">{{ $nsub->noticia_categoria }}</td>
                        <td class="text-muted"><input type="text" class="form-control" readonly value="{{ $nsub->url }}"></td>
                        @if($nsub->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.noticias_subcategorias.actualizar')
                                    <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarNoticiaSubcategoria(<?php echo "'".$encrypt_id."'"; ?>)" title="Editar Categoría" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @can('admin.noticias_subcategorias.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarNoticiaSubCategoría(<?php echo "'".$encrypt_id."'"; ?>)" title="Eliminar Categoría" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @if($nsub->estado!=0)
                                    
                                    @can('admin.noticias_subcategorias.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarNoticiaSubCategoría(<?php echo "'".$encrypt_id."'"; ?>)" title="Desactivar Categoría" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                    
                                @else 

                                    @can('admin.noticias_subcategorias.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarNoticiaSubCategoria(<?php echo "'".$encrypt_id."'"; ?>)" title="Activar Categoría" style="cursor: pointer; height:24px; width:24px;">&nbsp;
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

    {{ $subcategoriasNoticias->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>
