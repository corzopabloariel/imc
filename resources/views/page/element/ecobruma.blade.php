<section class="wrapper-ecobruma">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="title">Ecobruma</h3>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                {!! $contenido["texto"] !!}
            </div>
            {{-- SLIDER --}}
            <div class="col-md-6">
                <div id="carouselExampleIndicators mb-2" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i = 0 ; $i < count($slider) ; $i++)
                            @if($i == 0)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="active"></li>
                            @else
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                            @endif
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        @for($i = 0 ; $i < count($slider) ; $i++)
                            @if($i == 0)
                                <div class="carousel-item active">
                            @else
                                <div class="carousel-item">
                            @endif
                            <img class="d-block w-100" src="{{asset($slider[$i]['img'])}}" >
                            <div class="position-absolute w-100">
                                <div class="container">
                                    {!! $slider[$i]['texto'] !!}
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- CARACTERISTICAS --}}
    <div class="container mt-5">
        <div class="row caracteristicas justify-content-md-center">
            @foreach ($contenido["caracteristicas"] as $c)
                <div class="col-md-2 px-0 d-flex justify-content-center flex-column">
                    <img src="{{asset($c['img'])}}" alt="" srcset="">
                    <p>{{$c["titulo"]}}</p>
                </div>
            @endforeach
        </div>
    </div>
    {{-- VIDEO --}}
    @if(!empty($contenido['video']))
    <div class="container video mt-5">
        <div class="bg-light border">
            <div class="row justify-content-md-center py-5">
                <div class="col-md-5">
                    <p class="mb-0 mx-auto w-75 text-center">Para más información, mirá el video a continuación</p>
                </div>
                <div class="col-md-4">
                    <iframe class="w-100" src="https://www.youtube.com/embed/{{$contenido['video']}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container dinamica-aplicaciones mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="title">{!! $contenido["dinamica"]["titulo"] !!}</h4>
                        {!! $contenido["dinamica"]["texto"] !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="title">{!! $contenido["aplicaciones"]["titulo"] !!}</h4>
                        {!! $contenido["aplicaciones"]["texto"] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="formulario bg-light border-top" style="padding-top: 130px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="title text-center">¿Necesitás Asesoramiento?</h5>
                    <p class="mb-0 text-center">Contáctanos y te brindaremos toda la información que necesites</p>
                </div>
            </div>
            <form action="{{ url('/form/ecobruma') }}" method="post" class="py-3">
                @method("post")
                {{ csrf_field() }}
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="empresa" placeholder="Empresa">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="mensaje" placeholder="Mensaje"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                    <div class="col-md-6">
                        <div class="g-recaptcha" data-sitekey="6LfyY50UAAAAAJGHw1v6ixJgvBbUOasaTT6Wz-od"></div>
                    </div>
                </div>
                <div class="row justify-content-md-center mt-2">
                    <div class="col-md-6">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" name="terminos" for="customCheck1">Acepto los términos y condiciones de privacidad</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center mt-5">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <button class="btn btn-gds d-block text-uppercase mx-auto">enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>