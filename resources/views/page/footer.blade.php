<footer class="section footer-classic context-dark bg-image">
    <div class="container">
        <div class="row row-30">
            <div class="col-md-4 col-xl-5">
                <a class="navbar-brand" href="{{ URL::to( '/' ) }}">
                    <img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ asset($empresa['img']['logo_footer']) }}?t=<?php echo time(); ?>" />
                </a>
                <h5 class="title text-uppercase">nuestras redes</h5>
                <a class="red" href="{{$empresa['redes']['facebook']}}"><i class="fab fa-facebook-square"></i></a>
                <a class="red ml-1" href="{{$empresa['redes']['youtube']}}"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="col-md-4 d-flex">
                <ul class="list-unstyled menu">
                    <li><a href="{{ URL::to( '/' ) }}">INICIO</a></li>
                    <li><a href="{{ route('empresa') }}">EMPRESA</a></li>
                    <li><a href="{{ route('productos') }}">PRODUCTOS</a></li>
                    <li><a href="{{ route('ecobruma') }}">ECOBRUMA</a></li>
                    <li><a href="{{ route('videos') }}">VIDEOS</a></li>
                </ul>
                <ul class="list-unstyled menu">
                    <li><a href="{{ route('clientes') }}">CLIENTES</a></li>
                    <li><a href="{{ route('proyectos') }}">PROYECTOS</a></li>
                    <li><a href="{{ route('presupuesto') }}">SOLICITAR PRESUPUESTO</a></li>
                    <li><a href="{{ route('contacto') }}">CONTACTO</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-xl-3">
                <h5 class="title text-uppercase">GRUPO SILICON DINAP S.R.L.</h5>
                <dl class="contact-list">
                    <dd><i class="fas fa-map-marker-alt mr-1"></i> {!! $empresa["domicilio"]["calle"]." ".$empresa["domicilio"]["altura"].", ".$empresa["domicilio"]["localidad"] !!}</dd>
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
                    <dd><i class="fas fa-paper-plane mr-2"></i><a href="mailto:{{$empresa['email'][0]['e']}}">{{$empresa["email"][0]["e"]}}</a></dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
                <div class="d-flex justify-content-end">
                    <a href="http://osole.es" target="_blank" class="text-uppercase" style="font-size: 11px; color: #fff;">by osole</a>
                </div>
            </div>
        </div>
    </div>
</footer>