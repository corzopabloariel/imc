<section class="wrapper-presupuesto py-5">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 col-12 d-flex justify-content-center align-items-center">
                <div>
                    <span class="img-1"></span>
                    <p class="text-uppercase">tus datos</p>
                </div>
                <span class="linea w-50 mx-4"></span>
                <div>
                    <span class="img-2 inactivo"></span>
                    <p class="text-uppercase">tu consulta</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8 col-12">
                <form action="{{ url('/form/presupuesto') }}" method="post" class="formulario">
                    @method("post")
                    {{ csrf_field() }}
                    <div id="primero">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <input type="text" name="nombre" placeholder="Nombre" class="form-control"/>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="text" name="localidad" placeholder="Localidad" class="form-control"/>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 col-12">
                                <input type="email" name="email" placeholder="E-Mail" class="form-control"/>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="phone" name="Teléfono" placeholder="Teléfono" class="form-control"/>
                            </div>
                        </div>
                        
                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-end">
                                <button onclick="siguiente(this,1)" type="button" class="btn btn-gds text-uppercase">siguiente</button>
                            </div>
                        </div>
                    </div>
                    <div id="segundo" style="display:none">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <textarea name="mensaje" placeholder="Mensaje" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file">
                                        <label class="custom-file-label" for="file" data-browse="...">Examinar Adjunto</label>
                                    </div>
                                </div>
                                <div class="g-recaptcha" data-sitekey="6LfyY50UAAAAAJGHw1v6ixJgvBbUOasaTT6Wz-od"></div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-end">
                                <button onclick="siguiente(this,0)" type="button" class="btn btn-gds-reverse text-uppercase">anterior</button>
                                <button type="submit" class="btn btn-gds text-uppercase ml-2">enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
siguiente = function(t,tt) {
    if(tt) {
        $("#primero").hide();
        $("#segundo").show();
        $('.img-1').addClass("inactivo");
        $('.img-2').removeClass("inactivo");
    } else {
        $("#primero").show();
        $("#segundo").hide();
        $('.img-1').removeClass("inactivo");
        $('.img-2').addClass("inactivo");
    }
}
</script>
@endpush