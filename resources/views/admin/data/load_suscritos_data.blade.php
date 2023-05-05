<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($suscripciones) > 0)

                @php($i=1)                 
                @foreach($suscripciones as $key => $sus)
                <?php $parameter=Hashids::encode($sus->suscripcion_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{ $sus->email }}</td>
                        <td>
                            <div class="btn-group" role="group">
                               
                                @can('admin.suscripciones.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarSuscripcion(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Suscripcion" style="cursor: pointer; height:24px; width:24px;">
                                @endcan    
                            
                            </div>
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="3">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>

    {{ $suscripciones->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>
