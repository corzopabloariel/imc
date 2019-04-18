<nav style="z-index: 444; top: 0; left: 0; height: auto" class="w-100 position-fixed nav" id="nav">
    <div class="nav-wrapper w-100">
        @include('page.elementos.idiomas')

        <div style="height: inherit; z-index:1" class="position-relative d-flex justify-content-end align-items-end">
            
            {{--<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>--}}
            <div class="position-absolute w-100" style="top:0;left:0">
                <div class="container position-relative">
                    <a href="{{ URL::to( 'index/' . $idioma ) }}" class="brand-logo position-absolute" style="left: -5px;top: -30px;">
                        <img src="{{ asset('/')}}{{$empresa['images']['logo'] }}"/>
                    </a>
                </div>
            </div>
            <div class="navLinea w-100">
                <div class="container position-relative h-100">
                    <div class="brand-logo position-absolute" style="left: -5px;top: -30px;">
                        <canvas></canvas>
                    </div>
                    <button id="btnMenu" class="navbar-toggler position-absolute text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="right: 0; top: calc(50% - 15px);">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul id="nav-mobile" class="justify-content-end text-white text-uppercase navbar mb-0 h-100 position-relative pr-0">
                        <li><a class="activeImportat" href="#" data-scroll="nav">{{trans('words.menu.home')}}</a></li>
                        <li><a href="#" data-scroll="scroll-nosotros">{{trans('words.menu.us')}}</a></li>
                        <li><a href="#" data-scroll="scroll-servicio">{{trans('words.menu.services')}}</a></li>
                        <li><a href="#" data-scroll="scroll-prensa">{{trans('words.menu.press')}}</a></li>
                        <li><a href="#" data-scroll="scroll-portfolio">{{trans('words.menu.portfolio')}}</a></li>
                        <li><a href="#" data-scroll="scroll-rrhh">{{trans('words.menu.rrhh')}}</a></li>
                        <li><a href="#" data-scroll="scroll-cliente">{{trans('words.menu.clients')}}</a></li>
                        {{--<li><a href="#" data-scroll="scroll-contacto">{{trans('words.menu.contact')}}</a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>