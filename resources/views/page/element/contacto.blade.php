<div style="padding-top: 50px; padding-bottom: 50px" class="container wrapper-contacto" id="scroll-contacto">
    <h4 class="title text-uppercase text-center">{{trans('words.menu.contact')}}</h4>
    <div class="row" style="margin-top: 2em;">
        <div class="col-12 d-flex justify-content-center">
            <div class="ubicacion nq text-uppercase" onclick="ubicacion('nq')">
                <h3></h3>
                <p></p>
            </div>
            <div class="ubicacion ba activoUbicacion text-uppercase" onclick="ubicacion('ba')">
                <h3></h3>
                <p></p>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 2em;">
        <div class="col-12 col-md-12 col-lg-5 order-2-imc">
            <div class="row" id="sede">
                <div class="col-12">
                    <p class="text-uppercase sede">sede buenos aires</p>
                </div>
            </div>
            <div class="row mt-2 justify-content-center" id="info">
                <div class="col-12 col-sm-6 col-md-6 col-lg-5 d-flex flex-column align-items-baseline align-items-center">
                    <img class="d-block mx-auto" src="{{ asset('/')}}images/general/lugar.fw.png">
                    <div class="w-100 d-flex align-items-center text-center flex-column mt-2">
                        <p class="mb-0 w-75 mx-auto">{{ $empresa["domicilio"]["ba"]["calle"] }} {{ $empresa["domicilio"]["ba"]["altura"] }}</p>
                        <p class="mb-0 w-75 mx-auto">{{ $empresa["domicilio"]["ba"]["localidad"] }} - {{ $empresa["domicilio"]["ba"]["cp"] }}</p>
                        <p class="mb-0 w-75 mx-auto">Buenos Aires</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 d-flex flex-column align-items-baseline align-items-center">
                    <img class="d-block mx-auto" src="{{ asset('/')}}images/general/telefono.fw.png">
                    <div class="w-100 d-flex align-items-center text-center flex-column mt-2">
                        @foreach($empresa["contactos"]["contacto"]["ba"] AS $c)
                            <p class="mb-0 w-75 mx-auto"><a href="tel:{{$c}}" target="blank">{{$c}}</a></p>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex flex-column align-items-baseline align-items-center">
                    <img class="d-block mx-auto" src="{{ asset('/')}}images/general/email.fw.png">
                    <div class="w-100 d-flex align-items-center text-center flex-column mt-2">
                        @foreach($empresa["contactos"]["email"] AS $c)
                            <p class="mb-0 w-75 mx-auto"><a href="mailto:{{$c}}" target="blank">{{$c}}</a></p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <form method="POST" action="">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12 col-md-9">
                                <input id="" type="text" class="form-control input" name="nombre" required="true" placeholder="{{trans('words.form.name')}}" tabindex="1">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 col-md-9">
                                <input id="" type="email" class="form-control input" name="email" required="true" placeholder="Email" tabindex="2">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <textarea placeholder="{{trans('words.form.message')}}" id="mensaje" name="mensaje" required="true" class="form-control input"></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="g-recaptcha" data-sitekey="6Lf8ypkUAAAAAKVtcM-8uln12mdOgGlaD16UcLXK"></div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <p class="m-0">
                                    <label>
                                        <input type="checkbox" name="is_ok">
                                        <span>{{trans('words.form.terms')}}</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button class="btn btn-gds text-uppercase mx-auto d-inline-block">{{trans('words.form.submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-12 col-md-12 col-lg-6 position-relative order-1-imc">
            <iframe id="iframeUbicacion" class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.1272454211594!2d-58.33444588504891!3d-34.70197037020982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a332f35a52a269%3A0x697a5412d4da1f9f!2sBv.+de+los+Italianos+555%2C+B1874DYF+Villa+Dominico%2C+Buenos+Aires!5e0!3m2!1ses!2sar!4v1553190217059" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</div>