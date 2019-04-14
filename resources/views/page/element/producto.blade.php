<section class="wrapper-producto">
    <div class="container">
        <div class="row py-3">
            <div class="col-12">
                <p class="title"><a href="{{ route('productos') }}">Productos</a> | {{$menu[$familia["id"]]["titulo"]}}</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar">
                    <ul class="list-group">
                        @foreach($menu AS $k => $v)
                            <li data-familia="{{$k}}" class="list-group-item">
                                <span class="d-block position-relative"><a href="{{ URL::to('productos/'. $k) }}">{{$v["titulo"]}}</a><i class="fas fa-angle-down position-absolute"></i><i class="fas fa-angle-right position-absolute"></i></span>
                                @if(count($v["hijos"]) > 0)
                                <ul class="list-group">
                                    @foreach($v["hijos"] AS $kk => $vv)
                                        <li class="list-group-item"><a href="{{ URL::to('productos/' . $vv['tituloLimpio'] . '/'. $kk) }}">{{$vv["titulo"]}}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row productos mt-sm-2">
                    @foreach($productos AS $p)
                        @php
                            $img = null;
                            $images = $p->imagenes;
                            if(count($images) > 0)
                                $img = $images[0]["img"];
                            $name = $menu[$familia["id"]]["hijos"][$p["id"]]["tituloLimpio"];
                        @endphp
                        <a href="{{ URL::to('productos/' . $name . '/'. $p['id']) }}" class="col-md-4 col-12 my-2">
                            <div class="position-relative">
                                <i class="fas fa-plus position-absolute"></i>
                                <div class="position-absolute w-100 h-100"></div>
                                <img src="{{asset($img)}}" onError="this.src='{{ asset('images/general/no-img.png') }}'" class="w-100" />
                            </div>
                            <p class="mb-0 p-2">{{$p["titulo"]}}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        window.familia = @json($familia);

        $(document).ready(function() {
            $(`[data-familia="${window.familia.id}"]`).addClass("active-menu");
        });
    </script>
@endpush