<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Imagen</th>
            <th width="12%">Producto</th>
            <th width="5%">Categorias</th>
            <th width="10">Descripcion</th>
            <th width="10">Precio</th>
            <th width="10">Precio Anterior</th>
            <th>Características</th>
            <th width="10%">Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @if(count($productos) > 0)

                @php($i=1)                 
                @foreach($productos as $key => $pro)
                <?php $encryptagid=Hashids::encode($pro->producto_id);?>
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        @if($pro->imgproducto!= '')
                        <td><img src="{{URL::asset($pro->imgproducto)}}" alt="Imagen Producto"></td>
                        @else 
                        <td><img src="{{URL::asset('admin_assets/images/productos/producto.png')}}" alt="Imagen Producto"></td>
                        @endif
                        <td class="font-weight-bold">{{$pro->producto}}</td>
                        <td>{{$pro->categorias}}</td>
                     
                        <td class="text-muted">{{ Str::limit(strip_tags($pro->descripcion_producto),100)}}</td>
                        <td>{{ $pro->precio }}</td>
                        <td>{{ $pro->precio_anterior }}</td>
                        <td>
                            @can('admin.productos.agotado')
                            <button id="btnAgotadoProducto" class="btn {{$pro->agotado!=0?'btn-danger':'btn-default'}} btn-xs" title="Agotado" onclick="agotadoProducto(<?php echo "'".$encryptagid."'"; ?>, {{$pro->agotado}})" style="padding:0.3rem 0.35rem;"><i class="fas fa-exclamation-circle" style="font-size:0.8rem"></i></button>
                             @endcan
                        </td>
                        @if($pro->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @if($pro->con_stock == 0)
                                    @can('admin.productos.codigos')
                                    <a href="{{ url('admin/productos/codigos_producto/'.$encryptagid) }}"><img src="{{ url('admin_assets/images/code.png') }}" title="Ver Códigos" style="cursor: pointer; height:24px; width:24px;"></a>
                                    @endcan
                                @endif

                                @can('admin.productos.actualizar')
                                <a href="{{ route('admin.productos.edit',$encryptagid) }}"><img src="{{ url('admin_assets/images/edit.png') }}" title="Editar Producto" style="cursor: pointer; height:24px; width:24px;"></a>
                                @endcan

                                @can('admin.productos.borrar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarProducto(<?php echo "'".$encryptagid."'"; ?>)" title="Eliminar Producto" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @if($pro->estado!=0)
                                    @can('admin.productos.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarProducto(<?php echo "'".$encryptagid."'"; ?>)" title="Desactivar Producto" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.productos.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarProducto(<?php echo "'".$encryptagid."'"; ?>)" title="Activar Producto" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @endif
                            </div>
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="9">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>
    
    {{ $productos->onEachSide(1)->links('admin.partials.my-paginate') }}

    <!-- {{ $productos->onEachSide(2)->links() }} -->




</div>
