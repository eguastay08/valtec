<div class="form-group">
    <label for="txtCategoriaPadre"><b>Categoría Padre:</b></label>
    <select name="CategoriaPadre" id="CategoriaPadre" class="form-control ml-2">
        <option value="0">-- Seleccione --</option>
        @if(isset($padres) && count($padres) > 0)
            @foreach ($padres as $key => $padre)
                <option value="{{ $padre->categoria_id }}">{{ $padre->categoria }}</option>
            @endforeach
        @endif
    </select>
</div>
            