<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Subcategoría</th>
            <th>URL</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @if(count($subcategorias) > 0)

                @php($i=1)                 
                @foreach($subcategorias as $key => $subcat)
                <?php $encrypt_id=Hashids::encode($subcat->categoria_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{ $subcat->categoria }}</td>
                        <td class="text-muted"><input type="text" class="form-control" readonly value="categorias/{{$subcat->url }}"></td>
                        @if($subcat->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.subcategorias.actualizar')
                                    <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarSubcategoria(<?php echo "'".$encrypt_id."'"; ?>)" title="Editar Categoría" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @can('admin.subcategorias.borrar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarCategoría(<?php echo "'".$encrypt_id."'"; ?>)" title="Eliminar Categoría" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @if($subcat->estado!=0)
                                    
                                    @can('admin.subcategorias.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarCategoría(<?php echo "'".$encrypt_id."'"; ?>)" title="Desactivar Categoría" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                    
                                @else 

                                    @can('admin.subcategorias.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarCategoria(<?php echo "'".$encrypt_id."'"; ?>)" title="Activar Categoría" style="cursor: pointer; height:24px; width:24px;">&nbsp;
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

    {{ $subcategorias->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>
