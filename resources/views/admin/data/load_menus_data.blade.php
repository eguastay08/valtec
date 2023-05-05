<ul class="list-group">
    @if(count($menus) > 0)
        @php($posicion=0)                 
        @foreach($menus as $key => $me)
            <?php $parameter=Hashids::encode($me['menu_id']);?>
            @php($posicion++)
            <li class="list-group-item list-group-item-info">
                @if($me['icono']!= "")
                    <img src="{{URL::asset($me['icono'])}}"  style="height:15px; margin-right:10px">
                @endif
                <b>{{$me['nombre']}}</b>
                <div class="float-right">
                    <div class="btn-group" role="group">
                        @can('admin.menu.down')
                            @if($posicion >= 1 && $posicion < count($menus))
                                <img src="{{ url('admin_assets/images/arrow_down.png') }}" onclick="bajarPosicion(<?php echo "'".$parameter."'"; ?>, {{"'".$me['posicion']."'"}}, {{"'".$me['padre']."'"}})" title="Editar Categoría" style="cursor: pointer; height:20px; width:20px;">
                            @endif
                        @endcan

                        @can('admin.menu.up')
                            @if($posicion > 1 && $posicion <= count($menus))
                                <img src="{{ url('admin_assets/images/arrow_up.png') }}" onclick="subirPosicion(<?php echo "'".$parameter."'"; ?>, {{"'".$me['posicion']."'"}}, {{"'".$me['padre']."'"}})" title="Editar Categoría" style="cursor: pointer; height:20px; width:20px;">
                            @endif
                        @endcan

                        @can('admin.menu.crear')
                            <img src="{{ url('admin_assets/images/add3.png') }}" onclick="agregarSubMenu(<?php echo "'".$parameter."'"; ?>)" title="Editar Menú" style="cursor: pointer; height:20px; width:20px;">
                        @endcan

                        @can('admin.menu.actualizar')
                            <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarMenu(<?php echo "'".$parameter."'"; ?>)" title="Editar Menú" style="cursor: pointer; height:20px; width:20px;">
                        @endcan

                        @can('admin.menu.eliminar')
                            <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarMenu(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Menú" style="cursor: pointer; height:20px; width:20px;">
                        @endcan
                        
                        @if($me['estado']!=0)
                            @can('admin.menu.desactivar')
                                <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarMenu(<?php echo "'".$parameter."'"; ?>)" title="Desactivar Menú" style="cursor: pointer; height:20px; width:20px;">&nbsp;
                            @endcan
                        @else 
                            @can('admin.menu.activar')
                            <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarMenu(<?php echo "'".$parameter."'"; ?>)" title="Activar Menú" style="cursor: pointer; height:20px; width:20px;">&nbsp;
                            @endcan
                        @endif
                    </div>
                </div>
            </li>

            @php($posicionSubmenu=0)      
            @foreach($me['sub_menu'] as $p => $n)
                <?php $parametesubmenu=Hashids::encode($n['menu_id']);?>
                @php($posicionSubmenu++)
                <li class="list-group-item">
                    @if($n['icono']!= "")
                        <img src="{{URL::asset($n['icono'])}}"  style="height:15px; margin-right:10px">
                    @endif
                    {{ $n['nombre'] }} 
                    <div class="float-right">
                        <div class="btn-group" role="group">

                            @isset($n['sub_menu'])

                                @if($posicionSubmenu >= 1 && $posicionSubmenu < count($me['sub_menu']))
                                    <img src="{{ url('admin_assets/images/arrow_down.png') }}" onclick="bajarPosicion(<?php echo "'".$parametesubmenu."'"; ?>, {{"'".$n['posicion']."'"}}, {{"'".$n['padre']."'"}})" title="Editar Categoría" style="cursor: pointer; height:20px; width:20px;">
                                @endif

                                @if($posicionSubmenu <= count($me['sub_menu']) && $posicionSubmenu > 1)
                                    <img src="{{ url('admin_assets/images/arrow_up.png') }}" onclick="subirPosicion(<?php echo "'".$parametesubmenu."'"; ?>, {{"'".$n['posicion']."'"}}, {{"'".$n['padre']."'"}})" title="Editar Categoría" style="cursor: pointer; height:20px; width:20px;">
                                @endif

                                @can('admin.menu.actualizar')
                                    <img src="{{ url('admin_assets/images/edit.png') }}" onclick="mostrarMenu(<?php echo "'".$parametesubmenu."'"; ?>)" title="Editar Menú" style="cursor: pointer; height:20px; width:20px;">
                                @endcan

                                @can('admin.menu.eliminar')
                                    <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarMenu(<?php echo "'".$parametesubmenu."'"; ?>)" title="Eliminar Menú" style="cursor: pointer; height:20px; width:20px;">
                                @endcan
                                
                                @if($n['estado']!=0)
                                    @can('admin.menu.desactivar')
                                        <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarMenu(<?php echo "'".$parametesubmenu."'"; ?>)" title="Desactivar Menú" style="cursor: pointer; height:20px; width:20px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.menu.activar')
                                    <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarMenu(<?php echo "'".$parametesubmenu."'"; ?>)" title="Activar Menú" style="cursor: pointer; height:20px; width:20px;">&nbsp;
                                    @endcan
                                @endif


                            @endisset
                        
                        </div>
                    </div>
                </li>

            @endforeach

        @endforeach
    @endif

</ul>