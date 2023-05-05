<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Titulo</th>          
                <th>Link</th>
                <th>Ubicación</th>          
                <th>Posición</th>                 
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($banners) > 0)

                @php($i=1)                 
                @foreach($banners as $key => $ban)
                <?php $parameter=Hashids::encode($ban->banner_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        @if($ban->banner!='')
                        <td><img class="img-thumbnail" src="{{URL::asset($ban->banner)}}" alt="Imagen Banner" style="width:150px"></td>
                        @else
                        <td><img class="img-thumbnail" src="{{URL::asset('admin_assets/images/banners/default.png')}}" alt="Imagen Banner" style="width:150px"></td>
                        @endif
                        <td>{{$ban->titulo}}</td>
                        <td class="text-muted">{{ $ban->link }}</td>
                        <td>{{$ban->nombrebloque}}</td>
                        <td>{{$ban->posicion}}</td>
                        @if($ban->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.banners.actualizar')
                                <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarBanner(<?php echo "'".$parameter."'"; ?>)" title="Editar Banner" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @can('admin.banners.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarBanner(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Banner" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @if($ban->estado!=0)
                                    @can('admin.banners.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarBanner(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Banner" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.banners.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarBanner(<?php echo "'".$parameter."'"; ?>)" title="Activar Banner" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan    
                                @endif
                            </div>
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="8">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>

    {{ $banners->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>