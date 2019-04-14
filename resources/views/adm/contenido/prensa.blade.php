<div class="row justify-content-center">
    <div class="col-12 col-md-5">
        <button type="submit" class="btn btn-success btn-block text-uppercase">Editar<i class="fas fa-edit ml-2"></i></button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <fieldset>
            <legend>Texto español</legend>
            <input placeholder="Texto español" id="texto_esp" name="texto_esp" class="form-control" value="{{ $contenido['esp'] }}"/>
        </fieldset>
    </div>
    <div class="col-12">
        <fieldset>
            <legend>Texto inglés</legend>
            <input placeholder="Texto" id="texto_ing" name="texto_ing" class="form-control" value="{{ $contenido['ing'] }}"/>
        </fieldset>
    </div>
    <div class="col-12">
        <fieldset>
            <legend>Texto italiano</legend>
            <input placeholder="Texto" id="texto_ita" name="texto_ita" class="form-control" value="{{ $contenido['ita'] }}"/>
        </fieldset>
    </div>
</div>
@push('scripts')

@endpush