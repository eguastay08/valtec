<div class="form-group">
    <label for="txtNoticiaCategoriaPadre"><b>Noticia Categoría Padre:</b></label>
    <select name="txtNoticiaCategoriaPadre" id="txtNoticiaCategoriaPadre" class="form-control ml-2">
        <option value="0">-- Seleccione --</option>
        @if(isset($padres_nc) && count($padres_nc) > 0)
            @foreach ($padres_nc as $key => $padre_nc)
                <option value="{{ $padre_nc->noticia_categoria_id }}">{{ $padre_nc->noticia_categoria }}</option>
            @endforeach
        @endif
    </select>
</div>
            