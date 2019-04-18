<ul class="sidenav navbar d-none" id="mobile-demo">
    @php
    $urlA = ["index/es","index/en","index/it"];
    if(isset($url)) {
        switch($url) {
            case "rrhh":
                $urlA = ["es/{$url}/{$oferta['id']}","en/{$url}/{$oferta['id']}","it/{$url}/{$oferta['id']}"];
                break;
            case "servicio":
                $urlA = ["es/{$url}/{$servicio['id']}","en/{$url}/{$servicio['id']}","it/{$url}/{$servicio['id']}"];
                break;
            default:
                $urlA = ["es/{$url}","en/{$url}","it/{$url}"];
                break;
        }
    }
    @endphp
    <li class="img" style="background:rgba(0, 0, 0, 0.05)">
        <a href="{{ URL::to( 'index/' . $idioma ) }}" class="brand-logo">
            <img src="{{ asset('/')}}{{$empresa['images']['logo'] }}"/>
        </a>
    </li>
    <li><a href="#" data-scroll="nav">{{trans('words.menu.home')}}</a></li>
    <li><a href="#" data-scroll="scroll-nosotros">{{trans('words.menu.us')}}</a></li>
    <li><a href="#" data-scroll="scroll-servicio">{{trans('words.menu.services')}}</a></li>
    <li><a href="#" data-scroll="scroll-prensa">{{trans('words.menu.press')}}</a></li>
    <li><a href="#" data-scroll="scroll-portfolio">{{trans('words.menu.portfolio')}}</a></li>
    <li><a href="#" data-scroll="scroll-rrhh">{{trans('words.menu.rrhh')}}</a></li>
    <li><a href="#" data-scroll="scroll-cliente">{{trans('words.menu.clients')}}</a></li>
    <li><a href="#" data-scroll="scroll-contacto">{{trans('words.menu.contact')}}</a></li>
    
    <li class="idiomas position-absolute w-100" style="bottom: 60px">
        <div>
            <a @if($languages == "esp") class="activeIdioma" @endif href="{{URL::to($urlA[0])}}">{{trans('words.languages.spanish')}}</a> | <a @if($languages == "ing") class="activeIdioma" @endif href="{{URL::to($urlA[1])}}">{{trans('words.languages.english')}}</a> | <a @if($languages == "ita") class="activeIdioma" @endif href="{{URL::to($urlA[2])}}">{{trans('words.languages.italian')}}</a>
        </div>
    </li>
</ul>