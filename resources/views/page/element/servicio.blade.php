<div style="padding:50px 0;" class="wrapper-servicio" id="scroll-servicio">
    <h4 class="title text-uppercase text-center mb-0">{{trans('words.menu.services')}}</h4>
    
    <div class="tipo text-center text-uppercase py-3">
        <a data-tipoServicio="EMP" style="cursor: pointer" class="activeImportat" onclick="mostrarServicio(this,'EMP')">{{trans('words.services.business')}}</a>
        <a data-tipoServicio="ALQ" style="cursor: pointer" class="" onclick="mostrarServicio(this,'ALQ')">{{trans('words.services.equipment_rental')}}</a>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($servicios as $servicio)
                @if($servicio['tipo'] == "EMP")
                    <div data-servicio data-tipo="{{$servicio['tipo']}}" class="col-12 col-md-6 d-flex mt-1" style="min-height: 120px">
                @else
                    <div data-servicio data-tipo="{{$servicio['tipo']}}" class="col-12 col-md-6 mt-1 d-none" style="min-height: 120px">
                @endif
                    <div class="d-flex justify-content-center">
                        <div class="icon-servicio">
                            <img src="{{ asset($servicio['icon']) }}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="pl-4">
                        <p class="servicio-title">{{ $servicio["data"]["titulo"] }}</p>
                        <p>{{ $servicio["data"]["descripcion"] }}</p>
                        <a style="color: #D7BE88" href="{{ URL::to($idioma . '/servicio/' . $servicio['id']) }}" class="btn-flat text-uppercase p-0">{{trans('words.read')}} <i class="fas fa-plus-circle"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>