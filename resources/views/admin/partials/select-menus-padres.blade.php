<div class="form-group">
    <label for="cbopadre"><b>Seleccionar Padre:</b></label>
    <select name="cbopadre" id="cbopadre" class="form-control ml-2 selectpicker">
        <option value="0">Menu Principal</option>
        @if(isset($menupadres) && count($menupadres) > 0)
            @foreach ($menupadres as $key => $mp)
                <option value="{{ $mp->menu_id }}">{{ $mp->nombre }}</option>
            @endforeach
        @endif
    </select>
</div>
            