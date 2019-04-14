<div class="row justify-content-center">
    <div class="col-12 col-md-5">
        <button type="submit" class="btn btn-success btn-block text-uppercase">Editar<i class="fas fa-edit ml-2"></i></button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <fieldset>
            <legend>español</legend>
            <div class="row">
                <div class="col-12 col-md-6">
                    <textarea placeholder="Texto" id="nosotros_esp" name="nosotros_esp" class="validate ckeditor w-100">{!! $contenido["esp"]["texto"] !!}</textarea>
                </div>
                <div class="col-12 col-md-6">
                    <textarea placeholder="Texto" id="mercado_esp" name="mercado_esp" class="validate ckeditor w-100">{!! $contenido["esp"]["mercado"] !!}</textarea>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-12">
        <fieldset>
            <legend>inglés</legend>
            <div class="row">
                <div class="col-12 col-md-6">
                    <textarea placeholder="Texto" id="nosotros_ing" name="nosotros_ing" class="validate ckeditor w-100">{!! $contenido["ing"]["texto"] !!}</textarea>
                </div>
                <div class="col-12 col-md-6">
                    <textarea placeholder="Texto" id="mercado_ing" name="mercado_ing" class="validate ckeditor w-100">{!! $contenido["ing"]["mercado"] !!}</textarea>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-12">
        <fieldset>
            <legend>italiano</legend>
            <div class="row">
                <div class="col-12 col-md-6">
                    <textarea placeholder="Texto" id="nosotros_ita" name="nosotros_ita" class="validate ckeditor w-100">{!! $contenido["ita"]["texto"] !!}</textarea>
                </div>
                <div class="col-12 col-md-6">
                    <textarea placeholder="Texto" id="mercado_ita" name="mercado_ita" class="validate ckeditor w-100">{!! $contenido["ita"]["mercado"] !!}</textarea>
                </div>
            </div>
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