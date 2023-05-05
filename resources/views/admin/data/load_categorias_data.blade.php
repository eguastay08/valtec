<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Categoría</th>
            <th>URL</th>
            <th>Subcategorías</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @if(count($categorias) > 0)

                @php($i=1)                 
                @foreach($categorias as $key => $cat)
                <?php $parameter=Hashids::encode($cat->categoria_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{ $cat->categoria }}</td>
                        <td class="text-muted"><input type="text" class="form-control" readonly value="categorias/{{ $cat->url }}"></td>
                        <td>
                            @can('admin.categorias.show')
                            <a href="{{ url('admin/categorias/subcategoria/'.$parameter) }}">
                                <img src="{{ url('admin_assets/images/eye.png') }}" title="Ver Subcategorías" style="cursor: pointer; height:24px; width:24px;">
                            </a>
                            @endcan
                        </td>
                        @if($cat->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.categorias.actualizar')
                                <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarCategoría(<?php echo "'".$parameter."'"; ?>)" title="Editar Categoría" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @can('admin.categorias.borrar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarCategoría(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Categoría" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @if($cat->estado!=0)
                                    @can('admin.categorias.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarCategoría(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Categoría" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.categorias.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarCategoria(<?php echo "'".$parameter."'"; ?>)" title="Activar Categoría" style="cursor: pointer; height:24px; width:24px;">&nbsp;
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

    {{ $categorias->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>
