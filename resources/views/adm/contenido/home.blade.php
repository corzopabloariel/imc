<div class="row justify-content-center">
    <div class="col-12 col-md-5">
        <button type="submit" class="btn btn-success btn-block text-uppercase">Editar<i class="fas fa-edit ml-2"></i></button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <fieldset>
            <legend>Texto español</legend>
            <textarea placeholder="Texto" id="texto_esp" name="texto_esp" class="validate ckeditor w-100">{!! $contenido["esp"] !!}</textarea>
        </fieldset>
    </div>
    <div class="col-12">
        <fieldset>
            <legend>Texto inglés</legend>
            <textarea placeholder="Texto" id="texto_ing" name="texto_ing" class="validate ckeditor w-100">{!! $contenido["ing"] !!}</textarea>
        </fieldset>
    </div>
    <div class="col-12">
        <fieldset>
            <legend>Texto italiano</legend>
            <textarea placeholder="Texto" id="texto_ita" name="texto_ita" class="validate ckeditor w-100">{!! $contenido["ita"] !!}</textarea>
        </fieldset>
    </div>
</div>
@push('scripts')
<script src="//cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>
<script>
    $(document).on("ready",function() {
        $(".ckeditor").each(function () {
            CKEDITOR.replace( $(this).attr("name") );
        });
    });
</script>
@endpush