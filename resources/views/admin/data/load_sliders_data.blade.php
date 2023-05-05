<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Link</th>
                <th>Popup</th>          
                <th>Posición</th>                 
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($sliders) > 0)

                @php($i=1)                 
                @foreach($sliders as $key => $sli)
                <?php $parameter=Hashids::encode($sli->slider_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        @if($sli->url!='')
                        <td><img class="img-thumbnail" src="{{URL::asset($sli->url)}}" alt="Imagen Producto" style="width:150px"></td>
                        @else
                        <td><img class="img-thumbnail" src="{{URL::asset('admin_assets/images/sliders/default.png')}}" alt="Imagen Producto" style="width:150px"></td>
                        @endif
                        <td class="text-muted">{{ $sli->link }}</td>
                        <td>
                            @can('admin.sliders.popup')
                            <button id="btnPopupSlider" class="btn {{$sli->popup!=0?'btn-success':'btn-default'}} btn-xs" title="Popup" onclick="popupSlider(<?php echo "'".$parameter."'"; ?>, {{$sli->popup}})" style="padding:0.3rem 0.35rem;"><i class="fas fa-eye" style="font-size:0.8rem"></i></button>
                            @endcan
                        </td>
                        <td>{{$sli->posicion}}</td>
                        @if($sli->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.sliders.actualizar')
                                <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarSlider(<?php echo "'".$parameter."'"; ?>)" title="Editar Slider" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @can('admin.sliders.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarSlider(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Slider" style="cursor: pointer; height:24px; width:24px;">
                                @endcan

                                @if($sli->estado!=0)
                                    @can('admin.sliders.desactivar')
                                    <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarSlider(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Slider" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.sliders.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarSlider(<?php echo "'".$parameter."'"; ?>)" title="Activar Slider" style="cursor: pointer; height:24px; width:24px;">&nbsp;
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

    {{ $sliders->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>