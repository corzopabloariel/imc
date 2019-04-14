<section class="wrapper-producto">
    <div class="container">
        <div class="row py-3">
            <div class="col-12">
                <p class="title"><a href="{{ route('productos') }}">Productos</a> | <a href="{{ URL::to('productos/'. $producto['familia_id']) }}">{{$menu[$producto["familia_id"]]["titulo"]}}</a> | {{$menu[$producto["familia_id"]]["hijos"][$producto["id"]]["titulo"]}}</p>
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
                                        <li data-producto="{{$kk}}" class="list-group-item"><span><a href="{{ URL::to('productos/' . $vv['tituloLimpio'] . '/'. $kk) }}">{{$vv["titulo"]}}</a></span></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9 producto mt-sm-2">
                <div class="row justify-content-md-center">
                    <div class="col-md-6">
                        <div id="carouselExampleIndicators mb-2" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @for($i = 0 ; $i < count($producto["imagenes"]) ; $i++)
                                    @if($i == 0)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="active"></li>
                                    @else
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                                    @endif
                                @endfor
                            </ol>
                            <div class="carousel-inner">
                                @for($i = 0 ; $i < count($producto["imagenes"]) ; $i++)
                                    @if($i == 0)
                                        <div class="carousel-item active">
                                    @else
                                        <div class="carousel-item">
                                    @endif
                                    <img class="d-block w-100" src="{{asset($producto['imagenes'][$i]['img'])}}" >
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="title mt-3">{{$producto["titulo"]}}</h3>
                <div class="descripcion">
                    {!! $producto["data"]["descripcion"] !!}
                </div>
                @if(count($producto["data"]["caracteristicas"]) > 0)
                <div class="row caracteristicas my-5">
                    @foreach($producto["data"]["caracteristicas"] AS $c)
                    <div class="col-md-4">
                        <img class="d-block mx-auto" src="{{asset($c['img'])}}" onError="this.src='{{ asset('images/general/no-img.png') }}'" />
                        <p class="w-75 mx-auto text-center">{{$c["nombre"]}}</p>
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="detalle">
                    {!! $producto["data"]["detalle"] !!}
                </div>

                <div class="botones">
                    @if(!empty($producto['data']['especificaciones']))
                    <a target="blank" href="{{asset($producto['data']['especificaciones'])}}" class="btn btn-gds text-uppercase">especificaciones</a>
                    @endif
                    <button class="btn btn-gds text-uppercase">consultar</button>
                </div>

                @if(!empty($producto['data']['video']))
                <div class="video my-5" style="padding: 0 15px">
                    <div class="row justify-content-md-center bg-light border py-4">
                        <div class="col-md-6">
                            <p class="mb-0">Para más información, mirá el video a continuación</p>
                        </div>
                        <div class="col-md-6">
                            <iframe class="w-100" src="https://www.youtube.com/embed/{{$producto['data']['video']}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                @endif
                @if(count($producto["productos"]) > 0)
                <div class="relacionados mt-5">
                    <h4 class="title">Productos Relacionados</h4>
                    <div class="row my-4">
                        @foreach($producto["productos"] AS $p)
                        @php
                            $img = null;
                            $images = $p->imagenes;
                            if(count($images) > 0)
                                $img = $images[0]["img"];
                            $name = $menu[$p["familia_id"]]["hijos"][$p["id"]]["tituloLimpio"];
                        @endphp
                        <a href="{{ URL::to('productos/' . $name . '/'. $p['id']) }}" class="col-md-4 col-12 mt-2">
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
                @endif
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        window.producto = @json($producto);

        $(document).ready(function() {
            $(`[data-familia="${window.producto.familia_id}"]`).addClass("active-menu");
            $(`[data-producto="${window.producto.id}"]`).addClass("active-menu");
        });
    </script>
@endpush