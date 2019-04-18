<div class="wrapper-oferta image" id="scroll-rrhh">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-6 col-md-12 col-12 position-relative extra">
                <p class="title text-uppercase">{{trans('words.rrhh')}}</p>
                <div class="regular slider" style="z-index: 1;" id="ofertas">
                    @foreach($ofertas AS $o)
                        <div class="d-flex align-items-center justify-content-center">
                            <form method="post" action="{{ url('/envio/' . $o['id']) }}" enctype="multipart/form-data">
                                <input type="hidden" name="id[]" value="{{$o['id']}}"/>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <p class="name">{{ $o["data"]["nombre"] }} <small class="text-uppercase" style="font-weight: initial; font-size:15px">@if($o["provincia"] == "BA") buenos aires @else neuquén @endif</small></p>
                                <p class="t"><strong>{{trans('words.work.age')}}</strong> {{ $o["data"]["rango"] }}</p>
                                <p class="t"><strong>{{trans('words.work.year')}}</strong> {{ $o["data"]["experiencia"] }}</p>
                                <p class="t"><strong>{{trans('words.work.orientation')}}</strong> {{ $o["data"]["orientacion"] }}</p>
                                
                                <div class="row" style="margin-top: 1em;">
                                    <div class="col-12">
                                        <a href="{{ URL::to($idioma . '/rrhh/' .$o['id']) }}" class="text-uppercase btn btn-gds" href="" tabindex="0" style="cursor: pointer">{{trans('words.work.submit')}}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
                <ul id="sliderOfertas">
                </ul>
            </div>
        </div>
    </div>
</div>