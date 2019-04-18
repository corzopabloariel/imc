<div class="idiomas w-100">
    <div class="container">
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
        <div class="row">
            <div class="col-12">

                <ul class="text-uppercase d-flex align-items-center mb-0 justify-content-end align-items-end" style="height: inherit;">
                    <li style="width:110.41px"><a data-scroll="scroll-contacto" style="cursor:pointer">{{trans('words.menu.contact')}}</a></li>
                    @php
                    $email = $empresa["contactos"]["email"][0];
                    @endphp
                    <li style="width:90px"><a style="border-left: 1px solid #ccc" href="mailto:{{$email}}">email</a></li>
                    @if($languages == "esp")
                        <li style="width:96.36px">
                    @elseif($languages == "ing")
                        <li style="width:90.36px">
                    @else
                        <li style="width:86.36px">
                    @endif
                        <div class="d-flex flex-column">
                            <a @if($languages == "esp") class="activeIdioma" @endif href="{{URL::to($urlA[0])}}">{{trans('words.languages.spanish')}}</a><a style="border-left: 1px solid #ccc" @if($languages == "ing") class="activeIdioma" @endif href="{{URL::to($urlA[1])}}">{{trans('words.languages.english')}}</a><a @if($languages == "ita") class="activeIdioma" @endif href="{{URL::to($urlA[2])}}">{{trans('words.languages.italian')}}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>