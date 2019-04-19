<div id="menuNav" class="modal fade menuNav" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-top-0 border-left-0 border-bottom-0">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Menú</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
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
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-uppercase"><a class="activeImportat" href="#" data-scroll="nav">{{trans('words.menu.home')}}</a></li>
                    <li class="list-group-item text-uppercase"><a href="#" data-scroll="scroll-nosotros">{{trans('words.menu.us')}}</a></li>
                    <li class="list-group-item text-uppercase"><a href="#" data-scroll="scroll-servicio">{{trans('words.menu.services')}}</a></li>
                    <li class="list-group-item text-uppercase"><a href="#" data-scroll="scroll-prensa">{{trans('words.menu.press')}}</a></li>
                    <li class="list-group-item text-uppercase"><a href="#" data-scroll="scroll-portfolio">{{trans('words.menu.portfolio')}}</a></li>
                    <li class="list-group-item text-uppercase"><a href="#" data-scroll="scroll-rrhh">{{trans('words.menu.rrhh')}}</a></li>
                    <li class="list-group-item text-uppercase"><a href="#" data-scroll="scroll-cliente">{{trans('words.menu.clients')}}</a></li>
                    <li class="list-group-item text-uppercase"><a href="#" data-scroll="scroll-contacto">{{trans('words.menu.contact')}}</a></li>
                </ul>
            </div>
            <div class="modal-footer bg-light">
                <ul class="idiomas list-unstyled mb-0 d-flex justify-content-center w-100 text-uppercase">
                    <li><a @if($languages == "esp") class="activeIdioma" @endif href="{{URL::to($urlA[0])}}">{{trans('words.languages.spanish')}}</a></li>
                    <li><a @if($languages == "ing") class="activeIdioma" @endif href="{{URL::to($urlA[1])}}">{{trans('words.languages.english')}}</a></li>
                    <li><a @if($languages == "ita") class="activeIdioma" @endif href="{{URL::to($urlA[2])}}">{{trans('words.languages.italian')}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>