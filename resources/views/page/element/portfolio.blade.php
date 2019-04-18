<div style="padding: 50px 0;" class="wrapper-portfolio" id="scroll-portfolio">
    <div class="container">
        <h4 class="title text-uppercase text-center">{{trans('words.menu.portfolio')}}</h4>
        <p style="padding-top: 1em;" id="familias" class="text-center text-uppercase">
            @foreach($familias AS $k => $v)
                <a onclick='portfolioFamilia(this)' class='' style='cursor:pointer' data-familia data-id='{{$k}}'>{{$v}}</a>
            @endforeach
        </p>
        <div class="row">
        @foreach($trabajos as $trabajo)
            <div data-trabajo data-familia_id="{{$trabajo['familia_id']}}" class="col-md-4 col-12">
                <div class="position-relative">
                    <p class="position-absolute">{{$trabajo["nombre"]}}</p>
                    <div onclick="trabajo({{$trabajo['id']}})" class="position-absolute d-flex w-100 h-100 align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.4);">
                        <div class="d-flex flex-column align-items-center">
                            <p style="color: #D1BF7F;font-size: 30px; margin-bottom: 1em;font-weight: bold;text-transform: uppercase;text-shadow: 0 0 10px #000000;">{{$trabajo["nombre"]}}</p>
                            <p class="text-center plus d-flex align-items-center justify-content-center"><i class="fas fa-plus"></i></p>
                        </div>
                    </div>
                    @if(isset($trabajo['imagenes'][0]))
                        <img onError="this.src='{{ asset('images/general/no-img.png') }}'" style="cursor: pointer; display: block;" src="{{ asset('/')}}{{$trabajo['imagenes'][0]['image']}}" class="w-100" alt="" />
                    @else
                        <img onError="this.src='{{ asset('images/general/no-img.png') }}'" style="cursor: pointer; display: block;" src="{{ asset('/')}}" class="w-100" alt="" />
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>