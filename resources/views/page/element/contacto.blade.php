<section class="wrapper-contacto">
    <iframe class="w-100" style="height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3278.3859422238106!2d-58.38393568488858!3d-34.74586957254021!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcd2afcff0b827%3A0xe87d1ca024e776e6!2sGrupo+Silicon+Dinap!5e0!3m2!1ses!2sar!4v1554767949399!5m2!1ses!2sar" frameborder="0" style="border:0" allowfullscreen></iframe>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-4 col-12">
                <dl class="contact-list">
                    <dd><i class="fas fa-map-marker-alt mr-1"></i> {!! $empresa["domicilio"]["calle"]." ".$empresa["domicilio"]["altura"].", ".$empresa["domicilio"]["cp"].", ".$empresa["domicilio"]["localidad"] !!}</dd>
                </dl>
                <dl class="contact-list">
                    <dd class="d-flex">
                        <i class="fas fa-phone mr-1"></i>
                        <div class="d-flex flex-column ml-1">
                            @foreach($empresa["tel"] AS $t)
                                <a href="tel: {{$t}}">{{$t}}</a>
                            @endforeach
                        </div>
                    </dd>
                </dl>
                <dl class="contact-list">
                    @php
                    $Arr = [];
                    for($i = 0; $i < count($empresa['email']); $i++) {
                        if(!isset($Arr[$empresa['email'][$i]['n']]))
                            $Arr[$empresa['email'][$i]['n']] = [];
                        
                        $Arr[$empresa['email'][$i]['n']][] = $empresa['email'][$i]['e'];
                    }
                    @endphp
                    <dd class="d-flex">
                        <i class="fas fa-paper-plane mr-2"></i>
                        <div class="d-flex flex-column ml-1">
                        @foreach($Arr AS $k => $v)
                            @if(!empty($k))
                                <p class="mt-3 mb-0" style="color: #007953; font-weight: bold;">{{$k}}</p>
                            @endif
                            @for($i = 0; $i < count($v); $i++)
                                <a href="mailto:{{$v[$i]}}">{{$v[$i]}}</a>
                            @endfor
                        @endforeach
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="col-md-8 col-12 formulario">
                <form action="{{ url('/form/ecobruma') }}" method="post">
                    @method("post")
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="apellido" placeholder="Apellido">
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="telefono" placeholder="Teléfono">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="mensaje" placeholder="Mensaje"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="g-recaptcha" data-sitekey="6LfyY50UAAAAAJGHw1v6ixJgvBbUOasaTT6Wz-od"></div>
                        </div>
                        <div class="col-12 col-md-6"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-gds d-block text-uppercase">enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>