<nav class="navbar navbar-expand-lg navbar-light p-0">
    <div class="container">
        <a class="navbar-brand m-0 p-0" href="{{ URL::to( '/' ) }}">
            <img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ asset($empresa['img']['logo']) }}?t=<?php echo time(); ?>" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end align-items-end flex-column" id="navbarSupportedContent">
            <div class="submenu">
                <ul class="p-0">
                    <li><a href="{{ URL::to( 'presupuesto' ) }}" class="nav-link text-uppercase p-0">solicitar presupuesto</a></li>
                    <li><i class="fas fa-paper-plane mr-2" style="color: #FF7102"></i><a href="mailto:{{$empresa['email'][0]['e']}}">{{$empresa["email"][0]["e"]}}</a></li>
                </ul>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('empresa') }}">Empresa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('productos') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ecobruma') }}">Ecobruma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('videos') }}">Videos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clientes') }}">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('proyectos') }}">Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
                </li>
                <li class="nav-item">
                    <i class="fas fa-search buscar"></i>
                </li>
            </ul>
        </div>
    </div>
</nav>